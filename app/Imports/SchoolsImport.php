<?php

namespace App\Imports;

use App\Models\School;
use App\Models\District;
use App\Models\SchoolImport as SchoolImportModel;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Events\AfterImport;

class SchoolsImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading, WithEvents, WithCustomCsvSettings
{
    protected $importId;
    protected $errors = [];
    protected $successCount = 0;

    public function __construct($importId) {
        $this->importId = $importId;
    }

    public function getCsvSettings(): array {
        return ['delimiter' => ';'];
    }

    public function model(array $row)
    {
        $kecName = trim(str_ireplace(['Kec.', 'Kecamatan'], '', $row['kecamatan'] ?? ''));
        $district = District::where('name', 'like', "%$kecName%")->first();

        if (!$district) {
            $this->errors[] = "Kecamatan tidak ditemukan: " . ($row['kecamatan'] ?? 'N/A');
            return null;
        }

        $lat = (float) str_replace(',', '.', $row['lat'] ?? 0);
        $lng = (float) str_replace(',', '.', $row['lng'] ?? 0);

        $this->successCount++;

        return new School([
            'npsn'           => $row['npsn'],
            'name'           => $row['nama_sekolah'],
            'address'       => $row['alamat'] ?? '-',
            'kelurahan'      => $row['kelurahan'] ?? null,
            'geom'          => new Point($lat, $lng, 4326),
            'student_count' => (int) ($row['jmlsiswa'] ?? 0),
            'district_id'   => $district->id,
            'description'   => $row['kurikulum'] ?? '',
            'teacher_count'  => 0,
            'status'         => $row['status'] ?? 'Swasta',
            'type'           => $row['jenjang'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nama_sekolah' => 'required',
            '*.lat'          => 'required',
            '*.lng'          => 'required',
        ];
    }

    public function chunkSize(): int { return 1000; }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function (AfterImport $event) {
                $import = SchoolImportModel::find($this->importId);
                if ($import) {
                    $import->update([
                        'status' => count($this->errors) > 0 ? 'partial_failed' : 'completed',
                        'imported_rows' => $this->successCount,
                        'log' => implode("\n", $this->errors)
                    ]);

                    District::all()->each(function($d) {
                        $d->update(['total_students' => School::where('district_id', $d->id)->sum('student_count')]);
                    });
                }
            },
        ];
    }
}
