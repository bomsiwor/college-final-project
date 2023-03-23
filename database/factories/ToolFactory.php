<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ToolFactory extends Factory
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
            'name' => fake()->word(),
            'merk' => fake()->word(),
            'series' => fake()->countryCode(),
            'description' => fake()->sentence(),
            'condition' => 'good',
            'status' => 'available',
            'purchase_date' => fake()->date(),
            'price' => "100000"
        ];
    }
}
