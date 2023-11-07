<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnersSeeder extends Seeder
{
    public function run(): void
    {
        Partner::factory()->count(DatabaseSeeder::PARTNER_COUNT)->create();
    }
}
