<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Denuncia extends Model
{
    use HasFactory;

    protected $table = 'denuncias';

    protected $fillable = [
        'titulo',
        'descripcion',
        'user_id',
        'fecha',
        'hora',
        'estado',
        'hash',
        'latitud',
        'longitud',
        'tipo_denuncia'
    ];


    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
