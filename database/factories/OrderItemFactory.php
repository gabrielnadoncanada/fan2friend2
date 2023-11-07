<?php

namespace Database\Factories;

use App\Models\Celebrity;
use App\Models\Order;
use App\Models\Service;
use App\Models\TimeSlot;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'service_id' => Service::factory(),
            'time_slot_id' => TimeSlot::factory(),
            'celebrity_id' => Celebrity::factory(),
        ];
    }
}
