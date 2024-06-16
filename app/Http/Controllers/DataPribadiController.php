<?php

namespace App\Http\Controllers;

use App\Models\data_pribadi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DataPribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('data_pribadi.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Set default value for $tanggal_nikah
        $tanggal_nikah = $request->input('tanggal_nikah');

        // Check if the value is empty or '-'
        if(empty($tanggal_nikah) || $tanggal_nikah == '-') {
            $tanggal_nikah = null; // Set to null if empty or '-'
        }

        // 1. Validasi
        $validateData = $request->validate([
            'nama_lengkap'        => 'required', 
            'jenis_kelamin'       => 'required', 
            'tanggal_lahir'       => 'required', 
            'tempat_lahir'        => 'required', 
            'no_hp'               => 'required|numeric|gt:-1',
            'email'               => 'required|email',
            'alamat'              => 'required', 
            'pendidikan_terakhir' => 'required', 
            'agama'               => 'required', 
            'golongan_darah'      => 'required', 
            'status_kawin'        => 'required',
            'buku_nikah'          => 'image|max:800|mimes:jpg,jpeg,png'
        ],
        [
            'nama_lengkap.required'        => 'Nama Harus Diisi',
            'jenis_kelamin.required'       => 'Pilih Jenis Kelamin',
            'tanggal_lahir'                => 'Tanggal Lahir Harus Diisi',
            'tempat_lahir.required'        => 'Tempat Lahir Harus Diisi',
            'no_hp.required'               => 'No HP Harus Diisi',
            'no_hp.numeric'                => 'No HP Harus Angka',
            'email.required'               => 'Email Harus Diisi',
            'email.email'                  => 'Isi Dengan Email',
            'alamat.required'              => 'Alamat Harus Diisi',
            'pendidikan_terakhir.required' => 'Pilih Pendidikan Terakhir',
            'agama.required'               => 'Pilih Agama',
            'golongan_darah.required'      => 'Pilih Golongan Darah',
            'status_kawin.required'        => 'Pilih Status Kawin',
            'buku_nikah.image'             => 'File Harus Foto',   
            'buku_nikah.mimes'             => 'Format Harus .jpg/.jpeg/.png',
            'buku_nikah.max'               => 'Ukuran File Tidak Boleh Lebih Dari 800 KB'
        ]);

        $buku_nikah = '-';
        if($request->hasFile('buku_nikah')){
            $ext = $request->buku_nikah->getClientOriginalExtension();
            $buku_nikah = "buku_nikah-".time().".".$ext;
            $request->buku_nikah->storeAs('public/BukuNikah',$buku_nikah);
        }

        $data_pribadi = new data_pribadi();
        $data_pribadi->nama_lengkap        = $validateData['nama_lengkap'];
        $data_pribadi->jenis_kelamin       = $validateData['jenis_kelamin'];
        $data_pribadi->tanggal_lahir       = $validateData['tanggal_lahir'];
        $data_pribadi->tempat_lahir        = $validateData['tempat_lahir'];
        $data_pribadi->no_hp               = $validateData['no_hp'];
        $data_pribadi->email               = $validateData['email'];
        $data_pribadi->alamat              = $validateData['alamat'];
        $data_pribadi->pendidikan_terakhir = $validateData['pendidikan_terakhir'];
        $data_pribadi->agama               = $validateData['agama'];
        $data_pribadi->golongan_darah      = $validateData['golongan_darah'];
        $data_pribadi->status_kawin        = $validateData['status_kawin'];
        $data_pribadi->tanggal_nikah       = $tanggal_nikah;
        $data_pribadi->buku_nikah          = $buku_nikah;

        // Ambil jumlah data_pribadi berdasarkan no_hp
        $dataCount = data_pribadi::where('no_hp', $validateData['no_hp'])->count();
        // dd($dataCount);

        if ($dataCount > 0) {
            Alert::error('Gagal', "Maaf Kamu Hanya Bisa Mengirim Data Sekali Saja, Silakan Hubungi Pihak IT");
            return view('data_pribadi.create');
        } else {
            $data_pribadi->save();
            Alert::success('Data Terkirim', "Terima Kasih Data Kamu Segera Di Proses");
            return view('data_pribadi.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(data_pribadi $data_pribadi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_pribadi $data_pribadi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, data_pribadi $data_pribadi)
    {
        //
        // Set default value for $tanggal_nikah
        $tanggal_nikah = $request->input('tanggal_nikah');

        // Check if the value is empty or '-'
        if(empty($tanggal_nikah) || $tanggal_nikah == '-') {
            $tanggal_nikah = null; // Set to null if empty or '-'
        }

        $status_isi = $data_pribadi->status_isi;

        // 1. Validasi
        $validateData = $request->validate([
            'nama_lengkap'         => 'required', 
            'jenis_kelamin'        => 'required', 
            'tanggal_lahir'        => 'required', 
            'tempat_lahir'         => 'required', 
            'no_hp'                => 'required|numeric|gt:-1',
            'email'                => 'required|email',
            'alamat'               => 'required', 
            'pendidikan_terakhir'  => 'required', 
            'agama'                => 'required', 
            'golongan_darah'       => 'required', 
            'status_kawin'         => 'required',
            'buku_nikah'           => 'image|max:800|mimes:jpg,jpeg,png',
            'nik'                  => [
                'required',
                'numeric',
                'gt:-1',
                'digits_between:16,17',
                Rule::unique('data_pribadis')->ignore($status_isi == 2 ? $data_pribadi->id : null)
            ],
            'ktp'                  => [
                'image',
                'max:800',
                'mimes:jpg,jpeg,png',
                Rule::requiredIf($status_isi != 2)
            ],
            'rekening'             => 'image|max:800|mimes:jpg,jpeg,png',
            'sim'                  => 'image|max:800|mimes:jpg,jpeg,png',
            'kk'                   => [
                'image',
                'max:800',
                'mimes:jpg,jpeg,png',
                Rule::requiredIf($status_isi != 2)
            ],
            'bpjs_ketenagakerjaan' => 'image|max:800|mimes:jpg,jpeg,png',
            'bpjs_kesehatan'       => 'image|max:800|mimes:jpg,jpeg,png',
            'npwp'                 => 'image|max:800|mimes:jpg,jpeg,png'
        ], [
            'nama_lengkap.required'        => 'Nama Harus Diisi',
            'jenis_kelamin.required'       => 'Pilih Jenis Kelamin',
            'tanggal_lahir.required'       => 'Tanggal Lahir Harus Diisi',
            'tempat_lahir.required'        => 'Tempat Lahir Harus Diisi',
            'no_hp.required'               => 'No HP Harus Diisi',
            'no_hp.numeric'                => 'No HP Harus Angka',
            'email.required'               => 'Email Harus Diisi',
            'email.email'                  => 'Isi Dengan Email',
            'alamat.required'              => 'Alamat Harus Diisi',
            'pendidikan_terakhir.required' => 'Pilih Pendidikan Terakhir',
            'agama.required'               => 'Pilih Agama',
            'golongan_darah.required'      => 'Pilih Golongan Darah',
            'status_kawin.required'        => 'Pilih Status Kawin',
            'buku_nikah.image'             => 'File Harus Foto',   
            'buku_nikah.mimes'             => 'Format Harus .jpg/.jpeg/.png',
            'buku_nikah.max'               => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'nik.required'                 => 'NIK Harus Diisi',
            'nik.numeric'                  => 'NIK Harus Angka',
            'nik.gt'                       => 'NIK Tidak Boleh Min',
            'nik.digits_between'           => 'NIK Harus 16-17 Digit',
            'nik.unique'                   => 'NIK Sudah Terdaftar',
            'ktp.required_if'              => 'KTP Harus Diisi',
            'ktp.image'                    => 'File Harus Foto',   
            'ktp.mimes'                    => 'Format Harus .jpg/.jpeg/.png',
            'ktp.max'                      => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'rekening.image'               => 'File Harus Foto',   
            'rekening.mimes'               => 'Format Harus .jpg/.jpeg/.png',
            'rekening.max'                 => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'sim.image'                    => 'File Harus Foto',   
            'sim.mimes'                    => 'Format Harus .jpg/.jpeg/.png',
            'sim.max'                      => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'kk.required_if'               => 'KK Harus Diisi',
            'kk.image'                     => 'File Harus Foto',   
            'kk.mimes'                     => 'Format Harus .jpg/.jpeg/.png',
            'kk.max'                       => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'bpjs_ketenagakerjaan.image'   => 'File Harus Foto',   
            'bpjs_ketenagakerjaan.mimes'   => 'Format Harus .jpg/.jpeg/.png',
            'bpjs_ketenagakerjaan.max'     => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'bpjs_kesehatan.image'         => 'File Harus Foto',   
            'bpjs_kesehatan.mimes'         => 'Format Harus .jpg/.jpeg/.png',
            'bpjs_kesehatan.max'           => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
            'npwp.image'                   => 'File Harus Foto',   
            'npwp.mimes'                   => 'Format Harus .jpg/.jpeg/.png',
            'npwp.max'                     => 'Ukuran File Tidak Boleh Lebih Dari 800 KB'
        ]);

        if($request->hasFile('buku_nikah')){
            $nama_buku_nikah_lama = $data_pribadi->buku_nikah;
            Storage::delete(['public/BukuNikah/'.$nama_buku_nikah_lama]);
            $extbuku_nikah = $request->buku_nikah->getClientOriginalExtension();
            $nama_buku_nikah_baru = "buku_nikah-".time().".".$extbuku_nikah;
            $request->buku_nikah->storeAs('public/BukuNikah',$nama_buku_nikah_baru);
        } else {
            $validateData['buku_nikah'] = $data_pribadi->buku_nikah;
            $nama_buku_nikah_baru = $validateData['buku_nikah'];
        }

        if($request->hasFile('ktp')){
            $nama_ktp_lama = $data_pribadi->ktp;
            Storage::delete(['public/DataKaryawan/'.$nama_ktp_lama]);
            $extktp = $request->ktp->getClientOriginalExtension();
            $nama_ktp_baru = "ktp-".time().".".$extktp;
            $request->ktp->storeAs('public/DataKaryawan',$nama_ktp_baru);
        } else {
            $validateData['ktp'] = $data_pribadi->ktp;
            $nama_ktp_baru = $validateData['ktp'];
        }

        if($request->hasFile('kk')){
            $nama_kk_lama = $data_pribadi->kk;
            Storage::delete(['public/DataKaryawan/'.$nama_kk_lama]);
            $extkk = $request->kk->getClientOriginalExtension();
            $nama_kk_baru = "kk-".time().".".$extkk;
            $request->kk->storeAs('public/DataKaryawan',$nama_kk_baru);
        } else {
            $validateData['kk'] = $data_pribadi->kk;
            $nama_kk_baru = $validateData['kk'];
        }

        if($request->hasFile('rekening')){
            $nama_rekening_lama = $data_pribadi->rekening;
            Storage::delete(['public/DataKaryawan/'.$nama_rekening_lama]);
            $extrekening = $request->rekening->getClientOriginalExtension();
            $nama_rekening_baru = "rekening-".time().".".$extrekening;
            $request->rekening->storeAs('public/DataKaryawan',$nama_rekening_baru);
        } else {
            $validateData['rekening'] = $data_pribadi->rekening;
            $nama_rekening_baru = $validateData['rekening'];
        }

        if($request->hasFile('sim')){
            $nama_sim_lama = $data_pribadi->sim;
            Storage::delete(['public/DataKaryawan/'.$nama_sim_lama]);
            $extsim = $request->sim->getClientOriginalExtension();
            $nama_sim_baru = "sim-".time().".".$extsim;
            $request->sim->storeAs('public/DataKaryawan',$nama_sim_baru);
        } else {
            $validateData['sim'] = $data_pribadi->sim;
            $nama_sim_baru = $validateData['sim'];
        }

        if($request->hasFile('bpjs_ketenagakerjaan')){
            $nama_bpjs_ketenagakerjaan_lama = $data_pribadi->bpjs_ketenagakerjaan;
            Storage::delete(['public/DataKaryawan/'.$nama_bpjs_ketenagakerjaan_lama]);
            $extbpjsketenagakerjaan = $request->bpjs_ketenagakerjaan->getClientOriginalExtension();
            $nama_bpjs_ketenagakerjaan_baru = "bpjs_ketenagakerjaan-".time().".".$extbpjsketenagakerjaan;
            $request->bpjs_ketenagakerjaan->storeAs('public/DataKaryawan',$nama_bpjs_ketenagakerjaan_baru);
        } else {
            $validateData['bpjs_ketenagakerjaan'] = $data_pribadi->bpjs_ketenagakerjaan;
            $nama_bpjs_ketenagakerjaan_baru = $validateData['bpjs_ketenagakerjaan'];
        }

        if($request->hasFile('bpjs_kesehatan')){
            $nama_bpjs_kesehatan_lama = $data_pribadi->bpjs_kesehatan;
            Storage::delete(['public/DataKaryawan/'.$nama_bpjs_kesehatan_lama]);
            $extbpjskesehatan = $request->bpjs_kesehatan->getClientOriginalExtension();
            $nama_bpjs_kesehatan_baru = "bpjs_kesehatan-".time().".".$extbpjskesehatan;
            $request->bpjs_kesehatan->storeAs('public/DataKaryawan',$nama_bpjs_kesehatan_baru);
        } else {
            $validateData['bpjs_kesehatan'] = $data_pribadi->bpjs_kesehatan;
            $nama_bpjs_kesehatan_baru = $validateData['bpjs_kesehatan'];
        }

        if($request->hasFile('npwp')){
            $nama_npwp_lama = $data_pribadi->npwp;
            Storage::delete(['public/DataKaryawan/'.$nama_npwp_lama]);
            $extnpwp = $request->npwp->getClientOriginalExtension();
            $nama_npwp_baru = "npwp-".time().".".$extnpwp;
            $request->npwp->storeAs('public/DataKaryawan',$nama_npwp_baru);
        } else {
            $validateData['npwp'] = $data_pribadi->npwp;
            $nama_npwp_baru = $validateData['npwp'];
        }

        $status_isi = $request->input('status_isi');

        $data_pribadi->nama_lengkap         = $validateData['nama_lengkap'];
        $data_pribadi->jenis_kelamin        = $validateData['jenis_kelamin'];
        $data_pribadi->tanggal_lahir        = $validateData['tanggal_lahir'];
        $data_pribadi->tempat_lahir         = $validateData['tempat_lahir'];
        $data_pribadi->no_hp                = $validateData['no_hp'];
        $data_pribadi->email                = $validateData['email'];
        $data_pribadi->alamat               = $validateData['alamat'];
        $data_pribadi->pendidikan_terakhir  = $validateData['pendidikan_terakhir'];
        $data_pribadi->agama                = $validateData['agama'];
        $data_pribadi->golongan_darah       = $validateData['golongan_darah'];
        $data_pribadi->status_kawin         = $validateData['status_kawin'];
        $data_pribadi->tanggal_nikah        = $tanggal_nikah;
        $data_pribadi->buku_nikah           = $nama_buku_nikah_baru;
        $data_pribadi->ktp                  = $nama_ktp_baru;
        $data_pribadi->rekening             = $nama_rekening_baru;    
        $data_pribadi->sim                  = $nama_sim_baru;
        $data_pribadi->kk                   = $nama_kk_baru;
        $data_pribadi->bpjs_ketenagakerjaan = $nama_bpjs_ketenagakerjaan_baru;
        $data_pribadi->bpjs_kesehatan       = $nama_bpjs_kesehatan_baru;
        $data_pribadi->npwp                 = $nama_npwp_baru;
        $data_pribadi->nik                  = $validateData['nik'];
        $data_pribadi->status_isi           = $status_isi;
        $data_pribadi->update();

        if($data_pribadi->status_isi == '1' && $data_pribadi->status_kawin == 'TK') {
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_3');
        } else {
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_2');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_pribadi $data_pribadi)
    {
        //
    }
}
