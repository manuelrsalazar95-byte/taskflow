<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * La raíz exige autenticación: debe redirigir al login.
     */
    public function test_root_redirects_to_login_when_guest(): void
    {
        $this->get('/')->assertRedirect('/login');
    }

    /**
     * Un usuario autenticado puede ver el dashboard.
     */
    public function test_authenticated_user_sees_the_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/')
            ->assertOk()
            ->assertSee('Dashboard');
    }

    /**
     * El formulario de login se muestra correctamente.
     */
    public function test_login_page_is_displayed(): void
    {
        $this->get('/login')->assertOk();
    }

    /**
     * El formulario de registro se muestra correctamente.
     */
    public function test_register_page_is_displayed(): void
    {
        $this->get('/register')->assertOk();
    }
}
