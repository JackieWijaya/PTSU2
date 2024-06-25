<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\devisi;
use App\Models\jabatan;
use App\Models\data_pelamar;
use App\Models\data_pribadi;
use App\Models\jenis_cuti;
use App\Models\pengaturan_presensi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::query()->create([
            'name'     => 'Manager',
            'no_hp'    => '081234567890',
            'password' => '081234567890',
            'role'     => 'Manager',
        ]);
        User::query()->create([
            'name'     => 'HRD',
            'no_hp'    => '081234567891',
            'password' => '081234567891',
            'role'     => 'HRD',
        ]);
        User::query()->create([
            'name'     => 'Budi',
            'no_hp'    => '082345678901',
            'password' => '082345678901',
        ]);
        User::query()->create([
            'name'     => 'Dewi',
            'no_hp'    => '083456789012',
            'password' => '083456789012',
        ]);
        User::query()->create([
            'name'     => 'M. Fadli Yuda',
            'no_hp'    => '085678901234',
            'password' => '085678901234',
        ]);

        devisi::query()->create([
            'nama_devisi' => 'Keuangan',
        ]);
        devisi::query()->create([
            'nama_devisi' => 'Personalia & Umum',
        ]);
        devisi::query()->create([
            'nama_devisi' => 'Pemasaran & Penjualan',
        ]);
        devisi::query()->create([
            'nama_devisi' => 'Operasional',
        ]);
        devisi::query()->create([
            'nama_devisi' => 'Bengkel',
        ]);

        jabatan::query()->create([
            'nama_jabatan' => 'Pembukuan',
        ]);
        jabatan::query()->create([
            'nama_jabatan' => 'Pajak',
        ]);
        jabatan::query()->create([
            'nama_jabatan' => 'IT',
        ]);
        jabatan::query()->create([
            'nama_jabatan' => 'Adm Umum',
        ]);
        jabatan::query()->create([
            'nama_jabatan' => 'Marketing',
        ]);
        jabatan::query()->create([
            'nama_jabatan' => 'Sales Alat Berat',
        ]);
        jabatan::query()->create([
            'nama_jabatan' => 'Sales Angkutan Berat',
        ]);
        jabatan::query()->create([
            'nama_jabatan' => 'Operasional Alat Berat',
        ]);
        jabatan::query()->create([
            'nama_jabatan' => 'Operasional Angkutan Berat',
        ]);
        jabatan::query()->create([
            'nama_jabatan' => 'Mekanik',
        ]);
        jabatan::query()->create([
            'nama_jabatan' => 'Gudang',
        ]);

        jenis_cuti::query()->create([
            'nama_jenis_cuti' => 'Tahunan',
            'jatah'           => '12'
        ]);
        jenis_cuti::query()->create([
            'nama_jenis_cuti' => 'Sakit',
            'jatah'           => '15'
        ]);
        jenis_cuti::query()->create([
            'nama_jenis_cuti' => 'Hamil dan Melahirkan',
            'jatah'           => '90'
        ]);
        jenis_cuti::query()->create([
            'nama_jenis_cuti' => 'Pernikahan',
            'jatah'           => '3'
        ]);

        data_pelamar::query()->create([
            'nama_lengkap'        => 'Jackie',
            'tanggal_lahir'       => '2002-06-19',
            'jenis_kelamin'       => 'Laki-Laki',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Abdul Rozak',
            'pendidikan_terakhir' => 'SMA',
            'no_hp'               => '081243485171',
            'email'               => 'jackie@gmail.com',
            'agama'               => 'Buddha',
            'golongan_darah'      => 'A',
            'status_kawin'        => 'TK',
        ]);
        data_pelamar::query()->create([
            'nama_lengkap'        => 'Budi',
            'tanggal_lahir'       => '2002-12-12',
            'jenis_kelamin'       => 'Laki-Laki',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Mawar No. 1',
            'pendidikan_terakhir' => 'SMA',
            'no_hp'               => '082345678901',
            'email'               => 'budi@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'B',
            'status_kawin'        => 'TK',
            'status'              => 'Diterima',
        ]);
        data_pelamar::query()->create([
            'nama_lengkap'        => 'Dewi',
            'tanggal_lahir'       => '2002-06-12',
            'jenis_kelamin'       => 'Perempuan',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Anggrek Lr. Damai No. 126',
            'pendidikan_terakhir' => 'S1',
            'no_hp'               => '083456789012',
            'email'               => 'dewi@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'O',
            'status_kawin'        => 'K0',
            'tanggal_nikah'       => '2020-06-12',
            'buku_nikah'          => 'DEWI.jpg',
            'status'              => 'Diterima',
        ]);
        data_pelamar::query()->create([
            'nama_lengkap'        => 'Yanto',
            'tanggal_lahir'       => '2002-02-07',
            'jenis_kelamin'       => 'Laki-Laki',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Abdul Rozak No. 126',
            'pendidikan_terakhir' => 'S1',
            'no_hp'               => '084567890123',
            'email'               => 'yanto@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'A',
            'status_kawin'        => 'K2',
            'tanggal_nikah'       => '2020-02-07',
            'buku_nikah'          => 'YANTO.jpg',
            'status'              => 'Ditolak',
        ]);
        data_pelamar::query()->create([
            'nama_lengkap'        => 'M. Fadli Yuda',
            'tanggal_lahir'       => '2002-03-13',
            'jenis_kelamin'       => 'Laki-Laki',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Anggrek Lr. Damai No. 16',
            'pendidikan_terakhir' => 'S1',
            'no_hp'               => '085678901234',
            'email'               => 'fadli@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'A',
            'status_kawin'        => 'K1',
            'tanggal_nikah'       => '2020-03-13',
            'buku_nikah'          => 'M. FADLI YUDA.jpg',
            'status'              => 'Diterima',
        ]);

        data_pribadi::query()->create([
            'users_id'            => '3',
            'nama_lengkap'        => 'Budi',
            'tanggal_lahir'       => '2002-12-12',
            'jenis_kelamin'       => 'Laki-Laki',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Mawar No. 1',
            'pendidikan_terakhir' => 'SMA',
            'no_hp'               => '082345678901',
            'email'               => 'budi@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'B',
            'status_kawin'        => 'TK',
        ]);
        data_pribadi::query()->create([
            'users_id'            => '4',
            'nama_lengkap'        => 'Dewi',
            'tanggal_lahir'       => '2002-06-12',
            'jenis_kelamin'       => 'Perempuan',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Anggrek Lr. Damai No. 126',
            'pendidikan_terakhir' => 'S1',
            'no_hp'               => '083456789012',
            'email'               => 'dewi@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'O',
            'status_kawin'        => 'K0',
            'tanggal_nikah'       => '2020-06-12',
            'buku_nikah'          => 'DEWI.jpg',
        ]);
        data_pribadi::query()->create([
            'users_id'            => '5',
            'nama_lengkap'        => 'M. Fadli Yuda',
            'tanggal_lahir'       => '2002-03-13',
            'jenis_kelamin'       => 'Laki-Laki',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Anggrek Lr. Damai No. 16',
            'pendidikan_terakhir' => 'S1',
            'no_hp'               => '085678901234',
            'email'               => 'fadli@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'A',
            'status_kawin'        => 'K1',
            'tanggal_nikah'       => '2020-03-13',
            'buku_nikah'          => 'M. FADLI YUDA.jpg',
        ]);

        pengaturan_presensi::query()->create([
            'lokasi'     => '-2.973488594813909, 104.76410656834805',
            'radius'     => '30',
            'jam_masuk'  => '08:00:00',
            'jam_keluar' => '17:00:00',
        ]);
    }
}
