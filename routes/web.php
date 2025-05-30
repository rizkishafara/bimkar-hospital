<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware([
    'auth',
    'role:dokter'
])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');
    Route::prefix('jadwal-periksa')->group(function () {
        Route::get('/', [
            JadwalPeriksaController::class,
            'index'
        ])->name('dokter.jadwal-periksa.index');
        Route::post('/', [
            JadwalPeriksaController::class,
            'store'
        ])->name('dokter.jadwal-periksa.store');
        Route::patch('/{id}', [
            JadwalPeriksaController::class,
            'update'
        ])->name('dokter.jadwal-periksa.update');
    });
    Route::prefix('obat')->group(function () {
        Route::get('/', 'App\Http\Controllers\Dokter\ObatController@index')->name('dokter.obat.index');
        Route::post('/', 'App\Http\Controllers\Dokter\ObatController@store')->name('dokter.obat.store');
        Route::patch('/{id}', 'App\Http\Controllers\Dokter\ObatController@update')->name('dokter.obat.update');
        Route::delete('/{id}', 'App\Http\Controllers\Dokter\ObatController@destroy')->name('dokter.obat.destroy');
    });
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
        // dd("Ini adalah dashboard pasien");
    })->name('pasien.dashboard');
});


require __DIR__ . '/auth.php';
