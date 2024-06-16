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
        Schema::create('data_pribadis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
            $table->string('ktp')->nullable();
            $table->string('rekening')->nullable();
            $table->string('sim')->nullable();
            $table->string('kk')->nullable();
            $table->string('bpjs_ketenagakerjaan')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            $table->string('npwp')->nullable();
            $table->string('nik')->nullable();
            $table->foreignId('jabatans_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('devisis_id')->references('id')->on('devisis')->nullable();
            $table->date('tanggal_masuk_kerja')->nullable();
            $table->date('tanggal_berakhir_kerja')->nullable();
            $table->string('golongan')->nullable();
            $table->string('status_isi')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pribadis');
    }
};
