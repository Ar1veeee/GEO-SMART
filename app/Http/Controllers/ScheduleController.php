<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Schedule;
use App\Models\School;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index()
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $districts = District::orderBy('name')->get();
        $schedules = Schedule::with('district')->get()->keyBy('day');

        return view('pages.schedules.index', compact('days', 'districts', 'schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required',
            'district_id' => 'required|exists:districts,id'
        ]);

        Schedule::updateOrCreate(
            ['day' => $request->day],
            ['district_id' => $request->district_id]
        );

        return back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function show($day)
    {
        $schedule = Schedule::where('day', $day)->firstOrFail();
        $office = Office::first();

        if (!$office) {
            return back()->with('error', 'Data Kantor belum diisi.');
        }

        $officeWkt = "POINT({$office->geom->latitude} {$office->geom->longitude})";

        $schools = School::where('district_id', $schedule->district_id)
            ->select('*')
            ->selectRaw("ST_Distance_Sphere(geom, ST_GeomFromText(?, 4326)) as distance", [
                $officeWkt
            ])
            ->selectRaw("(student_count / NULLIF(class_count, 0)) as density")
            ->orderByDesc('density')
            ->orderBy('distance')
            ->get();

        return view('pages.schedules.show', compact('schedule', 'schools', 'day'));
    }
}
