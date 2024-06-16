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
        Schema::create('data_pelamars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->string('alamat');
            $table->string('pendidikan_terakhir');
            $table->string('no_hp');
            $table->string('email');
            $table->string('agama');
            $table->string('golongan_darah');
            $table->string('status_kawin')->nullable();
            $table->date('tanggal_nikah')->nullable();
            $table->string('buku_nikah')->nullable();
            $table->enum('status', ['Diterima', 'Ditolak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pelamars');
    }
};
