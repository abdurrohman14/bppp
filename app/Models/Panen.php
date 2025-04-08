<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    protected $fillable = [
        'kolam_id', 'spesies_id', 'tanggal_panen', 'berat_total', 'harga_per_kg', 'distribusi'
    ];
}
