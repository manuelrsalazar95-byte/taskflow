<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TareasController extends Controller
{
    public function index(Request $request): View
    {
        $query = Tarea::with(['categoria', 'usuario']);

        // Búsqueda por título o descripción
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('titulo', 'ilike', "%{$buscar}%")
                    ->orWhere('descripcion', 'ilike', "%{$buscar}%");
            });
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Filtro por categoría
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        return view('tareas.index', [
            'titulo' => 'Tareas',
            'descripcion' => 'Gestión de Tareas',
            'model' => $query->orderBy('id', 'desc')->paginate(10)->withQueryString(),
            'categorias' => Categoria::orderBy('name')->get(),
            'filtros' => $request->only(['buscar', 'estado', 'categoria_id']),
        ]);
    }

    public function create(): View
    {
        return view('tareas.create', [
            'titulo' => 'Crear Tarea',
            'descripcion' => 'Formulario para crear una nueva tarea.',
            'categorias' => Categoria::orderBy('name')->get(),
            'usuarios' => User::orderBy('user_name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categoria,id',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        Tarea::create([
            'categoria_id' => $request->categoria_id,
            'usuario_id' => $request->usuario_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente',
        ]);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea creada correctamente.');
    }

    public function edit(Tarea $tarea): View
    {
        return view('tareas.edit', [
            'titulo' => 'Editar Tarea',
            'descripcion' => 'Formulario para modificar la tarea.',
            'tarea' => $tarea,
            'categorias' => Categoria::orderBy('name')->get(),
            'usuarios' => User::orderBy('user_name')->get(),
        ]);
    }

    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categoria,id',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        $tarea->update([
            'categoria_id' => $request->categoria_id,
            'usuario_id' => $request->usuario_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea actualizada correctamente.');
    }

    public function updateEstado(Request $request, Tarea $tarea)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,en_progreso,completada',
        ]);

        $tarea->update([
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Estado de la tarea actualizado correctamente.');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea enviada a la papelera correctamente.');
    }

    public function trash(): View
    {
        return view('tareas.trash', [
            'titulo' => 'Papelera de Tareas',
            'descripcion' => 'Tareas eliminadas recientemente.',
            'model' => Tarea::onlyTrashed()
                ->with(['categoria', 'usuario'])
                ->orderBy('deleted_at', 'desc')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function restore($id)
    {
        $tarea = Tarea::onlyTrashed()->findOrFail($id);
        $tarea->restore();

        return redirect()
            ->route('tareas.trash')
            ->with('success', 'Tarea restaurada correctamente.');
    }

    public function forceDelete($id)
    {
        $tarea = Tarea::onlyTrashed()->findOrFail($id);
        $tarea->forceDelete();

        return redirect()
            ->route('tareas.trash')
            ->with('success', 'Tarea eliminada definitivamente.');
    }
}
