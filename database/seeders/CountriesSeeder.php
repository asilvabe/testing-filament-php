<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run(): void
    {
        Country::create(['name' => 'Colombia']);
        Country::create(['name' => 'Ecuador']);
    }
}
