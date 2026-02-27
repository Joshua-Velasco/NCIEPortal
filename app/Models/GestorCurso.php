<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestorCurso extends Model
{
    use HasFactory;

    protected $table = 'gestor_curso';

    protected $fillable = [
        'gestor_id',
        'curso_id'
    ];

    public function gestor()
    {
        return $this->belongsTo(Gestor::class, 'gestor_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
