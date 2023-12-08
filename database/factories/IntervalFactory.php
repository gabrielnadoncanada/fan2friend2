<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IntervalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_time = Carbon::createFromFormat('H:i:s', fake()->time)->roundMinute(15);
        $end_time = $start_time->copy()->addMinutes(30);

        return [
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
    }
}
