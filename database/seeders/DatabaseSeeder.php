<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Imports\MaintenanceImport;
use App\Imports\RadionuclideImport;
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
        \App\Models\Institution::factory(5)->create();

        $arrayOfRoleNames = ['admin', 'user'];
        $roles = collect($arrayOfRoleNames)->map(function ($role) {
            return [
                'name' => $role,
                'guard_name' => 'web'
            ];
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

        $user->assignRole('admin');

        $user = User::create([
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'name' => 'Admin Lab',
            'identifier' => 'NIP',
            'identification_number' => '123781238432',
            'institution_id' => 1,
            'profession_id' => 3,
            'study_program_id' => 2,
            'password' => Hash::make('password')
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'email' => 'zahrawibow@gmail.com',
            'username' => 'jarajara',
            'name' => 'Zahra Zahira Wibowo',
            'identifier' => 'NIM',
            'identification_number' => '021900032',
            'institution_id' => 1,
            'profession_id' => 3,
            'study_program_id' => 2,
            'password' => Hash::make('brek3le5758!')
        ]);

        $user->assignRole('user');

        \App\Models\Post::factory(10)->create();

        Excel::import(new ToolImport, 'data-alat-insnuk-final.xlsx');
        Excel::import(new RadionuclideImport, 'data-zra-insnuk.xlsx');
        Excel::import(new MaintenanceImport, 'daftar maintenance lab insnuk.xlsx');
    }
}
