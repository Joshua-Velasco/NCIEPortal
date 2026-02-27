<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function gestores()
    {
        return $this->hasMany(Gestor::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
