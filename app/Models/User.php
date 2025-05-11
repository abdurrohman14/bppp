<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'whatsapp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    CONST ROLE_ADMIN = 'admin';
    CONST ROLE_PETUGASKOLAM = 'petugaskolam';
    CONST ROLE_MANAJER = 'manajer';

    public function isAdmin() {
        return $this->role_id == self::ROLE_ADMIN;
    }

    public function isPetugasKolam() {
        return $this->role_id == self::ROLE_PETUGASKOLAM;
    }

    public function isManajer() {
        return $this->role_id == self::ROLE_MANAJER;
    }

    public function getRoleAttribute() {
        return $this->role()->first()->name ?? null;
    }
}
