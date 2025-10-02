<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $credentials = $request->only([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->role == 'admin'){
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'dokter'){
                return redirect()->route('dokter.dashboard');
            }else{
                return redirect()->route('pasien.dashboard');
            }
            return back()->withErrors(['Email' => 'Email atau Password salah' ]);
        }
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' .User::class],
            'password' => ['required','confirmed'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'numeric', 'max:15'],
            'no_ktp' => ['required', 'numeric', 'max:20'],
        ]);
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
