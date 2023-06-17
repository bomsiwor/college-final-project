<?php

namespace App\Exports;

use App\Models\RadioactiveBorrow;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class RadioactiveBorrowExport implements FromCollection, WithTitle, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return RadioactiveBorrow::whereNotNull('actual_return_date')->get();
    }

    public function map($row): array
    {
        return [
            $row->user->name,
            $row->radioactive->element_name . '-' . $row->radioactive->isotope_number,
            $row->radioactive->entry_number,
            $row->radioactive->inventory_number,
            __("activity.$row->purpose"),
            $row->start_borrow_date->isoFormat('dddd, DD-MM-Y'),
            $row->expected_return_date->isoFormat('dddd, DD-MM-Y'),
            $row->actual_return_date->isoFormat('dddd, DD-MM-Y'),
            $row->description,
            $row->verificator->name,
            $row->verified_at->isoFormat('dddd DD-MM-Y'),
            $row->verified_note
        ];
    }

    public function title(): string
    {
        return "Data";
    }

    public function headings(): array
    {
        return [
            'Nama peminjam',
            'Nama sumber',
            'Nomor sumber',
            'Nomor inventaris',
            'Keperluan',
            'Rencana Tanggal Pinjam',
            'Rencana Tanggal Kembali',
            'Realisasi Pengembalian',
            'Keterangan',
            'Verifikator',
            'Waktu verifikasi',
            'Catatan verifikasi',
        ];
    }
}
