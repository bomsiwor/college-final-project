<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(12)->create();

        \App\Models\Institution::factory(5)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            StudyProgramSeeder::class,
            UnitSeeder::class,
            ProfessionSeeder::class
        ]);

        \App\Models\Person\Student::factory(3)->create();
        \App\Models\Person\Lecturer::factory(3)->create();
        \App\Models\Person\Staff::factory(3)->create();
        \App\Models\Person\Extern::factory(3)->create();
    }
}
