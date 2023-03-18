<?php

namespace App\Enums;

enum PresensiEnum: string
{
    case BIASA = 'biasa';
    case KULIAH = 'kuliah';
    case PERAWATAN = 'maintenance';
    case PINJAM = 'pinjam';
    case KEMBALI = 'kembali';
    case TA = 'ta';
    case PENELITIAN = 'riset';
    case MAGANG = 'magang';
    case RAPAT = 'rapat';
}
