<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Models\Celebrity;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            Order::factory()
                ->count(DatabaseSeeder::ORDER_PER_CUSTOMER_COUNT)
                ->has(Payment::factory()->count(rand(1, 3)))
                ->create(
                    [
                        'status' => OrderStatus::PAID,
                        'user_id' => $user->id
                    ]
                )
                ->each(function ($order) {
                    $celebrity = Celebrity::all()->random(1)->first();


                    OrderItem::factory()
                        ->count(DatabaseSeeder::ORDER_ITEM_COUNT)
                        ->create([
                            'order_id' => $order->id,
                            'celebrity_id' => $celebrity->id,
                            'scheduled_date' => now()->format('Y-m-d'),
                            'start_time' => $celebrity->scheduleRules->first()->intervals->first()->start_time,
                            'status' => OrderStatus::PAID,
                        ]);
                });
        });
    }
}
