<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoProyecto extends Model
{
    use HasFactory;

    protected $table = 'alumno_proyecto';
    protected $fillable = ['alumno_id', 'proyecto_id', 'tipo', 'fecha_inicio', 'fecha_fin'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
