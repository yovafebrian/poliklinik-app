<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    // nentuin nama tabel yang digunakan
    protected $table = 'detail_periksas';

    protected $fillable = [
        'id_periksa',
        'id_obat',
    ];

    public function periksa()
    {
        // nentuin foreign key 'id_periksa' yang menuju ke model Periksa
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }

    public function obat()
    {
        // nentuin foreign key 'id_obat' yang menuju ke model Obat
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
