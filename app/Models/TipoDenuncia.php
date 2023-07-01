<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDenuncia extends Model
{
    use HasFactory;



    protected $table = 'tipos_denuncia';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'area_id',
    ];
}
