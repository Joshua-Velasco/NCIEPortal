<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RbacTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    public function test_unauthenticated_user_redirected_to_login_from_admin(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
    }

    public function test_admin_can_access_usuarios_section(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $response = $this->actingAs($user)->get('/admin/usuarios');
        $response->assertStatus(200);
    }

    public function test_alumno_cannot_access_admin_usuarios(): void
    {
        $user = User::factory()->create();
        $user->assignRole('alumno');

        $response = $this->actingAs($user)->get('/admin/usuarios');
        $response->assertStatus(403);
    }

    public function test_gestor_cannot_access_admin_usuarios(): void
    {
        $user = User::factory()->create();
        $user->assignRole('gestor');

        $response = $this->actingAs($user)->get('/admin/usuarios');
        $response->assertStatus(403);
    }

    public function test_administrativo_can_access_alumnos_section(): void
    {
        $user = User::factory()->create();
        $user->assignRole('administrativo');

        $response = $this->actingAs($user)->get('/admin/alumnos');
        $response->assertStatus(200);
    }

    public function test_alumno_cannot_access_admin_proyectos(): void
    {
        $user = User::factory()->create();
        $user->assignRole('alumno');

        $response = $this->actingAs($user)->get('/admin/proyectos');
        $response->assertStatus(403);
    }
}
