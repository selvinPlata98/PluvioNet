<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'datos';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'cantidad_lluvia',
        'latitud',
        'longitud',
        'created_at'
    ];
    
    public $timestamps = false;
    
    protected $casts = [
        'created_at' => 'datetime', // Asegura que sea instancia de Carbon
        'cantidad_lluvia' => 'float',
        'latitud' => 'float',
        'longitud' => 'float',
    ];
    
    // Opcional: Si necesitas un nombre más descriptivo
    public function getCantidadLluviaAttribute($value)
    {
        return $value.' mm'; // Ejemplo: formatea automáticamente
    }
}