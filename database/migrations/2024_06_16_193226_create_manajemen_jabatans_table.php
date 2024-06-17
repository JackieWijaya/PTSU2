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
        Schema::create('manajemen_jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->references('nik')->on('data_pribadis');
            $table->string('jenis');
            $table->string('devisi_lama')->references('id')->on('devisis');
            $table->string('jabatan_lama')->references('id')->on('jabatans');
            $table->string('devisi_baru')->references('id')->on('devisis');
            $table->string('jabatan_baru')->references('id')->on('jabatans');
            $table->string('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manajemen_jabatans');
    }
};
