<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //    const IMAGE_URL = 'https://source.unsplash.com/random/800x800/?img=1';
    const IMAGE_URL = 'https://demofilament.test/images/placeholder.png';

    const CUSTOMER_COUNT = 1;

    const CELEBRITY_COUNT = 1;

    const PARTNER_COUNT = 5;

    const CATEGORY_COUNT = 0;

    const ORDER_PER_CUSTOMER_COUNT = 2;

    const ORDER_ITEM_COUNT = 3;

    const INTERVAL_PER_SCHEDULE_RULE_COUNT = 2;

    const INTERVAL_PER_SCHEDULE_RULE_EXCEPTION_COUNT = 0;

    const SCHEDULE_RULE_EXCEPTION_COUNT = 0;

    public function run(): void
    {
        $this->call([
            CategoriesSeeder::class,
            CustomersSeeder::class,
            CelebritiesSeeder::class,
            PartnersSeeder::class,
            OrdersSeeder::class,
        ]);
    }
}
