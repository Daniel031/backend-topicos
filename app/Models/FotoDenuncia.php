<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoDenuncia extends Model
{
    use HasFactory;

    protected $table = 'fotos_denuncia';


    protected $fillable = [
        'url',
        'id_url',
        'denuncia_id',
        'estado'
    ];
}
