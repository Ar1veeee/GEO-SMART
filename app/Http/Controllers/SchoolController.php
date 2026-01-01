<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\District;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $query = School::with('district');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('npsn', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $statsQuery = clone $query;
        $totalStudentsGlobal = $statsQuery->sum('student_count');
        $totalSchoolsGlobal = $statsQuery->count();

        $schools = $query->latest()->paginate(10)->withQueryString();

        return view('pages.schools.index', compact(
            'schools',
            'totalStudentsGlobal',
            'totalSchoolsGlobal'
        ));
    }

    public function create()
    {
        $districts = District::orderBy('name')->get();
        return view('pages.schools.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npsn' => 'nullable|unique:schools,npsn',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'kelurahan' => 'nullable|string|max:255',
            'district_id' => 'required|exists:districts,id',
            'type' => 'required|in:SD,SMP,SMA,SMK,Lainnya',
            'status' => 'nullable|in:Negeri,Swasta',
            'student_count' => 'required|integer|min:0',
            'teacher_count' => 'required|integer|min:0',
            'class_count' => 'nullable|integer|min:0',
            'lab_count' => 'nullable|integer|min:0',
            'library_count' => 'nullable|integer|min:0',
            'sanitation_count' => 'nullable|integer|min:0',
            'established_year' => 'nullable|integer|digits:4',
            'description' => 'nullable|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'facilities' => 'nullable|array',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['geom'] = new Point($request->lat, $request->lng, 4326);
        $data['user_id'] = Auth::id();
        $data['kabupaten'] = $request->kabupaten ?? 'SUKOHARJO';
        $data['provinsi'] = $request->provinsi ?? 'JAWA TENGAH';

        School::create($data);

        return redirect()->route('schools.index')->with('success', 'Data sekolah berhasil ditambahkan.');
    }

    public function edit(School $school)
    {
        $districts = District::orderBy('name')->get();
        return view('pages.schools.edit', compact('school', 'districts'));
    }

    public function update(Request $request, School $school)
    {
        $validated = $request->validate([
            'npsn' => 'nullable|unique:schools,npsn,' . $school->id,
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'district_id' => 'required|exists:districts,id',
            'type' => 'required|in:SD,SMP,SMA,SMK,Lainnya',
            'student_count' => 'required|integer',
            'teacher_count' => 'required|integer',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'facilities' => 'nullable|array',
        ]);

        $data = $request->all();
        $data['geom'] = new Point($request->lat, $request->lng, 4326);

        $school->update($data);
        return redirect()->route('schools.index')->with('success', 'Data sekolah berhasil diperbarui.');
    }

    public function destroy(School $school)
    {
        $school->delete();
        return back()->with('success', 'Data sekolah berhasil dihapus.');
    }
}
