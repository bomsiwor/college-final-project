<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Imports\ToolImport;
use App\Models\Tool;
use App\Models\User;
use App\Models\Radioactive;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Excel;

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
        // Tool::factory(50)->create();
        Radioactive::factory(10)->create();

        $arrayOfRoleNames = ['student', 'lecturer', 'staff', 'extern', 'admin', 'user'];
        $roles = collect($arrayOfRoleNames)->map(function ($role) {
            return ['name' => $role, 'guard_name' => 'web'];
        });

        Role::insert($roles->toArray());

        $this->call([
            StudyProgramSeeder::class,
            UnitSeeder::class,
            ProfessionSeeder::class
        ]);

        $user = User::create([
            'email' => 'bomsiwor@gmail.com',
            'username' => 'bomsiwor',
            'name' => 'Dimas Febrian Bomanarakasura',
            'identifier' => 'NIM',
            'identification_number' => '021900009',
            'institution_id' => 1,
            'profession_id' => 3,
            'study_program_id' => 2,
            'password' => Hash::make('brek3le5758!')
        ]);

        $user->assignRole('student', 'admin');

        Excel::import(new ToolImport, 'data-alat-insnuk-final.xlsx');
    }
}
