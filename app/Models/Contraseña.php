<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Contraseña extends Model
{
    use HasFactory;
    protected $table = 'contraseñas';

    protected $fillable = [
        'password',
        'activo',
        'user_id'
    ];


    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
