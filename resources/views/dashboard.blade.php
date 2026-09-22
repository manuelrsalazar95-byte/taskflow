@extends('layouts.app')

@section('title', 'Dashboard · TaskFlow')

@section('content')

<div class="space-y-6">

    {{-- ENCABEZADO --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center" aria-hidden="true">
                    <span class="material-symbols-outlined text-blue-700" aria-hidden="true" focusable="false">dashboard</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Dashboard
                    </h1>
                    <p class="text-gray-500">
                        Bienvenido, {{ Auth::user()->user_name }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- TARJETAS DE ESTADÍSTICAS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Total Tareas --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                <span class="material-symbols-outlined text-blue-700" aria-hidden="true" focusable="false">task_alt</span>
            </div>
            <div>
                <p class="text-sm text-gray-500" id="stat-total-label">Total Tareas</p>
                <p class="text-2xl font-bold text-gray-800" aria-labelledby="stat-total-label">{{ $stats['total'] }}</p>
            </div>
        </div>

        {{-- Pendientes --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                <span class="material-symbols-outlined text-yellow-700" aria-hidden="true" focusable="false">schedule</span>
            </div>
            <div>
                <p class="text-sm text-gray-500" id="stat-pendientes-label">Pendientes</p>
                <p class="text-2xl font-bold text-gray-800" aria-labelledby="stat-pendientes-label">{{ $stats['pendientes'] }}</p>
            </div>
        </div>

        {{-- En Progreso --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                <span class="material-symbols-outlined text-indigo-700" aria-hidden="true" focusable="false">pending</span>
            </div>
            <div>
                <p class="text-sm text-gray-500" id="stat-progreso-label">En Progreso</p>
                <p class="text-2xl font-bold text-gray-800" aria-labelledby="stat-progreso-label">{{ $stats['en_progreso'] }}</p>
            </div>
        </div>

        {{-- Completadas --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                <span class="material-symbols-outlined text-green-700" aria-hidden="true" focusable="false">check_circle</span>
            </div>
            <div>
                <p class="text-sm text-gray-500" id="stat-completadas-label">Completadas</p>
                <p class="text-2xl font-bold text-gray-800" aria-labelledby="stat-completadas-label">{{ $stats['completadas'] }}</p>
            </div>
        </div>

    </div>

    {{-- SEGUNDA FILA --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

        {{-- Mis Tareas --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                <span class="material-symbols-outlined text-purple-700" aria-hidden="true" focusable="false">person</span>
            </div>
            <div>
                <p class="text-sm text-gray-500" id="stat-mis-label">Mis Tareas</p>
                <p class="text-2xl font-bold text-gray-800" aria-labelledby="stat-mis-label">{{ $stats['mis_tareas'] }}</p>
            </div>
        </div>

        {{-- Categorías --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-pink-100 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                <span class="material-symbols-outlined text-pink-700" aria-hidden="true" focusable="false">folder</span>
            </div>
            <div>
                <p class="text-sm text-gray-500" id="stat-categorias-label">Categorías</p>
                <p class="text-2xl font-bold text-gray-800" aria-labelledby="stat-categorias-label">{{ $stats['categorias'] }}</p>
            </div>
        </div>

        {{-- Papelera --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0" aria-hidden="true">
                <span class="material-symbols-outlined text-gray-700" aria-hidden="true" focusable="false">delete_sweep</span>
            </div>
            <div>
                <p class="text-sm text-gray-500" id="stat-papelera-label">Papelera</p>
                <p class="text-2xl font-bold text-gray-800" aria-labelledby="stat-papelera-label">{{ $stats['papelera'] }}</p>
            </div>
        </div>

    </div>

    {{-- TAREAS RECIENTES --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-700">
                Tareas Recientes
            </h2>
            <a href="{{ route('tareas.index') }}"
               aria-label="Ver todas las tareas"
               class="text-sm text-blue-700 hover:text-blue-800 font-medium">
                Ver todas <span aria-hidden="true">→</span>
            </a>
        </div>

        <div class="overflow-x-auto" role="region" aria-label="Tabla de tareas recientes" tabindex="0">
            <table class="w-full">
                <caption class="sr-only">Cinco tareas más recientes con su categoría, estado y responsable</caption>
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Título
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Categoría
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Asignada a
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tareasRecientes as $tarea)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 border-t font-medium text-gray-700">
                                {{ $tarea->titulo }}
                            </td>
                            <td class="px-6 py-4 border-t text-gray-600 text-sm">
                                {{ $tarea->categoria->name ?? 'Sin categoría' }}
                            </td>
                            <td class="px-6 py-4 border-t text-center">
                                @if($tarea->estado == 'pendiente')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">
                                        Pendiente
                                    </span>
                                @elseif($tarea->estado == 'en_progreso')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-semibold">
                                        En progreso
                                    </span>
                                @elseif($tarea->estado == 'completada')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">
                                        Completada
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 border-t text-sm text-gray-600">
                                {{ $tarea->usuario->user_name ?? 'Sin asignar' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <p class="text-gray-500 text-sm">No hay tareas recientes.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
