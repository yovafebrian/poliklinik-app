<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\WithoutErrorHandler;

class AuthController extends Controller
{
    //
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $credentials = $request->only('email', 'password');

        // coba login 
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->role == 'admin'){
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'dokter'){
                return redirect()->route('dokter.dashboard');
            }else{
                return redirect()->route('pasien.dashboard');
            }
        }
        return back()->withErrors(['Email' => 'Email atau Password salah' ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required','confirmed'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:15'],
            'no_ktp' => ['required', 'string', 'max:20'],
        ]);

        // cek apakah nomer ktp sudah 
        if (User::where('no_ktp', $request->no_ktp)->exists()) {
            return back()->withErrors(['no_ktp' => 'Nomer KTP sudah terdaftar.']);
        }

        $no_rm = date('Ym') . '-' . str_pad(
            User::where('role', 'pasien')->count() + 1,
            3,
            '0',
            STR_PAD_LEFT
        );

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'role' => 'pasien',
        ]);
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function dokter(){
        $data = Poli::with('dokters')->get();
        return view('dokter.index', compact('data'));
    }
}
