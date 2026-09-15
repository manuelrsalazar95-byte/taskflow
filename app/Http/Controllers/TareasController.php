<?php

namespace App\Http\Controllers;

use App\Models\Tareas;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    public ?array $extended = null;

    public function __construct()
    {
        $this->extended = [
            'titulo' => 'Tareas',
            'descripcion' => 'Gestión de Tareas',
        ];
    }

    public function index()
    {
        $this->extended['model'] = Tareas::with(['categoria', 'usuario'])
            ->orderBy('id', 'desc')
            ->get();

        return view('tareas.index', $this->extended);
    }

    public function create()
    {
        $this->extended['titulo'] = 'Crear Tarea';
        $this->extended['descripcion'] = 'Formulario para crear una nueva tarea.';
        $this->extended['categorias'] = Categoria::all();
        $this->extended['usuarios'] = User::all();

        return view('tareas.create', $this->extended);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categoria,id',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        Tareas::create([
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

    /**
     * Mostrar formulario para editar una tarea
     */
    public function edit($id)
    {
        $tarea = Tareas::findOrFail($id);

        $this->extended['titulo'] = 'Editar Tarea';
        $this->extended['descripcion'] = 'Formulario para modificar la tarea.';
        $this->extended['tarea'] = $tarea;
        $this->extended['categorias'] = Categoria::all();
        $this->extended['usuarios'] = User::all();

        return view('tareas.edit', $this->extended);
    }

    /**
     * Actualizar una tarea en la base de datos
     */
    public function update(Request $request, $id)
    {
        $tarea = Tareas::findOrFail($id);

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

    /**
     * Actualizar solo el estado de la tarea
     */
    public function updateEstado(Request $request, $id)
    {
        $tarea = Tareas::findOrFail($id);

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

    /**
     * Eliminar (soft delete) una tarea
     */
    public function destroy($id)
    {
        $tarea = Tareas::findOrFail($id);
        $tarea->delete();

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea enviada a la papelera correctamente.');
    }

    /**
     * Mostrar la papelera de tareas eliminadas
     */
    public function trash()
    {
        $this->extended['titulo'] = 'Papelera de Tareas';
        $this->extended['descripcion'] = 'Tareas eliminadas recientemente.';
        $this->extended['model'] = Tareas::onlyTrashed()->with(['categoria', 'usuario'])->orderBy('deleted_at', 'desc')->get();

        return view('tareas.trash', $this->extended);
    }

    /**
     * Restaurar una tarea de la papelera
     */
    public function restore($id)
    {
        $tarea = Tareas::onlyTrashed()->findOrFail($id);
        $tarea->restore();

        return redirect()
            ->route('tareas.trash')
            ->with('success', 'Tarea restaurada correctamente.');
    }

    /**
     * Eliminar definitivamente una tarea
     */
    public function forceDelete($id)
    {
        $tarea = Tareas::onlyTrashed()->findOrFail($id);
        $tarea->forceDelete();

        return redirect()
            ->route('tareas.trash')
            ->with('success', 'Tarea eliminada definitivamente.');
    }
}