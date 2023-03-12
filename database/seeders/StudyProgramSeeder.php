<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('study_programs')->insert([
            ['name' => 'Teknokimia Nuklir'],
            ['name' => 'Elektronika Instrumentasi'],
            ['name' => 'Elektro Mekanika']
        ]);
    }
}
