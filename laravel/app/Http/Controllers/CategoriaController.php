<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Iluminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoriaController extends Controller
{   
    public ?array $extended = null;
    public function __construct()
    {
        $this->extended = [
            'titulo' => 'categorias',
            'descripcion' => 'Gestión de categorias',
        ];
    }
    public function index()
    {
        $this->extended['model'] = Categoria::orderBy('id','desc')->get();
        return view('categorias.index', $this->extended);
    }

    public function create()
    {
        return view('categorias.create', $this->extended);
    }
}