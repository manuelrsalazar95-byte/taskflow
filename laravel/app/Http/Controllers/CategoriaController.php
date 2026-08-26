<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public ?array $extended = null;

    public function __construct()
    {
        $this->extended = [
            'titulo' => 'Categorías',
            'descripcion' => 'Gestión de Categorías',
        ];
    }

    public function index()
    {
        $this->extended['model'] = Categoria::orderBy('id', 'desc')->get();

        return view('categorias.index', $this->extended);
    }

    public function create()
    {
        $this->extended['titulo'] = 'Crear Categoría';
        $this->extended['descripcion'] = 'Formulario para crear una nueva categoría.';
        return view('categorias.create', $this->extended);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Categoria::create($validatedData);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }

    public function edit(Categoria $categoria)
    {
        $this->extended['model'] = $categoria;
        $this->extended['descripcion'] = 'Editar categoría seleccionada.';

        return view('categorias.edit', $this->extended);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categoria->update($validatedData);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }
}