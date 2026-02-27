<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fotos'
    ];

    public function gestores()
    {
        return $this->belongsToMany(Gestor::class, 'gestor_proyecto')->withPivot('id');
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_proyecto')
            ->withPivot('tipo', 'fecha_inicio', 'fecha_fin')
            ->withTimestamps();
    }
}
