<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\District;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_schools' => School::count(),
            'total_districts' => District::count(),
            'total_reports' => Report::count(),
            'total_students' => School::sum('student_count'),
        ];

        $distribution = School::select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get();

        $recent_reports = Report::with('district')->latest()->take(5)->get();

        return view('pages.dashboard', compact('stats', 'distribution', 'recent_reports'));
    }
}
