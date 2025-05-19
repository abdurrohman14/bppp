<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kolam extends Model
{
    protected $fillable = [
        'nama', 'budaya', 'status', 'jumlah_ikan'
    ];

    // Relasi ke kualitas air
    public function kualitasAir()
    {
        return $this->hasMany(KualitasAir::class);
    }

    // Relasi ke penebaran
    public function penebaran()
    {
        return $this->hasMany(penebaranBenih::class);
    }

    // Relasi ke mortalitas
    public function mortalitas()
    {
        return $this->hasMany(Kematian::class);
    }

    // Relasi ke panen
    public function panen()
    {
        return $this->hasMany(Panen::class);
    }
}
