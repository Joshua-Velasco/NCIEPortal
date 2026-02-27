<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function administrativos()
    {
        return $this->hasOne(Administrativo::class);
    }

    public function gestor()
    {
        return $this->hasOne(Gestor::class);
    }

    public function alumno()
    {
        return $this->hasOne(Alumno::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'inscripciones', 'user_id', 'curso_id')
            ->withTimestamps()
            ->withPivot(['created_at', 'updated_at']);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
