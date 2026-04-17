<?php

namespace Tests\Feature;

use App\Models\Proyecto;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProyectoTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    public function test_admin_can_view_proyectos_index(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/proyectos');
        $response->assertStatus(200);
    }

    public function test_admin_can_create_proyecto_without_image(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/proyectos', [
            'nombre' => 'Proyecto de prueba',
            'descripcion' => 'Descripción del proyecto de prueba',
        ]);

        $response->assertRedirect(route('admin.proyectos.index'));
        $this->assertDatabaseHas('proyectos', ['nombre' => 'Proyecto de prueba']);
    }

    public function test_admin_can_create_proyecto_with_image(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/proyectos', [
            'nombre' => 'Proyecto con imagen',
            'descripcion' => 'Descripción',
            'fotos' => UploadedFile::fake()->image('foto.jpg'),
        ]);

        $response->assertRedirect(route('admin.proyectos.index'));
        $this->assertDatabaseHas('proyectos', ['nombre' => 'Proyecto con imagen']);
    }

    public function test_proyecto_creation_requires_nombre(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/proyectos', [
            'descripcion' => 'Solo descripción sin nombre',
        ]);

        $response->assertSessionHasErrors('nombre');
    }

    public function test_proyecto_creation_requires_descripcion(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/proyectos', [
            'nombre' => 'Solo nombre sin descripción',
        ]);

        $response->assertSessionHasErrors('descripcion');
    }

    public function test_admin_can_delete_proyecto(): void
    {
        $proyecto = Proyecto::create([
            'nombre' => 'Para borrar',
            'descripcion' => 'Descripción',
        ]);

        $response = $this->actingAs($this->admin)->delete("/admin/proyectos/{$proyecto->id}");

        $response->assertRedirect(route('admin.proyectos.index'));
        $this->assertDatabaseMissing('proyectos', ['id' => $proyecto->id]);
    }

    public function test_alumno_cannot_create_proyecto(): void
    {
        $alumno = User::factory()->create();
        $alumno->assignRole('alumno');

        $response = $this->actingAs($alumno)->post('/admin/proyectos', [
            'nombre' => 'Intento no autorizado',
            'descripcion' => 'Descripción',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('proyectos', ['nombre' => 'Intento no autorizado']);
    }
}
