<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriasTest extends TestCase
{
    use RefreshDatabase;

    private function categoriaDe(User $user, string $nombre): Categoria
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
        ]);
    }

    public function test_index_only_lists_the_authenticated_users_categories(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $this->categoriaDe($ana, 'Categoría de Ana');
        $this->categoriaDe($beto, 'Categoría de Beto');

        $this->actingAs($ana)
            ->get(route('categorias.index'))
            ->assertOk()
            ->assertSee('Categoría de Ana')
            ->assertDontSee('Categoría de Beto');
    }

    public function test_store_assigns_the_authenticated_user_as_owner(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('categorias.store'), ['name' => 'Nueva categoría'])
            ->assertRedirect(route('categorias.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('categoria', [
            'name' => 'Nueva categoría',
            'user_id' => $user->id,
        ]);
    }

    public function test_store_requires_a_name(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('categorias.store'), [])
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('categoria', 0);
    }

    public function test_two_users_can_share_a_category_name(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();

        $this->actingAs($ana)
            ->post(route('categorias.store'), ['name' => 'Compartida'])
            ->assertSessionHasNoErrors();

        $this->actingAs($beto)
            ->post(route('categorias.store'), ['name' => 'Compartida'])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount('categoria', 2);
    }

    public function test_same_user_cannot_repeat_a_category_name(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('categorias.store'), ['name' => 'Duplicada']);

        $this->actingAs($user)
            ->post(route('categorias.store'), ['name' => 'Duplicada'])
            ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('categoria', 1);
    }

    public function test_name_can_be_reused_after_soft_delete(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user, 'Reciclable');

        $this->actingAs($user)
            ->delete(route('categorias.destroy', $categoria))
            ->assertRedirect(route('categorias.index'));

        $this->assertSoftDeleted('categoria', ['id' => $categoria->id]);

        $this->actingAs($user)
            ->post(route('categorias.store'), ['name' => 'Reciclable'])
            ->assertSessionHasNoErrors();

        $this->assertSame(
            2,
            Categoria::withTrashed()->where('name', 'Reciclable')->count()
        );

        $this->assertSame(
            1,
            Categoria::where('name', 'Reciclable')->count()
        );
    }

    public function test_update_changes_only_the_name_and_keeps_the_owner(): void
    {
        $ana = User::factory()->create();
        $beto = User::factory()->create();
        $categoria = $this->categoriaDe($ana, 'Original');

        $this->actingAs($ana)
            ->put(route('categorias.update', $categoria), [
                'name' => 'Renombrada',
                'user_id' => $beto->id,
            ])
            ->assertRedirect(route('categorias.index'));

        $this->assertDatabaseHas('categoria', [
            'id' => $categoria->id,
            'name' => 'Renombrada',
            'user_id' => $ana->id,
        ]);
    }

    public function test_update_can_keep_its_own_name(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user, 'Sin cambios de nombre');

        $this->actingAs($user)
            ->put(route('categorias.update', $categoria), [
                'name' => 'Sin cambios de nombre',
            ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('categoria', [
            'id' => $categoria->id,
            'name' => 'Sin cambios de nombre',
        ]);
    }

    public function test_destroy_without_tasks_soft_deletes_the_category(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user, 'Vacía');

        $this->actingAs($user)
            ->delete(route('categorias.destroy', $categoria))
            ->assertRedirect(route('categorias.index'))
            ->assertSessionHas('success');

        $this->assertSoftDeleted('categoria', ['id' => $categoria->id]);
    }

    public function test_cannot_destroy_a_category_with_active_tasks(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user, 'Con tareas');
        $this->tareaDe($user, $categoria);

        $this->actingAs($user)
            ->delete(route('categorias.destroy', $categoria))
            ->assertRedirect(route('categorias.index'))
            ->assertSessionHas('error');

        $this->assertNotSoftDeleted('categoria', ['id' => $categoria->id]);
    }

    public function test_cannot_destroy_a_category_with_tasks_in_the_trash(): void
    {
        $user = User::factory()->create();
        $categoria = $this->categoriaDe($user, 'Con tareas en papelera');
        $tarea = $this->tareaDe($user, $categoria);

        $tarea->delete();

        $this->actingAs($user)
            ->delete(route('categorias.destroy', $categoria))
            ->assertRedirect(route('categorias.index'))
            ->assertSessionHas('error');

        $this->assertNotSoftDeleted('categoria', ['id' => $categoria->id]);
    }

    public function test_category_factory_creates_an_owner(): void
    {
        $categoria = Categoria::factory()->create();

        $this->assertNotNull($categoria->user_id);
        $this->assertInstanceOf(User::class, $categoria->usuario);
    }
}
