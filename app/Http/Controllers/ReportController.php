<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Schedule;
use App\Models\School;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Exports\SchoolReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $districts = District::all();
        $reports = Report::with('district')->latest()->get();

        $daysIndo = ['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat'];
        $today = $daysIndo[date('l')] ?? 'Senin';
        $currentSchedule = Schedule::where('day', $today)->first();

        $selectedDistrict = $request->district_id ?? ($currentSchedule->district_id ?? $districts->first()->id);

        $schools = School::where('district_id', $selectedDistrict)
            ->get()
            ->groupBy('type');

        return view('pages.reports.index', compact('districts', 'reports', 'schools', 'selectedDistrict'));
    }

    public function getSchoolsByDistrict(Request $request)
    {
        $schools = School::where('district_id', $request->district_id)
            ->get()
            ->groupBy('type');

        return response()->json($schools);
    }

    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required',
            'school_ids' => 'required|array',
        ]);

        $district = District::find($request->district_id);
        $fileName = 'Laporan_' . str_replace(' ', '_', $district->name) . '_' . now()->format('d_M_Y_His');

        Report::create([
            'name' => $fileName,
            'type' => $request->jenis_laporan ?? 'Ringkasan Kunjungan Sekolah',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'district_id' => $request->district_id,
            'jenjang' => $request->school_ids,
            'notes' => $request->notes,
            'file_format' => 'xlsx'
        ]);

        return back()->with('success', 'Laporan berhasil disimpan ke riwayat.');
    }

    public function export($id)
    {
        $report = Report::findOrFail($id);

        return Excel::download(
            new SchoolReportExport($report),
            $report->name . '.xlsx'
        );
    }
}
