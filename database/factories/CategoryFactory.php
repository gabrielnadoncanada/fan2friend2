<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Celebrity;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class CategoryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->words(3, true),
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(),
            'is_visible' => $this->faker->boolean()
        ];
    }

    public function configure(): CategoryFactory
    {
        return $this->afterCreating(function (Category $category) {
            try {
                $category
                    ->addMediaFromUrl(DatabaseSeeder::IMAGE_URL)
                    ->toMediaCollection('category-featured-image');

            } catch (UnreachableUrl $exception) {
                return;
            }
        });
    }
}
