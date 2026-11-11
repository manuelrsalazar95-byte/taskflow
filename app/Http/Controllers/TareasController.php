<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaEstadoRequest;
use App\Http\Requests\UpdateTareaRequest;
use App\Models\Categoria;
use App\Models\Tarea;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TareasController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $query = Tarea::with(['categoria', 'usuario'])
            ->where('usuario_id', $user->id);

        // Búsqueda por título o descripción. Se usa LOWER + LIKE para que
        // funcione igual en PostgreSQL y SQLite (antes se usaba ilike).
        if ($request->filled('buscar')) {
            $buscar = mb_strtolower((string) $request->input('buscar'));

            $query->where(function ($q) use ($buscar) {
                $q->whereRaw('LOWER(titulo) LIKE ?', ["%{$buscar}%"])
                    ->orWhereRaw('LOWER(descripcion) LIKE ?', ["%{$buscar}%"]);
            });
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Filtro por categoría (solo categorías propias)
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        return view('tareas.index', [
            'titulo' => 'Tareas',
            'descripcion' => 'Gestión de Tareas',
            'model' => $query->orderBy('id', 'desc')->paginate(10)->withQueryString(),
            'categorias' => Categoria::where('user_id', $user->id)->orderBy('name')->get(),
            'filtros' => $request->only(['buscar', 'estado', 'categoria_id']),
        ]);
    }

    public function create(Request $request): View
    {
        return view('tareas.create', [
            'titulo' => 'Crear Tarea',
            'descripcion' => 'Formulario para crear una nueva tarea.',
            'categorias' => Categoria::where('user_id', $request->user()->id)->orderBy('name')->get(),
        ]);
    }

    public function store(StoreTareaRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        Tarea::create([
            'categoria_id' => $validated['categoria_id'],
            'usuario_id' => $user->id,
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'estado' => 'pendiente',
        ]);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea creada correctamente.');
    }

    public function edit(Request $request, Tarea $tarea): View
    {
        $this->authorize('update', $tarea);

        return view('tareas.edit', [
            'titulo' => 'Editar Tarea',
            'descripcion' => 'Formulario para modificar la tarea.',
            'tarea' => $tarea,
            'categorias' => Categoria::where('user_id', $request->user()->id)->orderBy('name')->get(),
        ]);
    }

    public function update(UpdateTareaRequest $request, Tarea $tarea): RedirectResponse
    {
        $validated = $request->validated();

        // El propietario (usuario_id) no se modifica desde el formulario.
        $tarea->update([
            'categoria_id' => $validated['categoria_id'],
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
        ]);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea actualizada correctamente.');
    }

    public function updateEstado(UpdateTareaEstadoRequest $request, Tarea $tarea): RedirectResponse
    {
        $validated = $request->validated();

        $tarea->update([
            'estado' => $validated['estado'],
        ]);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Estado de la tarea actualizado correctamente.');
    }

    public function destroy(Tarea $tarea): RedirectResponse
    {
        $this->authorize('delete', $tarea);

        $tarea->delete();

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea enviada a la papelera correctamente.');
    }

    public function trash(Request $request): View
    {
        $user = $request->user();

        return view('tareas.trash', [
            'titulo' => 'Papelera de Tareas',
            'descripcion' => 'Tareas eliminadas recientemente.',
            'model' => Tarea::onlyTrashed()
                ->where('usuario_id', $user->id)
                ->with(['categoria', 'usuario'])
                ->orderBy('deleted_at', 'desc')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function restore(int $id): RedirectResponse
    {
        $tarea = Tarea::onlyTrashed()
            ->where('usuario_id', Auth::id())
            ->findOrFail($id);

        $this->authorize('restore', $tarea);

        $tarea->restore();

        return redirect()
            ->route('tareas.trash')
            ->with('success', 'Tarea restaurada correctamente.');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $tarea = Tarea::onlyTrashed()
            ->where('usuario_id', Auth::id())
            ->findOrFail($id);

        $this->authorize('forceDelete', $tarea);

        $tarea->forceDelete();

        return redirect()
            ->route('tareas.trash')
            ->with('success', 'Tarea eliminada definitivamente.');
    }
}
