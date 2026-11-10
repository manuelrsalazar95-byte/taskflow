<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // Una sola consulta para todas las métricas de las tareas del usuario.
        $metricas = Tarea::where('usuario_id', $user->id)
            ->selectRaw("
                count(*) as total,
                coalesce(sum(case when estado = 'pendiente' then 1 else 0 end), 0) as pendientes,
                coalesce(sum(case when estado = 'en_progreso' then 1 else 0 end), 0) as en_progreso,
                coalesce(sum(case when estado = 'completada' then 1 else 0 end), 0) as completadas
            ")
            ->toBase()
            ->first();

        $stats = [
            'total' => (int) $metricas->total,
            'pendientes' => (int) $metricas->pendientes,
            'en_progreso' => (int) $metricas->en_progreso,
            'completadas' => (int) $metricas->completadas,
            'mis_tareas' => (int) $metricas->total,
            'categorias' => Categoria::where('user_id', $user->id)->count(),
            'papelera' => Tarea::onlyTrashed()->where('usuario_id', $user->id)->count(),
        ];

        $tareasRecientes = Tarea::with(['categoria', 'usuario'])
            ->where('usuario_id', $user->id)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'tareasRecientes'));
    }
}
