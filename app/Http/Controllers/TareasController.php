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
            'estado' => 'required|in:pendiente,en_progreso,completada',
        ]);

        Tareas::create([
            'categoria_id' => $request->categoria_id,
            'usuario_id' => $request->usuario_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
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
            'estado' => 'required|in:pendiente,en_progreso,completada',
        ]);

        $tarea->update([
            'categoria_id' => $request->categoria_id,
            'usuario_id' => $request->usuario_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('tareas.index')
            ->with('success', 'Tarea actualizada correctamente.');
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
            ->with('success', 'Tarea eliminada correctamente.');
    }
}