<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KalabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'kalab@insnuk.com',
            'username' => 'kalab',
            'name' => 'Kepala Laboratorium',
            'identifier' => 'NIP',
            'identification_number' => Str::random(9),
            'institution_id' => 1,
            'profession_id' => 5,
            'unit_id' => 5,
            'password' => Hash::make('password')
        ]);

        $user->assignRole('ka-lab');
    }
}
