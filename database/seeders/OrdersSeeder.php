<?php

namespace Database\Seeders;

use App\Models\Celebrity;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\WaitingRoom;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        Customer::all()->each(function ($customer) {
            Order::factory()
                ->count(DatabaseSeeder::ORDER_PER_CUSTOMER_COUNT)
                ->create(['customer_id' => $customer->id])
                ->each(function ($order) {
                    OrderItem::factory()
                        ->count(DatabaseSeeder::ORDER_ITEM_COUNT)
                        ->create([
                            'order_id' => $order->id,
                            'celebrity_id' => $celebrityId = Celebrity::all()->first()->id,
                            'service_id' => Celebrity::find($celebrityId)->services->first()->id,
                            'time_slot_id' => Celebrity::find($celebrityId)->weeklySchedules->first()->timeSlots->first()->id,
                        ])->each(function ($orderItem) {
//                            WaitingRoom::factory()
//                                ->count(1)
//                                ->create(['order_item_id' => $orderItem->id]);
                        });
                });
        });
    }
}
