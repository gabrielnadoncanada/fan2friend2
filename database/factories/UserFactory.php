<?php

namespace Database\Factories;

use App\Enums\CanadianProvince;
use App\Enums\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'is_approved' => $this->faker->boolean(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber(),
            'company' => $this->faker->company(),
            'country' => Country::CA->name,
            'street' => $this->faker->streetAddress(),
            'state' => $this->faker->randomElement(CanadianProvince::values()),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
        ];
    }

    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
