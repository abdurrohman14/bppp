<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PakanKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'pakan_id',
        'kolam_id',
        'spesies_id',
        'tanggal_keluar',
        'jumlah_keluar',
    ];

    // Relasi dengan Kolam
    public function kolam()
    {
        return $this->belongsTo(Kolam::class);
    }

    // Relasi dengan Spesies
    public function spesies()
    {
        return $this->belongsTo(Spesies::class);
    }

    // Relasi dengan Pakan
    public function pakan()
    {
        return $this->belongsTo(Pakan::class);
    }
}
