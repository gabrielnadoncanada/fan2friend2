<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Celebrity;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingService
{
    public function fetchAvailabilitiesWithExclusions(Celebrity $celebrity): array
    {
        $cacheKey = "celebrity.{$celebrity->id}.availabilities";

//        if (Cache::has($cacheKey)) {
//            return Cache::get($cacheKey);
//        }

        $celebrity = $this->loadCelebritySchedule($celebrity);
        $exceptionsByWeekday = $this->mapExceptionsByWeekday($celebrity->scheduleRuleExceptions);
        $rrule = collect();

        foreach ($celebrity->scheduleRules as $scheduleRule) {
            $weekday = $scheduleRule->wday->getShortLabel();
            $exdates = $exceptionsByWeekday[$weekday] ?? [];

            $rrule->push($this->getFormattedRrule($scheduleRule, $exdates, $celebrity->start_date, $celebrity->end_date));
        }

        foreach ($celebrity->scheduleRuleExceptions as $exception) {
            $rrule->push($this->getFormattedRrule($exception, [], $exception->date, $exception->date));
        }

        $rrule = $rrule->collapse();

        Cache::put($cacheKey, $rrule->all(), 60 * 60 * 24);

        return $rrule->all();
    }

    private function loadCelebritySchedule(Celebrity $celebrity): Celebrity
    {
        return $celebrity->load([
            'scheduleRules.intervals:id,start_time,end_time',
            'scheduleRuleExceptions.intervals:id,start_time,end_time',
            'orderItems' => function ($query) use ($celebrity) {
                $query->select('id', 'scheduled_date')
                    ->whereIn('scheduled_date', [
                        $celebrity->start_date,
                        $celebrity->end_date,
                    ]);
            },
        ]);
    }

    private function mapExceptionsByWeekday($exceptions): array
    {
        return $exceptions->groupBy(function ($exception) {
            return $exception->wday->getShortLabel();
        })->map(function ($grouped) {
            return $grouped->pluck('date')->all();
        })->all();
    }

    private function getFormattedRrule($scheduleRule, $exdates, $start_date, $end_date): array
    {
        $rrule = [];

        foreach ($scheduleRule->intervals as $interval) {
            $rrule[] = $this->formatRrule($scheduleRule, $interval, $exdates, $start_date, $end_date);
        }

        return $rrule;
    }

    private function formatRrule($scheduleRule, $interval, $exdates, $start_date, $end_date): array
    {
        return [
            'rrule' => [
                'freq' => 'weekly',
                'byweekday' => $scheduleRule->wday->getShortLabel(),
                'dtstart' => $start_date,
                'until' => $end_date,
            ],
            'start_time' => $interval->start_time,
            'end_time' => $interval->end_time,
            'exdate' => $exdates,
            'interval_id' => $interval->id,
        ];
    }

    public function isIntervalAvailable(Celebrity $celebrity, string $selectedDate, int $intervalId)
    {
        $interval = DB::table('intervals')->find($intervalId);

        if (!$interval) {
            throw new \Exception('Interval not found');
        }

        $usedMinutes = DB::table('order_items')
            ->where('scheduled_date', $selectedDate)
            ->where('status', OrderStatus::PAID)
            ->whereTime('start_time', '>=', $interval->start_time)
            ->whereTime('end_time', '<=', $interval->end_time)
            ->sum(DB::raw('TIMESTAMPDIFF(MINUTE, start_time, end_time) + ' . $celebrity->before_buffer_time . ' + ' . $celebrity->after_buffer_time));



        return $interval->total_available_minutes - (int)$usedMinutes >= ($celebrity->spot_step + $celebrity->before_buffer_time + $celebrity->after_buffer_time);
    }
}
