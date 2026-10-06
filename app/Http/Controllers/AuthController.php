<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Pelanggan;

class AuthController extends Controller
{
    // =====================================================
    // LOGIN
    // =====================================================

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // Jika Admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Jika Pelanggan
            if ($user->role === 'pelanggan') {
                return redirect()->route('pelanggan.beranda');
            }

            // Jika role tidak dikenali
            Auth::logout();

            return back()->withErrors([
                'username' => 'Role akun tidak dikenali.',
            ])->onlyInput('username');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }


    // =====================================================
    // REGISTER
    // =====================================================

    public function showRegister()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $data = $request->validate([

            'nama' => 'required|string|max:100',

            'username' => 'required|string|max:50|unique:users,username',

            'password' => 'required|min:6|confirmed',

            'no_hp' => 'required|string|max:20',

            'email' => 'required|email|max:100|unique:pelanggan,email',

            'alamat' => 'required|string',

        ]);


        DB::transaction(function () use ($data) {

            // =================================================
            // MEMBUAT ID USER
            // =================================================

            $nomorUser = 1;

            while (
                User::where(
                    'id_user',
                    'USR' . str_pad(
                        $nomorUser,
                        3,
                        '0',
                        STR_PAD_LEFT
                    )
                )->exists()
            ) {

                $nomorUser++;
            }

            $idUser = 'USR' . str_pad(
                $nomorUser,
                3,
                '0',
                STR_PAD_LEFT
            );


            // =================================================
            // SIMPAN USER
            // =================================================

            $user = User::create([

                'id_user' => $idUser,

                'nama' => $data['nama'],

                'username' => $data['username'],

                'password' => $data['password'],

                'role' => 'pelanggan',

            ]);


            // =================================================
            // MEMBUAT ID PELANGGAN
            // =================================================

            $nomorPelanggan = 1;

            while (
                Pelanggan::where(
                    'id_pelanggan',
                    'PLG' . str_pad(
                        $nomorPelanggan,
                        3,
                        '0',
                        STR_PAD_LEFT
                    )
                )->exists()
            ) {

                $nomorPelanggan++;
            }

            $idPelanggan = 'PLG' . str_pad(
                $nomorPelanggan,
                3,
                '0',
                STR_PAD_LEFT
            );


            // =================================================
            // SIMPAN DATA PELANGGAN
            // =================================================

            Pelanggan::create([

                'id_pelanggan' => $idPelanggan,

                'id_user' => $user->id_user,

                'no_hp' => $data['no_hp'],

                'email' => $data['email'],

                'alamat' => $data['alamat'],

            ]);
        });


        // =====================================================
        // SELESAI REGISTER
        // =====================================================

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Pendaftaran berhasil. Silakan login menggunakan akun Anda.'
            );
    }

    // =====================================================
    // UPDATE PROFIL
    // =====================================================
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'nama' => 'required|string|max:100', 
            'no_hp' => 'required|string|max:20', 
            'email' => ['required', 'email', 'max:100', 'unique:pelanggan,email,' . optional($user->pelanggan)->id_pelanggan . ',id_pelanggan',], 
            'alamat' => 'required|string',]);
        DB::transaction(function () use ($user, $data) {
            User::where('id_user', $user->id_user)
            ->update([
                'nama' => $data['nama'],
                ]);

            if ($user->pelanggan) {
                Pelanggan::where(
                    'id_pelanggan', 
                    $user->pelanggan->id_pelanggan
                    )->update([
                        'no_hp' => $data['no_hp'], 
                        'email' => $data['email'], 
                        'alamat' => $data['alamat'],
                        ]);
            }
        });
        return redirect()
        ->route('pelanggan.profil')
        ->with(
            'success', 
            'Profil berhasil diperbarui.'
            );
    }


    // =====================================================
    // LOGOUT
    // =====================================================

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
