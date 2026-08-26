<?php

namespace App\Http\Controllers;

use App\Models\Tareas;
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

    /**
     * Mostrar todas las tareas
     */
    public function index()
    {
        $this->extended['model'] = Tareas::orderBy('id', 'desc')->get();

        return view('tareas.index', $this->extended);
    }

    /**
     * Mostrar formulario para crear una tarea
     */
    public function create()
    {
        $this->extended['titulo'] = 'Crear Tarea';
        $this->extended['descripcion'] = 'Formulario para crear una nueva tarea.';

        return view('tareas.create', $this->extended);
    }

    /**
     * Guardar una tarea
     */
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
}