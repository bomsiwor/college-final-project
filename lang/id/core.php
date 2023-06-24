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
    'admin' => [
        'text' => 'Administrator',
        'class' => 'text-primary'
    ],
    'ka-lab' => [
        'text' => 'Kepala Lab',
        'class' => 'text-primary'
    ],
    'user' => [
        'text' => 'Pengguna biasa',
        'class' => 'text-secondary'
    ],

    // Permission
    'manage-user' => 'Mengelola User',
    'manage-tool' => 'Mengelola aset',
    'manage-borrow' => 'Mengelola pinjaman aset',
    'manage-radioactive' => 'Mengelola sumber RA',
    'manage-radioactive-borrow' => 'Mengelola Pinjaman RA',
    'manage-document' => 'Mengelola dokumen',
    'manage-maintenance' => 'Mengelola perawatan',
    'manage-site' => 'Mengelola situs',
    'manage-agenda' => 'Mengelola agenda',
    'kepala-lab' => 'Kepala LAB',
    'manage-report' => 'Mengelola laporan',

    // Identitas
    'NIM' => 'Nomor Induk Mahasiswa',
    'NIP' => 'Nomor Induk Pegawai',
    'KTP' => 'Kartu Identitas Penduduk',

    // Ini bagian peralatan
    'accepted' => [
        'text' => 'Disetujui',
        'class' => 'border-success border text-success'
    ],
    'returned' => [
        'text' => 'Dikembalikan',
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
    'not late' => 'Sesuai Permohonan',

    // Radioaktif
    'sealed' => 'Terbungkus',



    // Document
    'modul' => 'Modul',
    'procedure' => 'Prosedur',
    'sop' => 'SOP/Tata tertib',

    'report' => [
        // Status Laporan
        'requested' => 'Diajukan',
        'accept' => 'Diterima',
        'accessed' => 'Disetujui',
        'reject' => 'Ditolak',
        'analyzed' => 'Tahap analisis',
        'advancing' => 'Tahap tindak lanjut',
        'repairing' => 'Tahap Perbaikan',
        'done' => 'Laporan Selesai',
    ]
];
