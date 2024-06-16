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
        Schema::create('pelatihan_sertifikats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pribadis_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_lembaga');
            $table->string('jenis');
            $table->date('mulai');
            $table->date('akhir');
            $table->string('sertifikat');
            $table->string('status_isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihan_sertifikats');
    }
};
