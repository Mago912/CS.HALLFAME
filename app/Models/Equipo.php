<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{

protected $fillable = ['nombre', 'pais'];

public function jugadores()
{
    return $this->hasMany(Jugador::class);
}
}

