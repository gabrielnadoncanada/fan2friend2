<?php

namespace Database\Factories;

use App\Enums\WeekDays;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduleRule>
 */
class ScheduleRuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wday' => fake()->randomElement(WeekDays::values()),
        ];
    }
}
