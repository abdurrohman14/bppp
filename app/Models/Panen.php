<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    // Format tanggal untuk kolom tanggal_panen
    protected $dates = [
        'tanggal_panen',
    ];

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'kolam_id',
        'spesies_id',
        'tanggal_panen',
        'berat_total',
        'jumlah_ikan',
        'harga_per_kg',
        'tujuan_distribusi'
    ];

    // Relasi ke kolam
    public function kolam()
    {
        return $this->belongsTo(Kolam::class);
    }

    // Relasi ke spesies
    public function spesies()
    {
        return $this->belongsTo(Spesies::class);
    }
}
