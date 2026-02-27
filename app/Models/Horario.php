<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['dia', 'hora_inicio', 'hora_fin', 'gestor_id', 'area_id'];

    public function gestor()
    {
        return $this->belongsTo(Gestor::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
