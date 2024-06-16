<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DevisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\DataPribadiController;
use App\Http\Controllers\DataPelamarController;
use App\Http\Controllers\DataKaryawanController;
use App\Http\Controllers\DataKeluargaIntiController;
use App\Http\Controllers\DataKeluargaKandungController;
use App\Http\Controllers\DataPendidikanController;
use App\Http\Controllers\PelatihanSertifikatController;
use App\Http\Controllers\PengalamanKerjaController;
use App\Http\Controllers\BahasaAsingController;
use App\Http\Controllers\DataTampungController;
use App\Http\Controllers\PengaturanPresensiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RekapPresensiController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use App\Models\data_pribadi;

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

// Rute untuk halaman login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();

        if (Auth::user()->role === 'Karyawan' && $data_pribadi->status_isi == '1') {
            return redirect('presensi');
        } else {
            return redirect('data_karyawan');
        }
    });

    // Rute yang hanya bisa diakses oleh HRD
    Route::middleware(['can:hrd'])->group(function () {
        Route::resource('/devisi', DevisiController::class);
        Route::resource('/jabatan', JabatanController::class);
        Route::resource('/data_pelamar', DataPelamarController::class);
        Route::resource('/data_pribadi', DataPribadiController::class);
        Route::resource('/data_karyawan', DataKaryawanController::class);
        Route::resource('/data_keluarga_inti', DataKeluargaIntiController::class);
        Route::resource('/data_keluarga_kandung', DataKeluargaKandungController::class);
        Route::resource('/data_pendidikan', DataPendidikanController::class);
        Route::resource('/pelatihan_sertifikat', PelatihanSertifikatController::class);
        Route::resource('/pengalaman_kerja', PengalamanKerjaController::class);
        Route::resource('/bahasa_asing', BahasaAsingController::class);
        Route::resource('/presensi', PresensiController::class);
        Route::resource('/rekap_presensi', RekapPresensiController::class);
        Route::resource('/pengaturan_presensi', PengaturanPresensiController::class);
        Route::resource('/profil', ProfilController::class);
    });

    // Rute yang hanya bisa diakses oleh Karyawan
    Route::middleware(['can:karyawan'])->group(function () {
        Route::resource('/data_pribadi', DataPribadiController::class);
        Route::resource('/data_keluarga_inti', DataKeluargaIntiController::class);
        Route::resource('/data_keluarga_kandung', DataKeluargaKandungController::class);
        Route::resource('/data_pendidikan', DataPendidikanController::class);
        Route::resource('/pelatihan_sertifikat', PelatihanSertifikatController::class);
        Route::resource('/pengalaman_kerja', PengalamanKerjaController::class);
        Route::resource('/bahasa_asing', BahasaAsingController::class);
        Route::resource('/data_tampung', DataTampungController::class);
        Route::resource('/presensi', PresensiController::class);
        Route::post('/presensi/store', [PresensiController::class, 'store']);
        Route::resource('/profil', ProfilController::class);
    });    
});

require __DIR__.'/auth.php';
