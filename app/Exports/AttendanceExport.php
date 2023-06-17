<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class AttendanceExport implements WithHeadings, WithMapping, FromCollection, WithTitle, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Attendance::all();
    }

    public function map($attendance): array
    {
        return [
            $attendance->id,
            $attendance->user->name,
            $attendance->attendance_time->isoFormat('dddd, DD-MM-Y - HH:mm'),
            __('activity.' . $attendance->occupation)
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Pengunjung',
            'Waktu kunjungan',
            'Tujuan'
        ];
    }

    public function title(): string
    {
        return 'Data';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6.5,
            'B' => 29,
            'C' => 23,
            'D' => 10
        ];
    }
}
