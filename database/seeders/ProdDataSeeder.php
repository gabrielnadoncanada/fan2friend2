<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Celebrity;
use App\Models\User;
use Artisan;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ProdDataSeeder extends Seeder
{
    public function run()
    {
        Artisan::call('shield:generate --all');
        $this->seedAdmin();
    }

    private function seedAdmin()
    {
        User::unsetEventDispatcher();
        Role::create(['name' => 'Customer']);
        Role::create(['name' => 'Celebrity']);
        Role::create(['name' => 'Host']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@fan2friend.app'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'password' => 'password',
            ]
        );

        $admin->assignRole(config('app.admin_role'));

        //        $celebrity1 = User::firstOrCreate(
        //            ['email' => 'celebrity@fan2friend.app'],
        //            [
        //                'first_name' => 'Laurent',
        //                'last_name' => 'Duvernay-Tardif',
        //                'password' => 'password',
        //            ]
        //        );
        //
        //        $celebrity2->assignRole('Celebrity');
        //
        $customer1 = User::firstOrCreate(
            ['email' => 'customer@fan2friend.app'],
            [
                'first_name' => 'Customer',
                'last_name' => 'Customer',
                'password' => 'password',
            ]
        );
        $customer1->assignRole('Customer');

        $customer2 = User::firstOrCreate(
            ['email' => 'customer2@fan2friend.app'],
            [
                'first_name' => 'Customer',
                'last_name' => 'Customer',
                'password' => 'password',
            ]
        );
        //
        $customer2->assignRole('Customer');

        Category::factory()->count(9)->sequence(
            ['title' => 'Humour'],
            ['title' => 'Sport'],
            ['title' => 'Musique'],
        )->create();
    }
}
