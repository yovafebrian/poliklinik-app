<?php

namespace App\Http\Controllers;

use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //1. ambil user dari auth
        $dokter = Auth::user();

        //2. ambil id_dokter hanya ambil hari
        $jadwalPeriksas = JadwalPeriksa::where('id_dokter', $dokter->id)
            ->orderBy('hari') 
            ->get();

        return view('dokter.jadwal-periksa.index', compact('jadwalPeriksas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dokter.jadwal-periksa.create');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalPeriksa::create([
            'id_dokter' => Auth::user()->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('jadwal-periksa.index')
        ->with('success', 'Jadwal Periksa berhasil ditambahkan.')
        ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        return view('dokter.jadwal-periksa.edit', compact('jadwalPeriksa'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'hari' => 'required|string|max:10',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwalPeriksa =JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);

        return redirect()->route('jadwal-periksa.index')
        ->with('success', 'Jadwal Periksa berhasil diupdate.')
        ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->delete();

        return redirect()->route('jadwal-periksa.index')
        ->with('success', 'Jadwal Periksa berhasil dihapus.')
        ->with('type', 'success');
    }
}
