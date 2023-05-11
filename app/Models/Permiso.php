<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'id',
        'nombre',
        'descripcion',
        
    ];

    public function rolPermiso()
    {
        return $this->hasMany(RolPermiso::class);
    }

}
