<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kualitasAir extends Model
{
    protected $fillable = [
        'kolam_id', 'tanggal_pengukuran', 'pH', 'temperature', 'do'
    ];
}
