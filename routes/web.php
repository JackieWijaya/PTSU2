<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DevisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisCutiController;
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
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RekapPresensiController;
use App\Http\Controllers\ManajemenJabatanController;
use App\Http\Controllers\PHKController;
use App\Http\Controllers\StatusPHKController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\ManajemenKinerjaController;
use App\Http\Controllers\PengaturanPresensiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    if (Auth::user()) {
        return redirect('/dashboard');

    }

    return view('auth.login');
});

Route::resource('/dashboard', DashboardController::class)->middleware(['auth', 'verified']);
Route::resource('/devisi', DevisiController::class)->middleware(['auth', 'verified']);
Route::resource('/jabatan', JabatanController::class)->middleware(['auth', 'verified']);
Route::resource('/jenis_cuti', JenisCutiController::class)->middleware(['auth', 'verified']);
Route::resource('/data_pelamar', DataPelamarController::class);
Route::resource('/data_pribadi', DataPribadiController::class)->middleware(['auth', 'verified']);
Route::resource('/data_karyawan', DataKaryawanController::class)->middleware(['auth', 'verified']);
Route::resource('/data_keluarga_inti', DataKeluargaIntiController::class)->middleware(['auth', 'verified']);
Route::resource('/data_keluarga_kandung', DataKeluargaKandungController::class)->middleware(['auth', 'verified']);
Route::resource('/data_pendidikan', DataPendidikanController::class)->middleware(['auth', 'verified']);
Route::resource('/pelatihan_sertifikat', PelatihanSertifikatController::class)->middleware(['auth', 'verified']);
Route::resource('/pengalaman_kerja', PengalamanKerjaController::class)->middleware(['auth', 'verified']);
Route::resource('/bahasa_asing', BahasaAsingController::class)->middleware(['auth', 'verified']);
Route::resource('/data_tampung', DataTampungController::class)->middleware(['auth', 'verified']);
Route::resource('/presensi', PresensiController::class)->middleware(['auth', 'verified']);
Route::post('/presensi/store', [PresensiController::class, 'store'])->middleware(['auth', 'verified']);
Route::resource('/rekap_presensi', RekapPresensiController::class)->middleware(['auth', 'verified']);
Route::resource('/manajemen_jabatan', ManajemenJabatanController::class)->middleware(['auth', 'verified']);
Route::get('/get_devisi_jabatan', [ManajemenJabatanController::class, 'getDevisiJabatan'])->name('getDevisiJabatan');
Route::resource('/phk', PHKController::class)->middleware(['auth', 'verified']);
Route::resource('/status_phk', StatusPHKController::class)->middleware(['auth', 'verified']);
Route::resource('/cuti', CutiController::class)->middleware(['auth', 'verified']);
Route::post('/cuti/getsisacuti', [CutiController::class, 'getsisacuti'])->middleware(['auth', 'verified']);
Route::resource('/manajemen_kinerja', ManajemenKinerjaController::class)->middleware(['auth', 'verified']);
Route::resource('/pengaturan_presensi', PengaturanPresensiController::class)->middleware(['auth', 'verified']);
Route::resource('/profil', ProfilController::class)->middleware(['auth', 'verified']);

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
