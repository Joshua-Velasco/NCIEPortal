<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestor extends Model
{
    use HasFactory;

    protected $fillable = ['nombres', 'apellidos', 'fecha_nacimiento', 'celular', 'carrera', 'grado_academico', 'user_id'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'gestor_curso');
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'gestor_proyecto');
    }

    protected $table = 'gestores';
}
