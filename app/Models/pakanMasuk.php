<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PakanMasuk extends Model
{
    protected $fillable = [
        'pakan_id', 'tanggal_masuk', 'jumlah_masuk'
    ];

    public function pakan()
    {
        return $this->belongsTo(Pakan::class, 'pakan_id');
    }
}
