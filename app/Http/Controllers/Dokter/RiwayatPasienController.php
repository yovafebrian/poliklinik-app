<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        // ngambil id dokter yg sedang login 
        $dokterId = Auth::id();

        // Menampilkan riwayat pasien yang diperiksa oleh dokter yang sedang login
        $riwayatPasien = Periksa::with([
            'daftarPoli.pasien',
            'daftarPoli.jadwalPeriksa.dokter',
            'detailPeriksas.obat'
        ])
        ->whereHas('daftarPoli.jadwalPeriksa', function ($query) use ($dokterId) {
            $query->where('id_dokter', $dokterId); // melakukan filter berdasarkan dokter yang sedang login
        })
        ->orderBy('tgl_periksa', 'desc')->get(); // ngurutin berdasarkan tanggal periksa terbaru

        // Menampilkan view dengan data riwayat pasien
        return view('dokter.riwayat-pasien.index', compact('riwayatPasien')); 
    }

    public function show($id)
    {
        $periksa = Periksa::with([
            'daftarPoli.pasien', // ngambil data pasien dari daftar poli 
            'daftarPoli.jadwalPeriksa.dokter.poli', // ngambil data dokter dan polinya dari jadwal periksa
            'detailPeriksas.obat'
        ])->findOrFail($id);

        return view('dokter.riwayat-pasien.show', compact('periksa')); 
    }
}