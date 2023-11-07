<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const IMAGE_URL = 'https://demofilament.test/placeholder.png';
    const CUSTOMER_COUNT = 3;
    const CELEBRITY_COUNT = 1;
    const PARTNER_COUNT = 5;
    const CATEGORY_COUNT = 5;
    const SERVICE_COUNT = 1;
    const ORDER_PER_CUSTOMER_COUNT = 1;
    const ORDER_ITEM_COUNT = 1;
    const WEEKLY_SCHEDULE_COUNT = 7;
    const TIME_SLOT_COUNT = 2;
    const OVERRIDE_DATE_COUNT = 1;
    const OVERRIDE_DATE_TIME_SLOT_COUNT = 2;

    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            AdminSeeder::class,
            CategoriesSeeder::class,
            CustomersSeeder::class,
            CelebritiesSeeder::class,
            PartnersSeeder::class,
            OrdersSeeder::class,
        ]);
    }
}
