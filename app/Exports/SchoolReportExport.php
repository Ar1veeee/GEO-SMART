<?php

namespace App\Exports;

use App\Models\School;
use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SchoolReportExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $report;
    protected $schoolIds;

    public function __construct(Report $report)
    {
        $this->report = $report;
        $ids = $report->jenjang;
        $this->schoolIds = is_array($ids) ? $ids : json_decode($ids, true);
    }

    public function query()
    {
        return School::query()
            ->with('district')
            ->whereIn('id', $this->schoolIds ?: []);
    }

    public function headings(): array
    {
        return [
            'Tipe Laporan',
            'Nama Sekolah',
            'Tipe Sekolah',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Kecamatan',
            'Catatan (Notes)',
            'Jumlah Siswa',
            'Koordinat'
        ];
    }

    public function map($school): array
    {
        return [
            $this->report->type,
            $school->name,
            $school->type,
            $this->report->start_date ?? '-',
            $this->report->end_date ?? '-',
            $school->district->name ?? '-',
            $this->report->notes ?? '-',
            $school->student_count . ' Siswa',
            $school->latitude . ',' . $school->longitude
        ];
    }
}
