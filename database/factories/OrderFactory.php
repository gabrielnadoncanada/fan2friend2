<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'number' => 'OR' . $this->faker->unique()->randomNumber(6),
            'total' => $this->faker->randomFloat(2, 100, 2000),
            'status' => $this->faker->randomElement(['new', 'processing', 'shipped', 'delivered', 'cancelled']),
            'notes' => $this->faker->realText(100),
            'order_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function configure(): Factory
    {
        return $this->afterCreating(function (Order $order) {
            $order->address()->save(OrderAddressFactory::new()->make());
        });
    }
}
