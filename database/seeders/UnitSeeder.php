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
        $raws = [
            'PPMPA - Pusat Penjaminan Mutu & Pengembangan Akademik',
            'PPPM - Pusat Penelitian & Pengabdian Masyarakat',
            'UPT Laboratorium Dasar Terpadu',
            'UPT Laboratorium Terapan Terpadu',
            'UPT AINT - Aplikasi Iptek Nuklir Terpadu',
            'UPT Perpustakaan',
            'UPT TIK - Teknologi Informasi & Komunikasi',
            'UPT Bahasa',
            'UPT KKPR - Keteknikan Keselamatan & Proteksi Radiasi',
            'UPT PKK - Pengembangan Karakter & Karier',
            'Sub-bag Keuangan',
            'Sub-bag SDM',
            'Sub-bag BMN - Barang Milik Negara',
        ];

        DB::table('units')
            ->insert(collect($raws)
                ->map(fn ($value) => ['unit_name' => $value])
                ->toArray());
    }
}
