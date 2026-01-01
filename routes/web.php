<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolImportController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/api/system-status', function () {
        return response()->json([
            'active_users' => UserController::getActiveUserCount(),
            'last_update' => now()->timezone('Asia/Jakarta')->format('d M Y H:i'),
        ]);
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);

    Route::get('/map', [MapController::class, 'index'])->name('map.index');

    Route::prefix('import')->group(function () {
        Route::get('/', [SchoolImportController::class, 'index'])->name('import.index');
        Route::post('/', [SchoolImportController::class, 'store'])->name('import.store');
        Route::get('/template', [SchoolImportController::class, 'template'])->name('import.template');
        Route::get('/{import}/log', [SchoolImportController::class, 'log'])->name('import.log');
    });

    Route::resource('schools', SchoolController::class);

    Route::prefix('schedules')->name('schedules.')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('index');
        Route::post('/store', [ScheduleController::class, 'store'])->name('store');
        Route::get('/{day}', [ScheduleController::class, 'show'])->name('show');
    });

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::post('/store', [ReportController::class, 'store'])->name('store');
        Route::get('/export/{id}', [ReportController::class, 'export'])->name('export');
        Route::get('/get-schools', [ReportController::class, 'getSchoolsByDistrict'])->name('getSchools');
    });
});

require __DIR__.'/auth.php';
