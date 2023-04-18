<?php

return [
    // Halaman response
    '404' => 'Tidak ditemukan!',

    // Ini bagian peralatan
    'good' => [
        'text' => 'Baik/Layak',
        'class' => 'border-success border text-success'
    ],
    'minor' => [
        'text' => 'Rusak Ringan',
        'class' => 'border-warning border text-warning'
    ],
    'severe' => [
        'text' => 'Rusak Berat',
        'class' => 'border-danger border text-danger'
    ],
    'unknown' => [
        'text' => 'Belum Diketahui',
        'class' => 'border-dark border text-dark'
    ],

    // Bagian ketersediaan
    'available' => [
        'text' => 'Tersedia',
        'symbol' => 'mdi-check-decagram text-success'
    ],
    'borrowed' => [
        'text' => 'Dipinjam/Digunakan',
        'symbol' => 'mdi-alert-box text-danger'
    ],
    'maintained' => [
        'text' => 'Dirawat',
        'symbol' => 'mdi-cog text-warning'
    ],
    'unavailable' => [
        'text' => 'Tidak digunakan',
        'symbol' => 'mdi-cog text-danger'
    ],

    // Role
    'student' => [
        'text' => 'Mahasiswa',
        'class' => 'border-info border text-info'
    ],
    'lecturer' => [
        'text' => 'Dosen',
        'class' => 'border-success border text-success'
    ],
    'staff' => [
        'text' => 'Staff',
        'class' => 'border-warning border text-warning'
    ],
    'extern' => [
        'text' => 'Eksternal',
        'class' => 'border-danger border text-danger'
    ],

    // Identitas
    'NIM' => 'Nomor Induk Mahasiswa',
    'NIP' => 'Nomor Induk Pegawai',
    'KTP' => 'Kartu Identitas Penduduk',

    // Ini bagian peralatan
    'accepted' => [
        'text' => 'Disetujui',
        'class' => 'border-success border text-success'
    ],
    'pending' => [
        'text' => 'Menunggu',
        'class' => 'border-warning border text-warning'
    ],
    'rejected' => [
        'text' => 'Ditolak',
        'class' => 'border-danger border text-danger'
    ],

    // Bagian kembali
    'on time' => 'Tepat Waktu',
    'not returned' => 'Belum Kembali',
    'overdue' => 'Terlambat',

    // Radioaktif
    'sealed' => 'Terbungkus'
];
