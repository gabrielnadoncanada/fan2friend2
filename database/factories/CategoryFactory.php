<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $name = $this->faker->unique()->words(3, true),
            'slug' => Str::slug($name),
        ];
    }
}
