<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pakanKeluar extends Model
{
    protected $fillable = [
        'pakan_id', 'kolam_id','spesies_id','tanggal_keluar', 'jumlah_keluar'
    ];
}
