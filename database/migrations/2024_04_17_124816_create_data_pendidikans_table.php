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
        Schema::create('data_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pribadis_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('jenjang', ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2']);
            $table->string('fakultas');
            $table->string('nama_sekolah');
            $table->string('jurusan');
            $table->string('tahun_masuk');
            $table->string('tahun_lulus');
            $table->string('status_isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pendidikans');
    }
};
