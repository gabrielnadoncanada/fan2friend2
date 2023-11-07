<?php

namespace Database\Factories;

use App\Models\Celebrity;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeeklyScheduleFactory extends Factory
{

    public function definition(): array
    {
        return [
            'celebrity_id' => Celebrity::factory(),
            'day_of_week' => now()->dayOfWeek
        ];
    }
}
