<?php

namespace Database\Factories\Person;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'staff_name' => fake('ru_RU')->name(),
            'nip' => fake()->unique()->randomNumber(5, true),
            'staff_address' => fake('id_ID')->address(),
            'staff_phone' => fake('id_ID')->phoneNumber(),
            'unit_id' => fake()->numberBetween(1, 3),
            'user_id' => fake()->unique()->numberBetween(7, 9)
        ];
    }
}
