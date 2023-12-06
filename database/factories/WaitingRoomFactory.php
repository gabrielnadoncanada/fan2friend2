<?php

namespace Database\Factories;

use App\Models\Celebrity;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaitingRoomFactory extends Factory
{
    public function definition()
    {
        return [
            'celebrity_id' => Celebrity::factory(),
            'current_queue_count' => $this->faker->numberBetween(1, 10),
            'meeting_url' => $this->faker->url,
            'start_time' => $this->faker->dateTimeBetween('-1 hours', 'now'),
            'end_time' => $this->faker->dateTimeBetween('now', '+1 hours'),
        ];
    }
}
