<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    protected $fillable = [
        'kolam_id',
        'spesies_id',
        'tanggal_panen',
        'berat_total',
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
