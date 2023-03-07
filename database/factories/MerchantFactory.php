<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'brand' => $this->faker->company,
            'website_url' => $this->faker->domainName,
            'country_id' => 1,
            'increment_type' => $this->faker->randomElement(['SMLMV', 'IPC']),
        ];
    }
}
