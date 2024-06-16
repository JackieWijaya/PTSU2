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
        Schema::create('data_keluarga_kandungs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pribadis_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('status_keluarga');
            $table->string('nama_anggota_keluarga');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('status_isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_keluarga_kandungs');
    }
};
