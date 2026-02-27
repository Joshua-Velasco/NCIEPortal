<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Administrativo;
use App\Models\Alumno;
use App\Models\Area;
use App\Models\Gestor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



        $this->call([RoleSeeder::class,]);



        User::create([
            'name' => 'Administrador',
            'email' => 'sistemancie@gmail.com',
            'password' => Hash::make('12345678')
        ])->assignRole('admin');
    }
}
