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
        $riwayatPasien = Periksa::with([
            'daftarPoli.user',
            'daftarPoli.jadwalPeriksa.dokter',
            'detailPeriksas.obat'
        ])->orderBy('tanggal_periksa', 'desc')->get();
    return view('dokter.riwayat-pasien.index', compact('riwayatPasien'));
    }

    public function show($id)
    {
        $periksa = Periksa::with([
            'daftarPoli.user',
            'daftarPoli.jadwalPeriksa.dokter',
            'detailPeriksas.obat'
        ])->findOrFail($id);

        return view('dokter.riwayat-pasien.show', compact('periksa'));
    }
}