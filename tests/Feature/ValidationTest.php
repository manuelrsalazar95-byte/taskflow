<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    private function categoriaDe(User $user, string $nombre = 'Categoría'): Categoria
    {
        return Categoria::factory()->create([
            'user_id' => $user->id,
            'name' => $nombre,
        ]);
    }

    private function tareaDe(User $user, Categoria $categoria): Tarea
    {
        return Tarea::factory()->create([
            'usuario_id' => $user->id,
            'categoria_id' => $categoria->id,
            'titulo' => 'Tarea original',
            'descripcion' => 'Descripción original',
            'estado' => 'pendiente',
        ]);
    }

    public function test_tarea_requires_titulo_descripcion_and_categoria(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('tareas.store'), [])
            ->assertSessionHasErrors(['titulo', 'descripcion', 'categoria_id']);

        $this->assertDatabaseCount('tareas', 0);
    }

    public function test_tarea_titulo_cannot_exceed_255_characters(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user);

        $this->actingAs($user)
            ->post(route('tareas.store'), [
                'titulo' => str_repeat('a', 256),
                'descripcion' => 'Descripción válida',
                'categoria_id' => $categoria->id,
            ])
            ->assertSessionHasErrors('titulo');

        $this->assertDatabaseCount('tareas', 0);
    }

    public function test_tarea_categoria_must_exist(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('tareas.store'), [
                'titulo' => 'Tarea',
                'descripcion' => 'Descripción',
                'categoria_id' => 999999,
            ])
            ->assertSessionHasErrors('categoria_id');

        $this->assertDatabaseCount('tareas', 0);
    }

    public function test_tarea_cannot_use_a_soft_deleted_category(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user, 'Eliminada');

        $categoria->delete();

        $this->actingAs($user)
            ->post(route('tareas.store'), [
                'titulo' => 'Tarea',
                'descripcion' => 'Descripción',
                'categoria_id' => $categoria->id,
            ])
            ->assertSessionHasErrors('categoria_id');

        $this->assertDatabaseCount('tareas', 0);
    }

    public function test_update_tarea_cannot_use_a_soft_deleted_category(): void
    {
        $user = User::factory()->create();
        $categoriaActual = $this->categoriaDe($user, 'Actual');
        $categoriaEliminada = $this->categoriaDe($user, 'Eliminada');
        $tarea = $this->tareaDe($user, $categoriaActual);

        $categoriaEliminada->delete();

        $this->actingAs($user)
            ->put(route('tareas.update', $tarea), [
                'titulo' => 'Cambio',
                'descripcion' => 'Descripción',
                'categoria_id' => $categoriaEliminada->id,
            ])
            ->assertSessionHasErrors('categoria_id');

        $this->assertDatabaseHas('tareas', [
            'id' => $tarea->id,
            'categoria_id' => $categoriaActual->id,
        ]);
    }

    public function test_estado_is_required_when_updating(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user);
        $tarea = $this->tareaDe($user, $categoria);

        $this->actingAs($user)
            ->patch(route('tareas.estado', $tarea), [])
            ->assertSessionHasErrors('estado');

        $this->assertDatabaseHas('tareas', [
            'id' => $tarea->id,
            'estado' => 'pendiente',
        ]);
    }

    public function test_estado_must_be_one_of_the_allowed_values(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user);
        $tarea = $this->tareaDe($user, $categoria);

        $this->actingAs($user)
            ->patch(route('tareas.estado', $tarea), ['estado' => 'cancelada'])
            ->assertSessionHasErrors('estado');

        $this->assertDatabaseHas('tareas', [
            'id' => $tarea->id,
            'estado' => 'pendiente',
        ]);
    }

    public function test_categoria_requires_a_name(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('categorias.store'), [])
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('categoria', 0);
    }

    public function test_categoria_name_cannot_exceed_255_characters(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('categorias.store'), ['name' => str_repeat('a', 256)])
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('categoria', 0);
    }

    public function test_categoria_name_must_be_unique_per_user(): void
    {
        $user = User::factory()->create();
        $this->categoriaDe($user, 'Duplicada');

        $this->actingAs($user)
            ->post(route('categorias.store'), ['name' => 'Duplicada'])
            ->assertSessionHasErrors('name');

        $this->assertEquals(
            'Ya existe una categoría con ese nombre.',
            session('errors')->first('name')
        );
    }

    public function test_update_categoria_cannot_take_another_categorys_name(): void
    {
        $user = User::factory()->create();
        $primera = $this->categoriaDe($user, 'Primera');
        $this->categoriaDe($user, 'Segunda');

        $this->actingAs($user)
            ->put(route('categorias.update', $primera), ['name' => 'Segunda'])
            ->assertSessionHasErrors('name');

        $this->assertDatabaseHas('categoria', [
            'id' => $primera->id,
            'name' => 'Primera',
        ]);
    }

    public function test_update_categoria_can_reuse_a_soft_deleted_name(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user, 'Reutilizable');
        $eliminada = $this->categoriaDe($user, 'Eliminada');

        $eliminada->delete();

        $this->actingAs($user)
            ->put(route('categorias.update', $categoria), ['name' => 'Eliminada'])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('categoria', [
            'id' => $categoria->id,
            'name' => 'Eliminada',
        ]);
    }

    public function test_unauthorized_update_is_rejected_before_validation(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();
        $categoriaDeBeto = $this->categoriaDe($beto, 'Categoría de Beto');
        $tareaDeBeto = $this->tareaDe($beto, $categoriaDeBeto);

        $this->actingAs($ana)
            ->put(route('tareas.update', $tareaDeBeto), [])
            ->assertForbidden();
    }
}
