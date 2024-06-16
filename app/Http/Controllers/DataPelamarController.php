<?php

namespace App\Http\Controllers;

use App\Models\data_pelamar;
use App\Models\data_pribadi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataPelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()) {
            $data_pelamars = data_pelamar::all();
            return view('data_pelamar.index')->with('data_pelamars', $data_pelamars);
        } else {
            return view('data_pelamar.create');
        }
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
            $request->buku_nikah->storeAs('public/BukuNikah', $buku_nikah);
        }

        $data_pelamar = new data_pelamar();
        $data_pelamar->nama_lengkap        = $validateData['nama_lengkap'];
        $data_pelamar->jenis_kelamin       = $validateData['jenis_kelamin'];
        $data_pelamar->tanggal_lahir       = $validateData['tanggal_lahir'];
        $data_pelamar->tempat_lahir        = $validateData['tempat_lahir'];
        $data_pelamar->no_hp               = $validateData['no_hp'];
        $data_pelamar->email               = $validateData['email'];
        $data_pelamar->alamat              = $validateData['alamat'];
        $data_pelamar->pendidikan_terakhir = $validateData['pendidikan_terakhir'];
        $data_pelamar->agama               = $validateData['agama'];
        $data_pelamar->golongan_darah      = $validateData['golongan_darah'];
        $data_pelamar->status_kawin        = $validateData['status_kawin'];
        $data_pelamar->tanggal_nikah       = $tanggal_nikah;
        $data_pelamar->buku_nikah          = $buku_nikah;

        // Ambil jumlah data_pelamar berdasarkan no_hp
        $dataCount = data_pelamar::where('no_hp', $validateData['no_hp'])->count();
        // dd($dataCount);

        if ($dataCount > 0) {
            Alert::error('Gagal', "Maaf Kamu Hanya Bisa Mengirim Data Sekali Saja, Silakan Hubungi Pihak IT");
            return view('data_pelamar.create');
        } else {
            $data_pelamar->save();
            Alert::success('Data Terkirim', "Terima Kasih Data Kamu Segera Diproses");
            return view('data_pelamar.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_pelamar $data_pelamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // Temukan berdasarkan ID
        $update_status = $request->input('status');
        $data_pelamar = data_pelamar::findOrFail($id);
        $data_pelamar->status = $update_status;
        $data_pelamar->update();

        if($data_pelamar->status == 'Diterima'){
            $user = New User();
            $user->name     = $data_pelamar->nama_lengkap;
            $user->no_hp    = $data_pelamar->no_hp;
            $user->password = $data_pelamar->no_hp;
            $user->save();  

            $user = User::where('no_hp', $data_pelamar->no_hp)->first();

            $data_pribadi = New data_pribadi();
            $data_pribadi->users_id            = $user->id;
            $data_pribadi->nama_lengkap        = $data_pelamar->nama_lengkap;
            $data_pribadi->jenis_kelamin       = $data_pelamar->jenis_kelamin;
            $data_pribadi->tanggal_lahir       = $data_pelamar->tanggal_lahir;
            $data_pribadi->tempat_lahir        = $data_pelamar->tempat_lahir;
            $data_pribadi->no_hp               = $data_pelamar->no_hp;
            $data_pribadi->email               = $data_pelamar->email;
            $data_pribadi->alamat              = $data_pelamar->alamat;
            $data_pribadi->pendidikan_terakhir = $data_pelamar->pendidikan_terakhir;
            $data_pribadi->agama               = $data_pelamar->agama;
            $data_pribadi->golongan_darah      = $data_pelamar->golongan_darah;
            $data_pribadi->status_kawin        = $data_pelamar->status_kawin;
            $data_pribadi->tanggal_nikah       = $data_pelamar->tanggal_nikah;
            $data_pribadi->buku_nikah          = $data_pelamar->buku_nikah;
            $data_pribadi->save();

            // Modifikasi nomor WA
            $no_hp = $user->no_hp;
            // Hapus awalan "08" dan tambahkan kode negara "+62"
            $no_hp = "+62".substr($no_hp, 1);

            $pesan = "Selamat $data_pelamar->nama_lengkap, anda diterima di PT Sumatra Unggul. Silahkan login melalui link http://127.0.0.1:8000/ untuk melengkapi data. Berikut No HP: $data_pelamar->no_hp dan Password: $data_pelamar->no_hp anda untuk login. Terima Kasih";

            $url = "https://api.whatsapp.com/send?phone=".$no_hp."&text=".urlencode($pesan);
            
            // Redirect to WhatsApp with the message
            return redirect()->away($url);
        }

        return redirect()->route('data_pelamar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_pelamar $data_pelamar)
    {
        //
    }
}
