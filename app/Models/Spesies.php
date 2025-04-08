<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spesies extends Model
{
    protected $fillable = [
        'jenis_ikan', 'deskripsi'
    ];
}
