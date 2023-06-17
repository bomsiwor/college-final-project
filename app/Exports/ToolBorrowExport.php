<?php

namespace App\Exports;

use App\Models\Borrow;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ToolBorrowExport implements FromCollection, WithTitle, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Borrow::where('actual_return_date', '!=', null)->get();
    }

    public function map($row): array
    {
        return [
            $row->user->name,
            $row->inventory->name,
            $row->inventory->inventory_number,
            __("activity.$row->purpose"),
            $row->start_borrow_date->isoFormat('dddd, DD-MM-Y'),
            $row->expected_return_date->isoFormat('dddd, DD-MM-Y'),
            $row->actual_return_date,
            __("core.$row->before_condition.text"),
            __("core.$row->after_condition.text"),
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
            'Nama barang',
            'Nomor inventaris',
            'Keperluan',
            'Rencana Tanggal Pinjam',
            'Rencana Tanggal Kembali',
            'Realisasi Pengembalian',
            'Kondisi sebelum',
            'Kondisi sesudah',
            'Keterangan',
            'Verifikator',
            'Waktu verifikasi',
            'Catatan verifikasi',
        ];
    }
}
