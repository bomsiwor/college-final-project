<?php

return [
    // Ini bagian peralatan
    'good' => [
        'text' => 'Baik/Layak',
        'class' => 'border-success border text-success'
    ],
    'not good' => [
        'text' => 'Kurang Layak',
        'class' => 'border-warning border text-warning'
    ],
    'broken' => [
        'text' => 'Rusak',
        'class' => 'border-danger border text-danger'
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
    'KTP' => 'Kartu Identitas Penduduk'

];
