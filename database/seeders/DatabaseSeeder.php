<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CountriesSeeder::class,
            DocumentTypesSeeder::class,
        ]);

        Merchant::factory()->count(10)->create();
    }
}
