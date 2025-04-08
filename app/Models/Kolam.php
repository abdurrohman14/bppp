<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kolam extends Model
{
    protected $fillable = [
        'nama', 'budaya', 'status', 'jumlah_ikan'
    ];
}
