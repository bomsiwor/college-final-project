<?php

namespace Database\Factories\Person;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Extern>
 */
class ExternFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'extern_name' => fake('id_ID')->name(),
            'extern_address' => fake('id_ID')->address(),
            'extern_phone' => fake('id_ID')->phoneNumber(),
            'profession_id' => fake()->numberBetween(1, 88),
            'identification_type' => 'KTP',
            'identification_number' => fake('id_ID')->unique()->nik(),
            'institution_id' => fake()->numberBetween(1, 5),
            'user_id' => fake()->unique()->numberBetween(10, 12)
        ];
    }
}
