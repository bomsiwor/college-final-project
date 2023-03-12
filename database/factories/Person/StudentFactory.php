<?php

namespace Database\Factories\Person;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'student_name' => fake()->name(),
            'student_address' => fake()->address(),
            'student_phone' => fake()->phoneNumber(),
            'study_program_id' => fake()->numberBetween(1, 3),
            'user_id' => fake()->unique()->numberBetween(1, 3),
            'nim' => fake()->unique()->randomNumber(9, true)
        ];
    }
}
