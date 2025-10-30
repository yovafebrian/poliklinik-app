<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    // tampilkan form pendaftaran pasien
    public function get()
    {
        $user = Auth::user();
        $polis = Poli::all();

        // ambil semua jadwal (atau sesuaikan filter jika mau per poli)
        $jadwals = JadwalPeriksa::with(['dokter', 'dokter.poli'])->get();

        return view('pasien.daftar', [
            'user' => $user,
            'polis' => $polis,
            'jadwals' => $jadwals,
        ]);
    }

    // proses submit pendaftaran
    public function submit(Request $request)
    {
        $request->validate([
            'id_poli' => 'required|exists:poli,id',
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'nullable|string|max:255',
            'id_pasien' => 'required|exists:users,id',
        ]);

        $jumlahSudahDaftar = DaftarPoli::where('id_jadwal', $request->id_jadwal)->count();

        DaftarPoli::create([
            'id_pasien' => $request->id_pasien,
            'id_poli' => $request->id_poli,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $jumlahSudahDaftar + 1,
        ]);

        return redirect()->back()->with([
            'message' => 'Pendaftaran berhasil',
            'type' => 'success'
        ]);
    }
}
