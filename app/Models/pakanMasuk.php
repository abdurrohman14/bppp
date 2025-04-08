<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pakanMasuk extends Model
{
    protected $fillable = [
        'pakan_id', 'tanggal_masuk', 'jumlah_masuk'
    ];
}
