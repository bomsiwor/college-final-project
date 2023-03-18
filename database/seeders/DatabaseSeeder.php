<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(12)->create();

        \App\Models\Institution::factory(5)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $arrayOfRoleNames = ['student', 'lecturer', 'staff', 'extern'];
        $roles = collect($arrayOfRoleNames)->map(function ($role) {
            return ['name' => $role, 'guard_name' => 'web'];
        });

        Role::insert($roles->toArray());

        $this->call([
            StudyProgramSeeder::class,
            UnitSeeder::class,
            ProfessionSeeder::class
        ]);
    }
}
