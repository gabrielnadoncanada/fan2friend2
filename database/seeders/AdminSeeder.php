<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(1)->create([
            'name' => 'Demo User',
            'email' => 'admin@filamentphp.com',
        ])->each(function ($user) {
            $user->assignRole('admin');
            $user->assignRole('customer');
            $user->assignRole('celebrity');


            Customer::factory()->create(['user_id' => $user->id]);
        });
    }
}
