<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(DatabaseSeeder::CUSTOMER_COUNT)->create()->each(function ($user) {
            $user->assignRole('customer');
            Customer::factory()->create(['user_id' => $user->id]);
        });
    }
}
