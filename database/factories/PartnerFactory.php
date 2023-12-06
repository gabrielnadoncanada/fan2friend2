<?php

namespace Database\Factories;

use App\Models\Partner;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class PartnerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->company(),
        ];
    }

    public function configure(): PartnerFactory
    {
        return $this->afterCreating(function (Partner $partner) {
            try {
                $partner
                    ->addMediaFromUrl(DatabaseSeeder::IMAGE_URL)
                    ->toMediaCollection('partner-featured-image');

            } catch (UnreachableUrl $exception) {
                return;
            }
        });
    }
}
