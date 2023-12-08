<?php

namespace Database\Seeders;

use App\Enums\WeekDays;
use App\Models\Category;
use App\Models\Celebrity;
use App\Models\Interval;
use App\Models\ScheduleRule;
use App\Models\ScheduleRuleException;
use Illuminate\Database\Seeder;

class CelebritiesSeeder extends Seeder
{
    public function run(): void
    {
        $startDate = now()->addDays(10);
        $endDate = $startDate->copy()->addDays(30);

        Celebrity::factory()
            ->count(DatabaseSeeder::CELEBRITY_COUNT)
            ->hasAttached(Category::all()->random(1)->first(), ['created_at' => now(), 'updated_at' => now()])
            ->has(
                ScheduleRule::factory()->count(7)->sequence(
                    ['wday' => WeekDays::SUNDAY],
                    ['wday' => WeekDays::MONDAY],
                    ['wday' => WeekDays::TUESDAY],
                    ['wday' => WeekDays::WEDNESDAY],
                    ['wday' => WeekDays::THURSDAY],
                    ['wday' => WeekDays::FRIDAY],
                    ['wday' => WeekDays::SATURDAY],
                )
                    ->has(Interval::factory()->count(DatabaseSeeder::INTERVAL_PER_SCHEDULE_RULE_COUNT))
                    ->state(fn (array $attributes, Celebrity $celebrity) => ['celebrity_id' => $celebrity->id])
            )
            ->has(
                ScheduleRuleException::factory()->count(DatabaseSeeder::SCHEDULE_RULE_EXCEPTION_COUNT)
                    ->has(Interval::factory()->count(DatabaseSeeder::INTERVAL_PER_SCHEDULE_RULE_EXCEPTION_COUNT))
                    ->state(fn (array $attributes, Celebrity $celebrity) => ['celebrity_id' => $celebrity->id])
            )
            ->create(
                [
                    'before_buffer_time' => 5,
                    'after_buffer_time' => 5,
                    'spot_step' => 5,
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                ]
            );
    }
}
