<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            ['unit_name' => 'Akademik'],
            ['unit_name' => 'BMN'],
            ['unit_name' => 'Tata Usaha'],
        ]);
    }
}
