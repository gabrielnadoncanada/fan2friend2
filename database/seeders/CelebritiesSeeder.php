<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Celebrity;
use App\Models\OverrideDate;
use App\Models\Service;
use App\Models\TimeSlot;
use App\Models\WeeklySchedule;
use Illuminate\Database\Seeder;

class CelebritiesSeeder extends Seeder
{
    public function run(): void
    {
        Celebrity::factory()
            ->count(DatabaseSeeder::CELEBRITY_COUNT)
            ->hasAttached(Category::all()->random(1), ['created_at' => now(), 'updated_at' => now()])
            ->create()
            ->each(function ($celebrity) {
                WeeklySchedule::factory()
                    ->count(DatabaseSeeder::WEEKLY_SCHEDULE_COUNT)
                    ->sequence(
                        ['day_of_week' => 1],
                        ['day_of_week' => 2],
                        ['day_of_week' => 3],
                        ['day_of_week' => 4],
                        ['day_of_week' => 5],
                        ['day_of_week' => 6],
                        ['day_of_week' => 7],
                    )
                    ->create(['celebrity_id' => $celebrity->id])
                    ->each(function ($weeklySchedule) {
                        TimeSlot::factory()
                            ->count(DatabaseSeeder::TIME_SLOT_COUNT)
                            ->create([
                                'weekly_schedule_id' => $weeklySchedule->id,
                                'start_time' => '19:00:00',
                                'end_time' => '22:00:00',
                            ]);
                    });

                OverrideDate::factory()
                    ->count(DatabaseSeeder::OVERRIDE_DATE_COUNT)
                    ->create(['celebrity_id' => $celebrity->id])
                    ->each(function ($overrideDate) {
                        TimeSlot::factory()
                            ->count(DatabaseSeeder::OVERRIDE_DATE_TIME_SLOT_COUNT)
                            ->create(['override_date_id' => $overrideDate->id]);
                    });

                Service::factory()
                    ->count(DatabaseSeeder::SERVICE_COUNT)
                    ->create(['celebrity_id' => $celebrity->id]);
            });
    }
}
