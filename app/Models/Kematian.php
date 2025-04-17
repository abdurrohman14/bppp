<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    protected $fillable = [
        'kolam_id', 'spesies_id', 'tanggal_kematian', 'jumlah_kematian', 'penyebab'
    ];

    public function kolam() {
        return $this->belongsTo(Kolam::class);
    }

    public function spesies() {
        return $this->belongsTo(Spesies::class);
    }
}
