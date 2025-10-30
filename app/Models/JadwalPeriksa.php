<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    //
    protected $table = 'jadwal_periksas';

    protected $fillable = [
        'id_dokter',
        'id_poli',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function daftar_polis()
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }
}
