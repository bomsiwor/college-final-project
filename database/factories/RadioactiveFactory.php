<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Radioactive>
 */
class RadioactiveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'inventory_number' => Str::uuid()->toString(),
            'name' => 'Cobalt',
            'isotope_number' => 60,
            'slug' => '60co',
            'purchase_date' => fake()->date(),
            'production_date' => fake()->date(),
            'activity_ci' => 40,
            'activity_bq' => 37000,
            'product_number' => fake()->word(),
            'description' => fake()->sentences(8, true),
            'status' => 'ada'
        ];
    }
}
