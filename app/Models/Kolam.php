<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KualitasAir;
use App\Models\PenebaranBenih;
use App\Models\Kematian;
use App\Models\Panen;
use App\Models\PakanKeluar;

class Kolam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'budaya', 'status', 'jumlah_ikan'
    ];

    // Relasi ke kualitas air
    public function kualitasAir()
    {
        return $this->hasMany(KualitasAir::class);
    }

    // Relasi ke penebaran benih
    public function penebaran()
    {
        return $this->hasMany(PenebaranBenih::class);
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

    // Relasi ke pakan keluar
    public function pakanKeluar()
    {
        return $this->hasMany(PakanKeluar::class);
    }
}
