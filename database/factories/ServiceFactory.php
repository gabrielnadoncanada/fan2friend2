<?php

namespace Database\Factories;

use App\Models\Celebrity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'celebrity_id' => Celebrity::factory(),
            'name' => $this->faker->word(),
            'duration' => $this->faker->numberBetween(5, 60),
            'price' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
