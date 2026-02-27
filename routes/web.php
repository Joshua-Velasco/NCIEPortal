<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProyectoGestorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SugerenciaController;
use App\Mail\SugerenciaMail;
use App\Models\AlumnoProyecto;
use App\Models\Curso;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('index');
//Ajax
Route::get('/areas/{id}', [App\Http\Controllers\WebController::class, 'cargar_datos_areas'])->name('cargar_datos_areas');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//rutas para los correos
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/admin');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('email/verification-notification', [VerificationController::class, 'store'])
    ->middleware(['auth', 'throttle.verification'])
    ->name('verification.resend');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//ruta para buzon de sugerencias-correo
Route::post('/sugerencias/enviar', [SugerenciaController::class, 'send'])->name('sugerencias.send');

//rutas para el admin
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth', 'verified');


//rutas para el admin-usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth', 'verified', 'can:admin.usuarios.index');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth', 'verified', 'can:admin.usuarios.create');
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth', 'verified', 'can:admin.usuarios.store');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth', 'verified', 'can:admin.usuarios.show');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth', 'verified',  'can:admin.usuarios.edit');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth', 'verified', 'can:admin.usuarios.update');
Route::get('/admin/usuarios/{id}/confirm-delete', [App\Http\Controllers\UsuarioController::class, 'confirmDelete'])->name('admin.usuarios.confirmDelete')->middleware('auth', 'verified', 'can:admin.usuarios.confirmDelete');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth', 'verified', 'can:admin.usuarios.destroy');

//rutas para el admin-administrativos
Route::get('/admin/administracion', [App\Http\Controllers\AdministrativoController::class, 'index'])->name('admin.administracion.index')->middleware('auth', 'verified', 'can:admin.administracion.index');
Route::get('/admin/administracion/create', [App\Http\Controllers\AdministrativoController::class, 'create'])->name('admin.administracion.create')->middleware('auth', 'verified', 'can:admin.administracion.create');
Route::post('/admin/administracion/create', [App\Http\Controllers\AdministrativoController::class, 'store'])->name('admin.administracion.store')->middleware('auth', 'verified', 'can:admin.administracion.store');
Route::get('/admin/administracion/{id}', [App\Http\Controllers\AdministrativoController::class, 'show'])->name('admin.administracion.show')->middleware('auth', 'verified', 'can:admin.administracion.show');
Route::get('/admin/administracion/{id}/edit', [App\Http\Controllers\AdministrativoController::class, 'edit'])->name('admin.administracion.edit')->middleware('auth', 'verified', 'can:admin.administracion.edit');
Route::put('/admin/administracion/{id}', [App\Http\Controllers\AdministrativoController::class, 'update'])->name('admin.administracion.update')->middleware('auth', 'verified', 'can:admin.administracion.update');
Route::get('/admin/administracion/{id}/confirm-delete', [App\Http\Controllers\AdministrativoController::class, 'confirmDelete'])->name('admin.administracion.confirmDelete')->middleware('auth', 'verified', 'can:admin.administracion.confirmDelete');
Route::delete('/admin/administracion/{id}', [App\Http\Controllers\AdministrativoController::class, 'destroy'])->name('admin.administracion.destroy')->middleware('auth', 'verified', 'can:admin.administracion.destroy');

//rutas para el admin-alumnos
Route::get('/admin/alumnos', [App\Http\Controllers\AlumnoController::class, 'index'])->name('admin.alumnos.index')->middleware('auth', 'verified', 'can:admin.alumnos.index');
Route::get('/admin/alumnos/create', [App\Http\Controllers\AlumnoController::class, 'create'])->name('admin.alumnos.create')->middleware('auth', 'verified', 'can:admin.alumnos.create');
Route::post('/admin/alumnos/create', [App\Http\Controllers\AlumnoController::class, 'store'])->name('admin.alumnos.store')->middleware('auth', 'verified', 'can:admin.alumnos.store');
Route::get('/admin/alumnos/{id}', [App\Http\Controllers\AlumnoController::class, 'show'])->name('admin.alumnos.show')->middleware('auth', 'verified', 'can:admin.alumnos.show');
Route::get('/admin/alumnos/{id}/edit', [App\Http\Controllers\AlumnoController::class, 'edit'])->name('admin.alumnos.edit')->middleware('auth', 'verified', 'can:admin.alumnos.edit');
Route::put('/admin/alumnos/{id}', [App\Http\Controllers\AlumnoController::class, 'update'])->name('admin.alumnos.update')->middleware('auth', 'verified', 'can:admin.alumnos.update');
Route::get('/admin/alumnos/{id}/confirm-delete', [App\Http\Controllers\AlumnoController::class, 'confirmDelete'])->name('admin.alumnos.confirmDelete')->middleware('auth', 'verified', 'can:admin.alumnos.confirmDelete');
Route::delete('/admin/alumnos/{id}', [App\Http\Controllers\AlumnoController::class, 'destroy'])->name('admin.alumnos.destroy')->middleware('auth', 'verified', 'can:admin.alumnos.destroy');


//rutas para el admin-areas
Route::get('/admin/areas', [App\Http\Controllers\AreaController::class, 'index'])->name('admin.areas.index')->middleware('auth', 'verified', 'can:admin.areas.index');
Route::get('/admin/areas/create', [App\Http\Controllers\AreaController::class, 'create'])->name('admin.areas.create')->middleware('auth', 'verified', 'can:admin.areas.create');
Route::post('/admin/areas/create', [App\Http\Controllers\AreaController::class, 'store'])->name('admin.areas.store')->middleware('auth', 'verified', 'can:admin.areas.store');
Route::get('/admin/areas/{id}', [App\Http\Controllers\AreaController::class, 'show'])->name('admin.areas.show')->middleware('auth', 'verified', 'can:admin.areas.show');
Route::get('/admin/areas/{id}/edit', [App\Http\Controllers\AreaController::class, 'edit'])->name('admin.areas.edit')->middleware('auth', 'verified', 'can:admin.areas.edit');
Route::put('/admin/areas/{id}', [App\Http\Controllers\AreaController::class, 'update'])->name('admin.areas.update')->middleware('auth', 'verified', 'can:admin.areas.update');
Route::get('/admin/areas/{id}/confirm-delete', [App\Http\Controllers\AreaController::class, 'confirmDelete'])->name('admin.areas.confirmDelete')->middleware('auth', 'verified', 'can:admin.areas.confirmDelete');
Route::delete('/admin/areas/{id}', [App\Http\Controllers\AreaController::class, 'destroy'])->name('admin.areas.destroy')->middleware('auth', 'verified', 'can:admin.areas.destroy');

//rutas para el admin-gestores
Route::get('/admin/gestores', [App\Http\Controllers\GestorController::class, 'index'])->name('admin.gestores.index')->middleware('auth', 'verified', 'can:admin.gestores.index');
Route::get('/admin/gestores/create', [App\Http\Controllers\GestorController::class, 'create'])->name('admin.gestores.create')->middleware('auth', 'verified', 'can:admin.gestores.create');
Route::post('/admin/gestores/create', [App\Http\Controllers\GestorController::class, 'store'])->name('admin.gestores.store')->middleware('auth', 'verified', 'can:admin.gestores.store');
Route::get('/admin/gestores/{id}', [App\Http\Controllers\GestorController::class, 'show'])->name('admin.gestores.show')->middleware('auth', 'verified', 'can:admin.gestores.show');
Route::get('/admin/gestores/{id}/edit', [App\Http\Controllers\GestorController::class, 'edit'])->name('admin.gestores.edit')->middleware('auth', 'verified', 'can:admin.gestores.edit');
Route::put('/admin/gestores/{id}', [App\Http\Controllers\GestorController::class, 'update'])->name('admin.gestores.update')->middleware('auth', 'verified', 'can:admin.gestores.update');
Route::get('/admin/gestores/{id}/confirm-delete', [App\Http\Controllers\GestorController::class, 'confirmDelete'])->name('admin.gestores.confirmDelete')->middleware('auth', 'verified', 'can:admin.gestores.confirmDelete');
Route::delete('/admin/gestores/{id}', [App\Http\Controllers\GestorController::class, 'destroy'])->name('admin.gestores.destroy')->middleware('auth', 'verified', 'can:admin.gestores.destroy');

//rutas para el admin-horarios
Route::get('/admin/horarios', [App\Http\Controllers\HorarioController::class, 'index'])->name('admin.horarios.index')->middleware('auth', 'verified', 'can:admin.horarios.index');
Route::get('/admin/horarios/create', [App\Http\Controllers\HorarioController::class, 'create'])->name('admin.horarios.create')->middleware('auth', 'verified', 'can:admin.horarios.create');
Route::post('/admin/horarios/create', [App\Http\Controllers\HorarioController::class, 'store'])->name('admin.horarios.store')->middleware('auth', 'verified', 'can:admin.horarios.store');
Route::get('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'show'])->name('admin.horarios.show')->middleware('auth', 'verified', 'can:admin.horarios.show');
Route::get('/admin/horarios/{id}/edit', [App\Http\Controllers\HorarioController::class, 'edit'])->name('admin.horarios.edit')->middleware('auth', 'verified', 'can:admin.horarios.edit');
Route::put('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'update'])->name('admin.horarios.update')->middleware('auth', 'verified', 'can:admin.horarios.update');
Route::get('/admin/horarios/{id}/confirm-delete', [App\Http\Controllers\HorarioController::class, 'confirmDelete'])->name('admin.horarios.confirmDelete')->middleware('auth', 'verified', 'can:admin.horarios.confirmDelete');
Route::delete('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'destroy'])->name('admin.horarios.destroy')->middleware('auth', 'verified', 'can:admin.horarios.destroy');
//Ajax
Route::get('/admin/horarios/areas/{id}', [App\Http\Controllers\HorarioController::class, 'cargar_datos_areas'])->name('admin.horarios.cargar_datos_areas')->middleware('auth', 'verified', 'can:admin.horarios.cargar_datos_areas');

//rutas para el admin-cursos

Route::prefix('admin')->group(function () {
    Route::get('/cursos/calendar-events', [App\Http\Controllers\CursoController::class, 'getCursosForCalendar'])
        ->name('admin.cursos.calendar-events')
        ->middleware('auth');
    Route::get('/cursos', [App\Http\Controllers\CursoController::class, 'index'])->name('admin.cursos.index')->middleware('auth', 'verified', 'can:admin.cursos.index');
    Route::get('/cursos/create', [App\Http\Controllers\CursoController::class, 'create'])->name('admin.cursos.create')->middleware('auth', 'verified', 'can:admin.cursos.create');
    Route::post('/cursos/create', [App\Http\Controllers\CursoController::class, 'store'])->name('admin.cursos.store')->middleware('auth', 'verified', 'can:admin.cursos.store');
    Route::get('/cursos/{id}', [App\Http\Controllers\CursoController::class, 'show'])->name('admin.cursos.show')->middleware('auth', 'verified', 'can:admin.cursos.show');
    Route::get('/cursos/{id}/edit', [App\Http\Controllers\CursoController::class, 'edit'])->name('admin.cursos.edit')->middleware('auth', 'verified', 'can:admin.cursos.edit');
    Route::put('/cursos/{id}', [App\Http\Controllers\CursoController::class, 'update'])->name('admin.cursos.update')->middleware('auth', 'verified', 'can:admin.cursos.update');
    Route::get('/cursos/{id}/confirm-delete', [App\Http\Controllers\CursoController::class, 'confirmDelete'])->name('admin.cursos.confirmDelete')->middleware('auth', 'verified', 'can:admin.cursos.confirmDelete');
    Route::delete('/cursos/{id}', [App\Http\Controllers\CursoController::class, 'destroy'])->name('admin.cursos.destroy')->middleware('auth', 'verified', 'can:admin.cursos.destroy');
});

//rutas para el admin-proyectos
Route::get('/admin/proyectos', [App\Http\Controllers\ProyectoController::class, 'index'])->name('admin.proyectos.index')->middleware('auth', 'verified', 'can:admin.proyectos.index');
Route::get('/admin/proyectos/create', [App\Http\Controllers\ProyectoController::class, 'create'])->name('admin.proyectos.create')->middleware('auth', 'verified', 'can:admin.proyectos.create');
Route::post('/admin/proyectos/create', [App\Http\Controllers\ProyectoController::class, 'store'])->name('admin.proyectos.store')->middleware('auth', 'verified', 'can:admin.proyectos.store');
Route::get('/admin/proyectos/{id}', [App\Http\Controllers\ProyectoController::class, 'show'])->name('admin.proyectos.show')->middleware('auth', 'verified', 'can:admin.proyectos.show');
Route::get('/admin/proyectos/{id}/edit', [App\Http\Controllers\ProyectoController::class, 'edit'])->name('admin.proyectos.edit')->middleware('auth', 'verified', 'can:admin.proyectos.edit');
Route::put('/admin/proyectos/{proyecto}', [App\Http\Controllers\ProyectoController::class, 'update'])->name('admin.proyectos.update')->middleware('auth', 'verified', 'can:admin.proyectos.update');
Route::get('/admin/proyectos/{id}/confirm-delete', [App\Http\Controllers\ProyectoController::class, 'confirmDelete'])->name('admin.proyectos.confirmDelete')->middleware('auth', 'verified', 'can:admin.proyectos.confirmDelete');
Route::delete('/admin/proyectos/{id}', [App\Http\Controllers\ProyectoController::class, 'destroy'])->name('admin.proyectos.destroy')->middleware('auth', 'verified', 'can:admin.proyectos.destroy');

//rutas para el admin-asignaciones-gestor-curso
Route::get('/admin/asignaciones', [App\Http\Controllers\AsignacionController::class, 'index'])->name('admin.asignaciones.index')->middleware('auth', 'verified', 'can:admin.asignaciones.index');
Route::get('/admin/asignaciones/create', [App\Http\Controllers\AsignacionController::class, 'create'])->name('admin.asignaciones.create')->middleware('auth', 'verified', 'can:admin.asignaciones.create');
Route::post('/admin/asignaciones/create', [App\Http\Controllers\AsignacionController::class, 'store'])->name('admin.asignaciones.store')->middleware('auth', 'verified', 'can:admin.asignaciones.store');
Route::get('/admin/asignaciones/{gestor}/{curso}/edit', [App\Http\Controllers\AsignacionController::class, 'edit'])->name('admin.asignaciones.edit')->middleware('auth', 'verified', 'can:admin.asignaciones.edit');
Route::put('/admin/asignaciones/{gestor}/{curso}', [App\Http\Controllers\AsignacionController::class, 'update'])->name('admin.asignaciones.update')->middleware('auth', 'verified', 'can:admin.asignaciones.update');
Route::get('/admin/asignaciones/{gestor}/{curso}/confirm-delete', [App\Http\Controllers\AsignacionController::class, 'confirmDelete'])->name('admin.asignaciones.confirmDelete')->middleware('auth', 'verified', 'can:admin.asignaciones.confirmDelete');
Route::delete('/admin/asignaciones/{gestor}/{curso}', [App\Http\Controllers\AsignacionController::class, 'destroy'])->name('admin.asignaciones.destroy')->middleware('auth', 'verified', 'can:admin.asignaciones.destroy');


//rutas para el admin-presupuestos
Route::get('/admin/presupuestos', [App\Http\Controllers\PresupuestoController::class, 'index'])->name('admin.presupuestos.index')->middleware('auth', 'verified', 'can:admin.presupuestos.index');
Route::get('/admin/presupuestos/create', [App\Http\Controllers\PresupuestoController::class, 'create'])->name('admin.presupuestos.create')->middleware('auth', 'verified', 'can:admin.presupuestos.create');
Route::post('/admin/presupuestos/create', [App\Http\Controllers\PresupuestoController::class, 'store'])->name('admin.presupuestos.store')->middleware('auth', 'verified', 'can:admin.presupuestos.store');
Route::get('/admin/presupuestos/{id}/edit', [App\Http\Controllers\PresupuestoController::class, 'edit'])->name('admin.presupuestos.edit')->middleware('auth', 'verified', 'can:admin.presupuestos.edit');
Route::put('/admin/presupuestos/{id}', [App\Http\Controllers\PresupuestoController::class, 'update'])->name('admin.presupuestos.update')->middleware('auth', 'verified', 'can:admin.presupuestos.update');
Route::get('/admin/presupuestos/{id}/confirm-delete', [App\Http\Controllers\PresupuestoController::class, 'confirmDelete'])->name('admin.presupuestos.confirmDelete')->middleware('auth', 'verified', 'can:admin.presupuestos.confirmDelete');
Route::delete('/admin/presupuestos/{id}', [App\Http\Controllers\PresupuestoController::class, 'destroy'])->name('admin.presupuestos.destroy')->middleware('auth', 'verified', 'can:admin.presupuestos.destroy');

//rutas para el usario-registrase a curso

Route::get('/inscripciones/create', [InscripcionController::class, 'create'])->name('inscripciones.create')->middleware('auth', 'verified', 'can:inscripciones.create');
Route::post('/inscripciones', [InscripcionController::class, 'store'])->name('inscripciones.store')->middleware('auth', 'verified', 'can:inscripciones.store');
Route::get('mis-cursos', [InscripcionController::class, 'misCursos'])->name('inscripciones.mis-cursos')->middleware('auth', 'verified', 'can:inscripciones.mis-cursos');
Route::delete('inscripciones/{inscripcion}', [InscripcionController::class, 'destroy'])->name('inscripciones.destroy')->middleware('auth', 'verified', 'can:inscripciones.destroy');
//rutas para el alumno-proyectos
Route::get('/mis-proyectos', [App\Http\Controllers\AlumnoProyectoController::class, 'misProyectos'])->name('inscripciones.mis_proyectos')->middleware('auth', 'verified', 'can:inscripciones.mis_proyectos');

//Rutas para gestor-cursos
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index')->middleware('auth', 'verified', 'can:reportes.index');
Route::get('/reportes/cursos-asignados', [ReporteController::class, 'cursosAsignados'])->name('reportes.cursos-asignados')->middleware('auth', 'verified', 'can:reportes.cursos-asignados');
//Rutas para gestor-proyectos
Route::get('/reportes/mis_proyectos', [ProyectoGestorController::class, 'misProyectos'])->name('reportes.mis_proyectos')->middleware('auth', 'verified', 'can:reportes.mis_proyectos');

//Rutas para el admin-gestor-proyectos
Route::get('/admin/proyecto_gestores', [App\Http\Controllers\ProyectoGestorController::class, 'index'])->name('admin.proyecto_gestores.index')->middleware('auth', 'verified', 'can:admin.proyecto_gestores.index');
Route::get('/admin/proyecto_gestores/create', [App\Http\Controllers\ProyectoGestorController::class, 'create'])->name('admin.proyecto_gestores.create')->middleware('auth', 'verified', 'can:admin.proyecto_gestores.create');
Route::post('/admin/proyecto_gestores/create', [App\Http\Controllers\ProyectoGestorController::class, 'store'])->name('admin.proyecto_gestores.store')->middleware('auth', 'verified', 'can:admin.proyecto_gestores.store');
Route::get('/admin/proyecto_gestores/{id}/edit', [App\Http\Controllers\ProyectoGestorController::class, 'edit'])->name('admin.proyecto_gestores.edit')->middleware('auth', 'verified', 'admin.proyecto_gestores.edit');
Route::put('/admin/proyecto_gestores/{id}', [App\Http\Controllers\ProyectoGestorController::class, 'update'])->name('admin.proyecto_gestores.update')->middleware('auth', 'verified', 'admin.proyecto_gestores.update');
Route::get('/admin/proyecto_gestores/{id}/confirm-delete', [App\Http\Controllers\ProyectoGestorController::class, 'confirmDelete'])->name('admin.proyecto_gestores.confirm-delete')->middleware('auth', 'verified', 'can:admin.proyecto_gestores.confirm-delete');
Route::delete('/admin/proyecto_gestores/{id}', [App\Http\Controllers\ProyectoGestorController::class, 'destroy'])->name('admin.proyecto_gestores.destroy')->middleware('auth', 'verified', 'can:admin.proyecto_gestores.destroy');

//Rutas para el admin-alumnos-proyectos
Route::get('/admin/alumno_proyecto', [App\Http\Controllers\AlumnoProyectoController::class, 'index'])->name('admin.alumno_proyecto.index')->middleware('auth', 'verified', 'can:admin.alumno_proyecto.index');
Route::get('/admin/alumno_proyecto/create', [App\Http\Controllers\AlumnoProyectoController::class, 'create'])->name('admin.alumno_proyecto.create')->middleware('auth', 'verified', 'can:admin.alumno_proyecto.create');
Route::post('/admin/alumno_proyecto/create', [App\Http\Controllers\AlumnoProyectoController::class, 'store'])->name('admin.alumno_proyecto.store')->middleware('auth', 'verified', 'can:admin.alumno_proyecto.store');
Route::get('/admin/alumno_proyecto/{id}/edit', [App\Http\Controllers\AlumnoProyectoController::class, 'edit'])->name('admin.alumno_proyecto.edit')->middleware('auth', 'verified', 'can:admin.alumno_proyecto.edit');
Route::put('/admin/alumno_proyecto/{id}', [App\Http\Controllers\AlumnoProyectoController::class, 'update'])->name('admin.alumno_proyecto.update')->middleware('auth', 'verified', 'can:admin.alumno_proyecto.update');
Route::get('/admin/alumno_proyecto/{id}/confirm-delete', [App\Http\Controllers\AlumnoProyectoController::class, 'confirmDelete'])->name('admin.alumno_proyecto.confirm-delete')->middleware('auth', 'verified', 'can:admin.alumno_proyecto.confirm-delete');
Route::delete('/admin/alumno_proyecto/{id}', [App\Http\Controllers\AlumnoProyectoController::class, 'destroy'])->name('admin.alumno_proyecto.destroy')->middleware('auth', 'verified', 'can:admin.alumno_proyecto.destroy');

//Rutas para post-admin-gestor-administrativo
Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create')->middleware('auth', 'verified', 'can:post.create');
Route::post('/post/create', [App\Http\Controllers\PostController::class, 'store'])->name('post.store')->middleware('auth', 'verified', 'can:post.store');
Route::get('/post', [App\Http\Controllers\PostController::class, 'index'])->name('post.notifications')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('markAsRead', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('markAsRead');

    Route::post('/mark-as-read', 'PostController@markNotification')->name('markNotification');
});
