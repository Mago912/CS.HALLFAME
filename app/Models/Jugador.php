<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $fillable = [
        'nickname',
        'pais',
        'mvps',
        'majors',
        'descripcion',
        'imagen',
        'equipo_id'
    ];
    
public function equipo()
{ 
    return $this->belongsTo(Equipo::class);
}
}