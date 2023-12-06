<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'unit_price' => $this->faker->randomFloat(2, 80, 400),
            'quantity' => 1,
            'total_price' => $this->faker->randomFloat(2, 80, 400),
            'scheduled_date' => fake()->date,
            'duration' => 5,
            'start_time' => fake()->time,
            'status' => 'pending',
        ];
    }
}
