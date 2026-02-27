<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seeder para los roles y permisos
        $admin = Role::create(['name' => 'admin']);
        $administrativo = Role::create(['name' => 'administrativo']);
        $gestor = Role::create(['name' => 'gestor']);
        $alumno = Role::create(['name' => 'alumno']);
        $usuario = Role::create(['name' => 'usuario']);


        Permission::create(['name' => 'admin.index']);

        //rutas para el admin-usuarios
        Permission::create(['name' => 'admin.usuarios.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.destroy'])->syncRoles([$admin]);

        //rutas para el admin-administrativos
        Permission::create(['name' => 'admin.administracion.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.administracion.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.administracion.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.administracion.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.administracion.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.administracion.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.administracion.confirmDelete'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.administracion.destroy'])->syncRoles([$admin]);

        //rutas para el admin-alumnos
        Permission::create(['name' => 'admin.alumnos.index'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumnos.create'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumnos.store'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumnos.show'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumnos.edit'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumnos.update'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumnos.confirmDelete'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumnos.destroy'])->syncRoles([$admin, $administrativo]);

        //rutas para el admin-areas
        Permission::create(['name' => 'admin.areas.index'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.areas.create'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.areas.store'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.areas.show'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.areas.edit'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.areas.update'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.areas.confirmDelete'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.areas.destroy'])->syncRoles([$admin, $administrativo]);

        //rutas para el admin-gestores
        Permission::create(['name' => 'admin.gestores.index'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.gestores.create'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.gestores.store'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.gestores.show'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.gestores.edit'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.gestores.update'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.gestores.confirmDelete'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.gestores.destroy'])->syncRoles([$admin, $administrativo]);

        //rutas para el admin-horarios
        Permission::create(['name' => 'admin.horarios.index'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.horarios.create'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.horarios.store'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.horarios.show'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.horarios.edit'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.horarios.update'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.horarios.confirmDelete'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.horarios.destroy'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.horarios.cargar_datos_areas'])->syncRoles([$admin, $administrativo]);

        //rutas para el admin-cursos
        Permission::create(['name' => 'admin.cursos.index'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.cursos.create'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.cursos.store'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.cursos.show'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.cursos.edit'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.cursos.update'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.cursos.confirmDelete'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.cursos.destroy'])->syncRoles([$admin, $administrativo]);

        //rutas para el admin-proyectos
        Permission::create(['name' => 'admin.proyectos.index'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyectos.create'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyectos.store'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyectos.show'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyectos.edit'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyectos.update'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyectos.confirmDelete'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyectos.destroy'])->syncRoles([$admin, $administrativo]);

        //rutas para el admin-asignaciones-gestor-curso
        Permission::create(['name' => 'admin.asignaciones.index'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.asignaciones.create'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.asignaciones.store'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.asignaciones.show'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.asignaciones.edit'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.asignaciones.update'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.asignaciones.confirmDelete'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.asignaciones.destroy'])->syncRoles([$admin, $administrativo]);


        ////rutas para el usario-registrase a curso
        Permission::create(['name' => 'inscripciones.create'])->syncRoles([$alumno, $usuario]);
        Permission::create(['name' => 'inscripciones.store'])->syncRoles([$alumno, $usuario]);
        Permission::create(['name' => 'inscripciones.mis-cursos'])->syncRoles([$alumno, $usuario]);
        Permission::create(['name' => 'inscripciones.destroy'])->syncRoles([$alumno, $usuario]);

        //rutas para el alumno-proyectos
        Permission::create(['name' => 'inscripciones.mis_proyectos'])->syncRoles([$alumno]);

        //Rutas para gestor-cursos
        Permission::create(['name' => 'reportes.index'])->syncRoles([$gestor]);
        Permission::create(['name' => 'reportes.cursos-asignados'])->syncRoles([$gestor]);

        //Rutas para gestor-proyectos
        Permission::create(['name' => 'reportes.mis_proyectos'])->syncRoles([$gestor]);

        //Rutas para el admin-gestor-proyectos
        Permission::create(['name' => 'admin.proyecto_gestores.index'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyecto_gestores.create'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyecto_gestores.store'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyecto_gestores.edit'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyecto_gestores.update'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyecto_gestores.confirm-delete'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.proyecto_gestores.destroy'])->syncRoles([$admin, $administrativo]);

        //Rutas para el admin-alumnos-proyectos
        Permission::create(['name' => 'admin.alumno_proyecto.index'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumno_proyecto.create'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumno_proyecto.store'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumno_proyecto.edit'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumno_proyecto.update'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumno_proyecto.confirm-delete'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.alumno_proyecto.destroy'])->syncRoles([$admin, $administrativo]);

        //Rutas para post-admin-gestor-administrativo
        Permission::create(['name' => 'post.create'])->syncRoles([$admin, $administrativo, $gestor]);
        Permission::create(['name' => 'post.store'])->syncRoles([$admin, $administrativo, $gestor]);

        //rutas para el admin-presupuestos
        Permission::create(['name' => 'admin.presupuestos.index'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.presupuestos.create'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.presupuestos.store'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.presupuestos.edit'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.presupuestos.update'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.presupuestos.confirmDelete'])->syncRoles([$admin, $administrativo]);
        Permission::create(['name' => 'admin.presupuestos.destroy'])->syncRoles([$admin, $administrativo]);
    }
}
