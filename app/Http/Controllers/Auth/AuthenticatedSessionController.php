<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\data_pribadi;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();

        // Redirect berdasarkan peran user
        if (Auth::user()->role === 'Karyawan' && $data_pribadi->status_isi == '1') {
            return redirect()->intended('/presensi');
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        // return redirect()->intended('/data_karyawan');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
