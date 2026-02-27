<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'alumno_proyecto')
            ->withPivot('tipo', 'fecha_inicio', 'fecha_fin')
            ->withTimestamps();
    }

    public function proyectosA()
    {
        return $this->hasMany(AlumnoProyecto::class);
    }
}
