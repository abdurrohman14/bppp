<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KualitasAir extends Model
{
    protected $fillable = [
        'kolam_id', 'tanggal_pengukuran', 'ph', 'temperatur', 'oksigen_terlarut'
    ];
    
    public function kolam()
    {
        return $this->belongsTo(Kolam::class, 'kolam_id');
    }
}
