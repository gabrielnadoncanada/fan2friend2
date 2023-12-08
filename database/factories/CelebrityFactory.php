<?php

namespace Database\Factories;

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
        $first_name = $this->faker->firstName();
        $last_name = $this->faker->lastName();
        $full_name = $first_name . ' ' . $last_name;

        return [
            'user_id' => User::factory(),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'slug' => Str::slug($full_name),
            'description' => $this->faker->realText(),
            'before_buffer_time' => fake()->randomDigit,
            'after_buffer_time' => fake()->randomDigit,
            'spot_step' => fake()->randomDigit,
            'start_date' => fake()->date,
            'end_date' => fake()->date,

        ];
    }

    //    public function configure(): CelebrityFactory
    //    {
    //        return $this->afterCreating(function (Celebrity $celebrity) {
    //            try {
    //                for ($i = 0; $i < 3; $i++) {
    //                    $celebrity
    //                        ->addMediaFromUrl(DatabaseSeeder::IMAGE_URL)
    //                        ->toMediaCollection('celebrity-images');
    //                }
    //                $celebrity
    //                    ->addMediaFromUrl(DatabaseSeeder::IMAGE_URL)
    //                    ->toMediaCollection('celebrity-featured-image');
    //            } catch (UnreachableUrl $exception) {
    //                return;
    //            }
    //        });
    //    }
}
