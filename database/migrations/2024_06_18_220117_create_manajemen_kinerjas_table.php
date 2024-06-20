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
        Schema::create('manajemen_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->references('nik')->on('data_pribadis');
            $table->string('jenis');
            $table->string('foto')->nullable();
            $table->string('alasan');
            $table->string('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manajemen_kinerjas');
    }
};
