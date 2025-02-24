<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pluviometro extends Model
{
    use HasFactory;
     
    protected $table = 'pluviometros';

    
    protected $fillable = [
        'nombre_sensor',
        'id_usuario',
        'cantidad_lluvia',
        'latitude',
        'longitude',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
