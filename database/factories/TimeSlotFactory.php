<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimeSlotFactory extends Factory
{

    public function definition(): array
    {
        return [
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
        ];
    }
}
