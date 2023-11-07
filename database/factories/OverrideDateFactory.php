<?php

namespace Database\Factories;

use App\Models\Celebrity;
use Illuminate\Database\Eloquent\Factories\Factory;

class OverrideDateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'celebrity_id' => Celebrity::factory(),
            'date' => $this->faker->date(),
        ];
    }
}
