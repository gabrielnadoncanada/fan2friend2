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

        $admin = User::firstOrCreate(
            ['email' => 'admin@fan2friend.app'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'password' => 'password',
            ]
        );
        $admin->assignRole(config('app.admin_role'));

        $celebrity = User::firstOrCreate(
            ['email' => 'celebrity@fan2friend.app'],
            [
                'first_name' => 'Celebrity',
                'last_name' => 'Celebrity',
                'password' => 'password',
            ]
        );
        $celebrity->assignRole('Celebrity');

        $customer = User::firstOrCreate(
            ['email' => 'customer@fan2friend.app'],
            [
                'first_name' => 'Customer',
                'last_name' => 'Customer',
                'password' => 'password',
            ]
        );
        $customer->assignRole('Customer');

        Category::factory()->count(9)->sequence(
            ['title' => 'Acteurs'],
            ['title' => 'Athlètes'],
            ['title' => 'Comédiens'],
            ['title' => 'Créateurs'],
            ['title' => 'En vedette'],
            ['title' => 'Humoristes'],
            ['title' => 'Influenceurs'],
            ['title' => 'Musiciens'],
            ['title' => 'Professionnels'],
        )->create();
    }
}
