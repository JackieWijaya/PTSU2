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
        Schema::create('bahasa_asings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pribadis_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('lisan', ['Cukup', 'Sedang', 'Baik']);
            $table->enum('tulisan', ['Cukup', 'Sedang', 'Baik']);
            $table->string('status_isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahasa_asings');
    }
};
