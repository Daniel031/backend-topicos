<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Contraseña;
use App\Models\Denuncia;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'ultimo_cambio_password',
        'creacion_token',
        'ultimo_inicio_sesion',
        'fecha_desbloqueo',
        'codigo_verificacion',
        'area_id',
        'administrativo',

    ];

    public function userRol()
    {
        return $this->hasMany(UserRol::class);
    }
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function contraseñas(): HasMany
    {
        return $this->hasMany(Contraseña::class);
    }


    public function denuncias():HasMany
    {
        return $this->hasMany(Denuncia::class);
    }
}
