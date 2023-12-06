<?php

namespace Database\Factories;

use App\Models\Category;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

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
