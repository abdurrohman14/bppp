<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pakan extends Model
{
    protected $fillable = [
        'jenis_pakan', 'asal_pakan', 'ukuran_pakan', 'jumlah_pakan'
    ];
}
