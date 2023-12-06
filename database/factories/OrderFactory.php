<?php

namespace Database\Factories;

use App\Enums\CanadianProvince;
use App\Enums\Country;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'number' => 'OR' . $this->faker->unique()->randomNumber(6),
            'total_price' => $this->faker->randomFloat(2, 100, 2000),
            'status' => $this->faker->randomElement(OrderStatus::cases()),
            'notes' => $this->faker->realText(100),
            'order_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'company' => $this->faker->company(),
            'country' => Country::CA->name,
            'street' => $this->faker->streetAddress(),
            'state' => $this->faker->randomElement(CanadianProvince::values()),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
        ];
    }
}
