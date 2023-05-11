<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'ci',
        'nombre',
        'apellido',
        'direccion',
        'telefono',
        'url_foto',
        
    ];
}
