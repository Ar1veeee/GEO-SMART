<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\School;
use App\Models\District;

class MapController extends Controller
{
    public function index(Request $request)
    {
        $office = Office::firstOrFail();

        $schools = School::with('district')->get();

        $districts = District::all()->map(function ($district) {
            $district->school_count = School::where('district_id', $district->id)->count();

            $district->avg_students = $district->school_count > 0
                ? round(School::where('district_id', $district->id)->avg('student_count'))
                : 0;
            if ($district->total_students > 7000) {
                $district->color_hex = '#ef4444';
                $district->bg_soft = 'bg-red-50';
            } elseif ($district->total_students >= 2000) {
                $district->color_hex = '#f59e0b';
                $district->bg_soft = 'bg-amber-50';
            } else {
                $district->color_hex = '#10b981';
                $district->bg_soft = 'bg-emerald-50';
            }

            return $district;
        });

        $types = School::distinct()->orderBy('type')->pluck('type');
        $districtOptions = District::orderBy('name')->pluck('name', 'id');

        return view('pages.map.index', compact(
            'office', 'schools', 'districts', 'types', 'districtOptions'
        ));
    }
}
