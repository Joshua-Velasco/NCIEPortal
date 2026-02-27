<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestorProyecto extends Model
{
    use HasFactory;

    protected $table = 'gestor_proyecto';
    protected $fillable = ['gestor_id', 'proyecto_id'];

    public function gestor()
    {
        return $this->belongsTo(Gestor::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
