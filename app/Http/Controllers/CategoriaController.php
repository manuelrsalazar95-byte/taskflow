<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        return view('categorias.index', [
            'titulo' => 'Categorías',
            'descripcion' => 'Gestión de Categorías',
            'model' => Categoria::where('user_id', $user->id)
                ->withCount(['tareas' => fn ($query) => $query->where('usuario_id', $user->id)])
                ->orderBy('id', 'desc')
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('categorias.create', [
            'titulo' => 'Crear Categoría',
            'descripcion' => 'Formulario para crear una nueva categoría.',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categoria', 'name')->where(
                    fn ($query) => $query->where('user_id', $user->id)->whereNull('deleted_at')
                ),
            ],
        ], [
            'name.unique' => 'Ya existe una categoría con ese nombre.',
        ]);

        Categoria::create([
            'name' => $validated['name'],
            'user_id' => $user->id,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function edit(Categoria $categoria): View
    {
        $this->authorize('update', $categoria);

        return view('categorias.edit', [
            'titulo' => 'Editar Categoría',
            'descripcion' => 'Editar categoría seleccionada.',
            'model' => $categoria,
        ]);
    }

    public function update(Request $request, Categoria $categoria): RedirectResponse
    {
        $this->authorize('update', $categoria);

        $user = $request->user();

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categoria', 'name')
                    ->where(fn ($query) => $query->where('user_id', $user->id)->whereNull('deleted_at'))
                    ->ignore($categoria->id),
            ],
        ], [
            'name.unique' => 'Ya existe una categoría con ese nombre.',
        ]);

        $categoria->update($request->only('name'));

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(Categoria $categoria): RedirectResponse
    {
        $this->authorize('delete', $categoria);

        // Evita dejar tareas huérfanas, incluidas las que están en la papelera.
        if ($categoria->tareas()->withTrashed()->exists()) {
            return redirect()
                ->route('categorias.index')
                ->with('error', 'No se puede eliminar la categoría "'.$categoria->name.'" porque tiene tareas asociadas.');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
