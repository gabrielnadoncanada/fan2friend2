<?php

namespace Database\Factories;

use App\Enums\ScheduleType;
use App\Enums\ScheduleWeekDay;
use App\Models\Celebrity;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class CelebrityFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Celebrity::class;

    public function getDefaultScheduleDaysInterval()
    {
        $defaultDays = [];
        foreach (ScheduleWeekDay::values() as $day) {
            $defaultDays[] = [
                'type' => ScheduleType::Day->value,
                'wday' => $day,
                'timeIntervals' => [
                    [
                        'from' => '10:00',
                        'to' => '12:00',
                    ],
                ],
            ];
        }

        return $defaultDays;
    }

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(),
            'featured' => $this->faker->boolean(),
            'is_visible' => $this->faker->boolean(),
            'variations' => [
                [
                    'duration' => 300,
                    'price' => $this->faker->randomFloat(2, 10, 30),
                ],
                [
                    'duration' => 600,
                    'price' => $this->faker->randomFloat(2, 30, 60),
                ],
            ],
            'schedules' => $this->getDefaultScheduleDaysInterval(),
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
