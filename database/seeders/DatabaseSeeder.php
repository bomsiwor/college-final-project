<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Excel;
use App\Models\Tool;
use App\Models\User;
use App\Imports\ToolImport;
use App\Models\Radioactive;
use Illuminate\Database\Seeder;
use App\Imports\MaintenanceImport;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Imports\RadionuclideImport;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Institution::create([
            'institution_name' => 'Poltek Nuklir',
            'institution_address' => 'Jl. Babarsari Kotak POB 6101/YKKB, Ngentak, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281'
        ]);

        \App\Models\Institution::factory(5)->create();

        $arrayOfRoleNames = ['admin', 'user', 'ka-lab'];

        $roles = collect($arrayOfRoleNames)->map(function ($role) {
            return [
                'name' => $role,
                'guard_name' => 'web'
            ];
        });

        Role::insert($roles->toArray());

        $roles = collect($arrayOfRoleNames)->map(function ($role) {
            return [
                'name' => $role,
                'guard_name' => 'api'
            ];
        });

        Role::insert($roles->toArray());

        $this->call([
            StudyProgramSeeder::class,
            UnitSeeder::class,
            ProfessionSeeder::class
        ]);

        $arrayOfPermissions = [
            'manage-user',
            'manage-tool',
            'manage-borrow',
            'manage-radioactive',
            'manage-radioactive-borrow',
            'manage-document',
            'manage-maintenance',
            'manage-site',
            'manage-agenda',
            'manage-report',
            'kepala-lab'
        ];

        $permissions = collect($arrayOfPermissions)->map(function ($permission) {
            return [
                'name' => $permission,
                'guard_name' => 'web'
            ];
        })->toArray();

        Permission::insert($permissions);

        DB::table('role_has_permissions')
            ->insert(
                collect($arrayOfPermissions)->map(fn ($id, $key) => [
                    'role_id' => 1,
                    'permission_id' => $key + 1
                ])->toArray()
            );

        DB::table('role_has_permissions')
            ->insert(
                collect($arrayOfPermissions)->map(fn ($id, $key) => [
                    'role_id' => 3,
                    'permission_id' => $key + 1
                ])->toArray()
            );

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

        $user->assignRole('ka-lab');

        $user = User::create([
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'name' => 'Admin Lab',
            'identifier' => 'NIP',
            'identification_number' => '123781238432',
            'institution_id' => 1,
            'profession_id' => 3,
            'unit_id' => 4,
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
