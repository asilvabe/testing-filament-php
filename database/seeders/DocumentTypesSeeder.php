<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypesSeeder extends Seeder
{
    public function run(): void
    {
        DocumentType::create(['country_id' => 1, 'name' => 'Cédula de ciudadanía']);
        DocumentType::create(['country_id' => 1, 'name' => 'Cédula de extranjería']);
        DocumentType::create(['country_id' => 1, 'name' => 'Tarjeta de identidad']);

        DocumentType::create(['country_id' => 2, 'name' => 'Cédula de identidad']);
        DocumentType::create(['country_id' => 2, 'name' => 'Registro Único de Contribuyente']);
    }
}
