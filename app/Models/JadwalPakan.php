<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spesies;

class JadwalPakan extends Model
{
    // Tentukan nama tabel yang digunakan
    protected $table = 'jadwal_pakans';

    // Kolom yang bisa diisi
    protected $fillable = ['spesies_id', 'jadwal_pakan'];

    protected $casts = [
        'jadwal_pakan' => 'array',
    ];
    // Relasi ke tabel spesies
    public function spesies()
    {
        return $this->belongsTo(Spesies::class, 'spesies_id');
    }

    // Pastikan selalu return array
    public function getJadwalPakanAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }

        // Handle berbagai kemungkinan format
        $decoded = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        // Jika masih string biasa (contoh: "08:00,16:00")
        if (is_string($value)) {
            return explode(',', str_replace(['"', '[', ']'], '', $value));
        }

        return [];
    }

    public function formatPesan()
    {
        $jadwalArray = $this->jadwal_pakan;

        // Pastikan $jadwalArray benar-benar array
        if (!is_array($jadwalArray)) {
            $jadwalArray = $this->getJadwalPakanAttribute($jadwalArray);
        }

        return "[REMINDER PAKAN]\n" .
               "Spesies: {$this->spesies->jenis_ikan}\n" .
               "Jadwal: " . implode(", ", $jadwalArray) . "\n" .
               "Silakan berikan pakan sesuai jadwal di atas.";
    }


}
