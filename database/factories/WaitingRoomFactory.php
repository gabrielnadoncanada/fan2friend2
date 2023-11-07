<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaitingRoomFactory extends Factory
{

    public function definition()
    {
        return [
            'order_item_id' => OrderItem::factory(),
            'status' => $this->faker->randomElement(['waiting', 'in_session', 'completed']),
            'entered_at' => $this->faker->dateTimeBetween('-1 hours', 'now'),
            'session_started_at' => function (array $attributes) {
                return $attributes['status'] === 'in_session' ? now() : null;
            },
            'session_ended_at' => function (array $attributes) {
                return $attributes['status'] === 'completed' ? now() : null;
            },
            // 'created_at' and 'updated_at' will be set automatically
        ];
    }
}
