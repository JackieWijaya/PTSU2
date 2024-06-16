<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_tampungs', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable();
            $table->string('status_keluarga_inti')->nullable();
            $table->string('nama_anggota_keluarga_inti')->nullable();
            $table->string('ktp_pasangan')->nullable();
            $table->string('tempat_lahir_inti')->nullable();
            $table->date('tanggal_lahir_inti')->nullable();
            $table->string('pendidikan_inti')->nullable();
            $table->string('pekerjaan_inti')->nullable();
            $table->string('status_keluarga_kandung')->nullable();
            $table->string('nama_anggota_keluarga_kandung')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir_kandung')->nullable();
            $table->date('tanggal_lahir_kandung')->nullable();
            $table->string('pendidikan_kandung')->nullable();
            $table->string('pekerjaan_kandung')->nullable();
            $table->enum('jenjang', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2'])->nullable();
            $table->string('fakultas')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('tahun_masuk')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('nama_lembaga')->nullable();
            $table->string('jenis')->nullable();
            $table->date('mulai_pelatihan')->nullable();
            $table->date('akhir_pelatihan')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('mulai_kerja')->nullable();
            $table->date('akhir_kerja')->nullable();
            $table->string('gaji')->nullable();
            $table->text('alasan_keluar')->nullable();
            $table->enum('lisan', ['Cukup', 'Sedang', 'Baik'])->nullable();
            $table->enum('tulisan', ['Cukup', 'Sedang', 'Baik'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_tampungs');
    }
};
