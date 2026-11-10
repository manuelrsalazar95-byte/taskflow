<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TareasTest extends TestCase
{
    use RefreshDatabase;

    private function categoriaDe(User $user, ?string $nombre = null): Categoria
    {
        return Categoria::factory()->create(array_filter([
            'user_id' => $user->id,
            'name' => $nombre,
        ]));
    }

    private function tareaDe(User $user, array $atributos = []): Tarea
    {
        $categoria = isset($atributos['categoria_id'])
            ? Categoria::findOrFail($atributos['categoria_id'])
            : $this->categoriaDe($user);

        return Tarea::factory()->create(array_merge([
            'usuario_id' => $user->id,
            'categoria_id' => $categoria->id,
            'titulo' => 'Tarea de '.$user->user_name,
            'descripcion' => 'Descripción de prueba',
            'estado' => 'pendiente',
        ], $atributos));
    }

    public function test_search_matches_title_case_insensitively(): void
    {
        $user = User::factory()->create();

        $this->tareaDe($user, ['titulo' => 'Revisar Informe Mensual']);
        $this->tareaDe($user, ['titulo' => 'Comprar café']);

        $this->actingAs($user)
            ->get(route('tareas.index', ['buscar' => 'informe']))
            ->assertOk()
            ->assertSee('Revisar Informe Mensual')
            ->assertDontSee('Comprar café');
    }

    public function test_search_matches_description_case_insensitively(): void
    {
        $user = User::factory()->create();

        $this->tareaDe($user, [
            'titulo' => 'Tarea con detalle',
            'descripcion' => 'Revisar el PRESUPUESTO anual',
        ]);
        $this->tareaDe($user, [
            'titulo' => 'Otra tarea',
            'descripcion' => 'Sin relación',
        ]);

        $this->actingAs($user)
            ->get(route('tareas.index', ['buscar' => 'presupuesto']))
            ->assertOk()
            ->assertSee('Tarea con detalle')
            ->assertDontSee('Otra tarea');
    }

    public function test_search_without_results_shows_empty_state(): void
    {
        $user = User::factory()->create();

        $this->tareaDe($user, ['titulo' => 'Tarea existente']);

        $this->actingAs($user)
            ->get(route('tareas.index', ['buscar' => 'inexistente-xyz']))
            ->assertOk()
            ->assertDontSee('Tarea existente');
    }

    public function test_filter_by_estado(): void
    {
        $user = User::factory()->create();

        $this->tareaDe($user, ['titulo' => 'Pendiente A', 'estado' => 'pendiente']);
        $this->tareaDe($user, ['titulo' => 'Completada B', 'estado' => 'completada']);

        $this->actingAs($user)
            ->get(route('tareas.index', ['estado' => 'completada']))
            ->assertOk()
            ->assertSee('Completada B')
            ->assertDontSee('Pendiente A');
    }

    public function test_filter_by_own_category(): void
    {
        $user = User::factory()->create();

        $categoriaA = $this->categoriaDe($user, 'Categoría A');
        $categoriaB = $this->categoriaDe($user, 'Categoría B');

        $this->tareaDe($user, ['titulo' => 'Tarea de A', 'categoria_id' => $categoriaA->id]);
        $this->tareaDe($user, ['titulo' => 'Tarea de B', 'categoria_id' => $categoriaB->id]);

        $this->actingAs($user)
            ->get(route('tareas.index', ['categoria_id' => $categoriaA->id]))
            ->assertOk()
            ->assertSee('Tarea de A')
            ->assertDontSee('Tarea de B');
    }

    public function test_new_task_gets_pending_state_and_authenticated_owner(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user, 'Mi categoría');

        $this->actingAs($user)
            ->post(route('tareas.store'), [
                'titulo' => 'Nueva tarea',
                'descripcion' => 'Descripción nueva',
                'categoria_id' => $categoria->id,
            ])
            ->assertRedirect(route('tareas.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('tareas', [
            'titulo' => 'Nueva tarea',
            'usuario_id' => $user->id,
            'categoria_id' => $categoria->id,
            'estado' => 'pendiente',
        ]);
    }

    public function test_store_validates_required_fields(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('tareas.store'), [])
            ->assertSessionHasErrors(['titulo', 'descripcion', 'categoria_id']);

        $this->assertDatabaseCount('tareas', 0);
    }

    public function test_update_keeps_the_original_owner(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $tarea = $this->tareaDe($ana, ['titulo' => 'Original']);
        $categoriaDeAna = $this->categoriaDe($ana, 'Categoría de Ana');

        $this->actingAs($ana)
            ->put(route('tareas.update', $tarea), [
                'titulo' => 'Actualizada',
                'descripcion' => 'Descripción actualizada',
                'categoria_id' => $categoriaDeAna->id,
                'usuario_id' => $beto->id,
            ])
            ->assertRedirect(route('tareas.index'));

        $this->assertDatabaseHas('tareas', [
            'id' => $tarea->id,
            'titulo' => 'Actualizada',
            'usuario_id' => $ana->id,
            'categoria_id' => $categoriaDeAna->id,
        ]);
    }

    public function test_update_cannot_use_another_users_category(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $tarea = $this->tareaDe($ana);
        $categoriaDeBeto = $this->categoriaDe($beto, 'Categoría de Beto');

        $this->actingAs($ana)
            ->put(route('tareas.update', $tarea), [
                'titulo' => 'Intento',
                'descripcion' => 'Descripción',
                'categoria_id' => $categoriaDeBeto->id,
            ])
            ->assertSessionHasErrors('categoria_id');

        $this->assertDatabaseHas('tareas', [
            'id' => $tarea->id,
            'titulo' => $tarea->titulo,
        ]);
    }

    public function test_update_estado_accepts_valid_values(): void
    {
        $user = User::factory()->create();
        $tarea = $this->tareaDe($user, ['estado' => 'pendiente']);

        $this->actingAs($user)
            ->patch(route('tareas.estado', $tarea), ['estado' => 'completada'])
            ->assertRedirect(route('tareas.index'));

        $this->assertDatabaseHas('tareas', [
            'id' => $tarea->id,
            'estado' => 'completada',
        ]);
    }

    public function test_update_estado_rejects_invalid_values(): void
    {
        $user = User::factory()->create();
        $tarea = $this->tareaDe($user, ['estado' => 'pendiente']);

        $this->actingAs($user)
            ->patch(route('tareas.estado', $tarea), ['estado' => 'archivada'])
            ->assertSessionHasErrors('estado');

        $this->assertDatabaseHas('tareas', [
            'id' => $tarea->id,
            'estado' => 'pendiente',
        ]);
    }

    public function test_destroy_moves_the_task_to_the_trash(): void
    {
        $user = User::factory()->create();
        $tarea = $this->tareaDe($user);

        $this->actingAs($user)
            ->delete(route('tareas.destroy', $tarea))
            ->assertRedirect(route('tareas.index'));

        $this->assertSoftDeleted('tareas', ['id' => $tarea->id]);
    }

    public function test_trash_only_lists_the_authenticated_users_tasks(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $tareaDeAna = $this->tareaDe($ana, ['titulo' => 'Papelera de Ana']);
        $tareaDeBeto = $this->tareaDe($beto, ['titulo' => 'Papelera de Beto']);

        $tareaDeAna->delete();
        $tareaDeBeto->delete();

        $this->actingAs($ana)
            ->get(route('tareas.trash'))
            ->assertOk()
            ->assertSee('Papelera de Ana')
            ->assertDontSee('Papelera de Beto');
    }

    public function test_user_can_restore_own_trashed_task(): void
    {
        $user = User::factory()->create();
        $tarea = $this->tareaDe($user);

        $tarea->delete();

        $this->actingAs($user)
            ->patch(route('tareas.restore', $tarea->id))
            ->assertRedirect(route('tareas.trash'))
            ->assertSessionHas('success');

        $this->assertNotSoftDeleted('tareas', ['id' => $tarea->id]);
    }

    public function test_user_can_force_delete_own_trashed_task(): void
    {
        $user = User::factory()->create();
        $tarea = $this->tareaDe($user);

        $tarea->delete();

        $this->actingAs($user)
            ->delete(route('tareas.forceDelete', $tarea->id))
            ->assertRedirect(route('tareas.trash'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('tareas', ['id' => $tarea->id]);
    }

    public function test_task_factory_keeps_task_and_category_with_same_owner(): void
    {
        $tarea = Tarea::factory()->create();

        $this->assertSame($tarea->usuario_id, $tarea->categoria->user_id);
    }

    public function test_related_user_can_see_task_category_and_owner(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user, 'Categoría visible');
        $tarea = $this->tareaDe($user, ['categoria_id' => $categoria->id]);

        $this->assertSame($user->id, $tarea->usuario->id);
        $this->assertSame($categoria->id, $tarea->categoria->id);
    }
}
