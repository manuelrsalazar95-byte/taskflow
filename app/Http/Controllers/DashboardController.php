<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Una sola consulta para todas las métricas de tareas (antes eran 5 COUNT independientes)
        $metricas = Tarea::selectRaw("
                count(*) as total,
                coalesce(sum(case when estado = 'pendiente' then 1 else 0 end), 0) as pendientes,
                coalesce(sum(case when estado = 'en_progreso' then 1 else 0 end), 0) as en_progreso,
                coalesce(sum(case when estado = 'completada' then 1 else 0 end), 0) as completadas,
                coalesce(sum(case when usuario_id = ? then 1 else 0 end), 0) as mis_tareas
            ", [$user->id])
            ->toBase()
            ->first();

        $stats = [
            'total' => (int) $metricas->total,
            'pendientes' => (int) $metricas->pendientes,
            'en_progreso' => (int) $metricas->en_progreso,
            'completadas' => (int) $metricas->completadas,
            'mis_tareas' => (int) $metricas->mis_tareas,
            'categorias' => Categoria::count(),
            'papelera' => Tarea::onlyTrashed()->count(),
        ];

        $tareasRecientes = Tarea::with(['categoria', 'usuario'])
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'tareasRecientes'));
    }
}
