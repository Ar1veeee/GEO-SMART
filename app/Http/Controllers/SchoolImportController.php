<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolImport;
use App\Imports\SchoolsImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel as ExcelFormat;

class SchoolImportController extends Controller
{
    public function index()
    {
        $imports = SchoolImport::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('pages.import.index', compact('imports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10240',
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('imports', $fileName, 'public');

        $import = SchoolImport::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'user_id' => Auth::id(),
            'status' => 'processing',
        ]);

        try {
            $format = ($extension === 'csv') ? ExcelFormat::CSV : ExcelFormat::XLSX;

            Excel::import(
                new SchoolsImport($import->id),
                storage_path('app/public/' . $filePath),
                null,
                $format
            );

            return back()->with('success', 'Import selesai!');
        } catch (\Exception $e) {
            Log::error('IMPORT FATAL ERROR: ' . $e->getMessage());
            $import->update(['status' => 'failed', 'log' => $e->getMessage()]);
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function template()
    {
        $path = public_path('templates/template_sekolah.xlsx');
        if (!file_exists($path)) {
            return back()->with('error', 'File template tidak ditemukan di folder public/templates/');
        }
        return response()->download($path, 'Template_Import_Sekolah.xlsx');
    }

    public function log(SchoolImport $import)
    {
        return response($import->log ?? 'Tidak ada detail log.', 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
