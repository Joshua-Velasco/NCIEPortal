<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'hora_inicio',
        'hora_fin',
        'lugar',
        'requisitos',
        'modalidad',
        'descripcion',
    ];

    public function gestores()
    {
        return $this->belongsToMany(Gestor::class, 'gestor_curso');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(User::class, 'inscripciones', 'curso_id', 'user_id');
    }
}
