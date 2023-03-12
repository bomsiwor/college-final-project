<?php

namespace Database\Factories\Person;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecturer>
 */
class LecturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lecturer_name' => fake('id_ID')->name(),
            'nip' => fake()->unique()->randomNumber(5, true),
            'lecturer_address' => fake('id_ID')->address(),
            'lecturer_phone' => fake('id_ID')->phoneNumber(),
            'user_id' => fake()->unique()->numberBetween(4, 6)
        ];
    }
}
