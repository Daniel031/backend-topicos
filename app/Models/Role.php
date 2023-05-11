<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'id',
        'nombre',

    ];

    public function rolePermiso()
    {
        return $this->hasMany(RolePermiso::class);
    }

    public function userRole()
    {
        return $this->hasMany(UserRole::class);
    }

}
