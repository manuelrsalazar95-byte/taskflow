<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private function categoriaDe(User $user, ?string $nombre = null): Categoria
    {
        return Categoria::factory()->create(array_filter([
            'user_id' => $user->id,
            'name' => $nombre,
        ]));
    }

    private function tareaDe(User $user, string $titulo, ?Categoria $categoria = null): Tarea
    {
        $categoria ??= $this->categoriaDe($user);

        return Tarea::factory()->create([
            'usuario_id' => $user->id,
            'categoria_id' => $categoria->id,
            'titulo' => $titulo,
            'descripcion' => 'Descripción de '.$titulo,
            'estado' => 'pendiente',
        ]);
    }

    public function test_index_only_shows_tasks_of_the_authenticated_user(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $this->tareaDe($ana, 'Tarea privada de Ana');
        $this->tareaDe($beto, 'Tarea privada de Beto');

        $this->actingAs($ana)
            ->get(route('tareas.index'))
            ->assertOk()
            ->assertSee('Tarea privada de Ana')
            ->assertDontSee('Tarea privada de Beto');
    }

    public function test_user_cannot_edit_another_users_task(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $tareaDeBeto = $this->tareaDe($beto, 'Tarea de Beto');

        $this->actingAs($ana)
            ->get(route('tareas.edit', $tareaDeBeto))
            ->assertForbidden();
    }

    public function test_user_cannot_update_another_users_task(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $tareaDeBeto = $this->tareaDe($beto, 'Tarea original de Beto');

        $this->actingAs($ana)
            ->put(route('tareas.update', $tareaDeBeto), [
                'titulo' => 'Secuestrada por Ana',
                'descripcion' => 'No debería cambiar',
                'categoria_id' => $tareaDeBeto->categoria_id,
            ])
            ->assertForbidden();

        $this->assertDatabaseHas('tareas', [
            'id' => $tareaDeBeto->id,
            'titulo' => 'Tarea original de Beto',
        ]);
    }

    public function test_user_cannot_delete_another_users_task(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $tareaDeBeto = $this->tareaDe($beto, 'Tarea de Beto');

        $this->actingAs($ana)
            ->delete(route('tareas.destroy', $tareaDeBeto))
            ->assertForbidden();

        $this->assertNull($tareaDeBeto->fresh()->deleted_at);
    }

    public function test_user_cannot_restore_another_users_trashed_task(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $tareaDeBeto = $this->tareaDe($beto, 'Tarea de Beto');
        $tareaDeBeto->delete();

        $this->actingAs($ana)
            ->patch(route('tareas.restore', $tareaDeBeto->id))
            ->assertNotFound();

        $this->assertSoftDeleted($tareaDeBeto);
    }

    public function test_user_cannot_force_delete_another_users_trashed_task(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $tareaDeBeto = $this->tareaDe($beto, 'Tarea de Beto');
        $tareaDeBeto->delete();

        $this->actingAs($ana)
            ->delete(route('tareas.forceDelete', $tareaDeBeto->id))
            ->assertNotFound();

        $this->assertSoftDeleted($tareaDeBeto);
    }

    public function test_user_cannot_edit_another_users_category(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $categoriaDeBeto = $this->categoriaDe($beto, 'Categoría de Beto');

        $this->actingAs($ana)
            ->get(route('categorias.edit', $categoriaDeBeto))
            ->assertForbidden();
    }

    public function test_user_cannot_delete_another_users_category(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $categoriaDeBeto = $this->categoriaDe($beto, 'Categoría de Beto');

        $this->actingAs($ana)
            ->delete(route('categorias.destroy', $categoriaDeBeto))
            ->assertForbidden();

        $this->assertNull($categoriaDeBeto->fresh()->deleted_at);
    }

    public function test_task_cannot_be_created_with_another_users_category(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $categoriaDeBeto = $this->categoriaDe($beto, 'Categoría de Beto');

        $this->actingAs($ana)
            ->post(route('tareas.store'), [
                'titulo' => 'Intento de Ana',
                'descripcion' => 'Usando una categoría ajena',
                'categoria_id' => $categoriaDeBeto->id,
            ])
            ->assertSessionHasErrors('categoria_id');

        $this->assertDatabaseCount('tareas', 0);
    }

    public function test_task_owner_is_always_the_authenticated_user(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $categoriaDeAna = $this->categoriaDe($ana, 'Categoría de Ana');

        $this->actingAs($ana)
            ->post(route('tareas.store'), [
                'titulo' => 'Tarea de Ana',
                'descripcion' => 'Descripción',
                'categoria_id' => $categoriaDeAna->id,
                'usuario_id' => $beto->id,
            ])
            ->assertRedirect(route('tareas.index'));

        $this->assertDatabaseHas('tareas', [
            'titulo' => 'Tarea de Ana',
            'usuario_id' => $ana->id,
        ]);
    }

    public function test_category_names_are_unique_per_user_not_globally(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $this->actingAs($ana)
            ->post(route('categorias.store'), ['name' => 'Compartida'])
            ->assertSessionHasNoErrors();

        $this->actingAs($beto)
            ->post(route('categorias.store'), ['name' => 'Compartida'])
            ->assertSessionHasNoErrors();

        $this->actingAs($ana)
            ->post(route('categorias.store'), ['name' => 'Compartida'])
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('categoria', 2);
    }

    public function test_dashboard_only_counts_the_authenticated_users_data(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $this->tareaDe($ana, 'Tarea de Ana');
        $this->tareaDe($beto, 'Tarea de Beto 1');
        $this->tareaDe($beto, 'Tarea de Beto 2');

        $this->actingAs($ana)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertViewHas('stats', function (array $stats) {
                return $stats['total'] === 1
                    && $stats['pendientes'] === 1
                    && $stats['categorias'] === 1
                    && $stats['papelera'] === 0;
            });
    }
}
