<?php

namespace Database\Factories;

use App\Enums\ScheduleRuleType;
use App\Enums\ScheduleType;
use App\Enums\ScheduleWeekDay;
use App\Models\Celebrity;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class CelebrityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $name = $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(),
            'featured' => $this->faker->boolean(),
            'is_visible' => $this->faker->boolean(),
        ];
    }

    public function configure(): CelebrityFactory
    {
        return $this->afterCreating(function (Celebrity $celebrity) {
            try {
                for ($i = 0; $i < 5; $i++) {
                    $celebrity
                        ->addMediaFromUrl(DatabaseSeeder::IMAGE_URL)
                        ->toMediaCollection('celebrity-images');
                }
                $celebrity
                    ->addMediaFromUrl(DatabaseSeeder::IMAGE_URL)
                    ->toMediaCollection('celebrity-featured-image');
            } catch (UnreachableUrl $exception) {
                return;
            }
        });
    }
}
