<?php

namespace App\Exports;

use App\Models\RadiationLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RadiationLogExport implements FromCollection, WithMapping, WithHeadings, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return RadiationLog::all();
    }

    public function map($row): array
    {
        return [
            // $row->id,
            $row->user->name,
            __("activity.$row->purpose"),
            // $row->log_date,
            Date::dateTimeToExcel($row->log_date),
            $row->start_time->isoFormat('HH:mm'),
            $row->end_time->isoFormat('HH:mm'),
            $row->doses,
            $row->description
        ];
    }

    public function headings(): array
    {
        return [
            // '#',
            'Nama Personel',
            'Keperluan',
            'Tanggal',
            'Waktu mulai',
            'Waktu selesai',
            'Dosis',
            'Keterangan'
        ];
    }

    public function title(): string
    {
        return 'Data';
    }
}
