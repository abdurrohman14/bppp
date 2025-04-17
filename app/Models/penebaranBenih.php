<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penebaranBenih extends Model
{
    protected $fillable = [
        'kolam_id', 'spesies_id', 'ukuran', 'asal_benih', 'tanggal_tebar', 'jumlah_benih'
    ];

    public function kolam() {
        return $this->belongsTo(Kolam::class);
    }

    public function spesies() {
        return $this->belongsTo(Spesies::class);
    }
}
