<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PartnerFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Partner::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'is_visible' => $this->faker->boolean(),
        ];
    }
}
