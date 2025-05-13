<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spesies;

class JadwalPakan extends Model
{
    protected $casts = [
        'jadwal_pakan' => 'array',
    ];
    // Tentukan nama tabel yang digunakan
    protected $table = 'jadwal_pakans';

    // Kolom yang bisa diisi
    protected $fillable = ['spesies_id', 'jadwal_pakan'];

    // Relasi ke tabel spesies
    public function spesies()
    {
        return $this->belongsTo(Spesies::class, 'spesies_id');
    }
}
