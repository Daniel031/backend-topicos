<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segip extends Model
{
    use HasFactory;

    protected $table ='segip';

    protected $fillable = [
        'ci',
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'foto',
        'sexo',
    ];

    
}
