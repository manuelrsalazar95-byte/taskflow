@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- ENCABEZADO --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-600">
                        task_alt
                    </span>
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ ucfirst($titulo) }}
                    </h1>

                    <p class="text-gray-500">
                        {{ $descripcion }}
                    </p>
                </div>

            </div>
        </div>

        {{-- CREAR Y PAPELERA --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('tareas.trash') }}"
                class="inline-flex items-center gap-2 px-4 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium shadow-sm transition">
                <span class="material-symbols-outlined text-[20px]">
                    delete_sweep
                </span>
                Papelera
            </a>

            <a href="{{ route('tareas.create') }}"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-medium shadow-sm transition">

                <span class="material-symbols-outlined text-[20px]">
                    add
                </span>

                Crear Tarea

            </a>
        </div>

    </div>


    {{-- TABLA --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-700">
                Lista de Tareas
            </h2>
        </div>

        <div class="overflow-x-auto pb-4">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Título
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Descripción
                        </th>
                        
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Estado
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($model as $x)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- ID --}}
                            <td class="px-6 py-4 border-t">

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                    #{{ $x->id }}
                                </span>

                            </td>


                            {{-- TÍTULO --}}
                            <td class="px-6 py-4 border-t font-medium text-gray-700">
                                {{ $x->titulo }}
                            </td>


                            {{-- DESCRIPCIÓN --}}
                            <td class="px-6 py-4 border-t text-gray-600">
                                {{ Str::limit($x->descripcion, 50) }}
                            </td>

                            {{-- ESTADO --}}
                            <td class="px-6 py-4 border-t text-center relative">

                                <div class="relative inline-block text-left">
                                    <button type="button" onclick="toggleStatusDropdown({{ $x->id }})"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold rounded-full px-3.5 py-1.5 border cursor-pointer transition shadow-sm
                                        @if($x->estado == 'pendiente') bg-yellow-100 text-yellow-800 border-yellow-300 hover:bg-yellow-200
                                        @elseif($x->estado == 'en_progreso') bg-blue-100 text-blue-800 border-blue-300 hover:bg-blue-200
                                        @elseif($x->estado == 'completada') bg-green-100 text-green-800 border-green-300 hover:bg-green-200
                                        @endif">
                                        <span>
                                            @if($x->estado == 'pendiente') Pendiente
                                            @elseif($x->estado == 'en_progreso') En progreso
                                            @elseif($x->estado == 'completada') Completada
                                            @endif
                                        </span>
                                        <span class="material-symbols-outlined text-[14px]">expand_more</span>
                                    </button>

                                    <div id="status-menu-{{ $x->id }}" class="hidden absolute left-1/2 -translate-x-1/2 mt-2 w-40 rounded-xl bg-white shadow-xl border border-gray-100 py-1.5 z-50 text-left">
                                        <form action="{{ route('tareas.estado', $x->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="estado" id="input-estado-{{ $x->id }}">
                                            
                                            <button type="submit" onclick="document.getElementById('input-estado-{{ $x->id }}').value='pendiente'"
                                                class="w-full text-left px-4 py-2 text-xs font-medium text-yellow-700 hover:bg-yellow-50 flex items-center gap-2 transition">
                                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span> Pendiente
                                            </button>

                                            <button type="submit" onclick="document.getElementById('input-estado-{{ $x->id }}').value='en_progreso'"
                                                class="w-full text-left px-4 py-2 text-xs font-medium text-blue-700 hover:bg-blue-50 flex items-center gap-2 transition">
                                                <span class="w-2 h-2 rounded-full bg-blue-500"></span> En progreso
                                            </button>

                                            <button type="submit" onclick="document.getElementById('input-estado-{{ $x->id }}').value='completada'"
                                                class="w-full text-left px-4 py-2 text-xs font-medium text-green-700 hover:bg-green-50 flex items-center gap-2 transition">
                                                <span class="w-2 h-2 rounded-full bg-green-500"></span> Completada
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </td>


                            {{-- ACCIONES --}}
                            <td class="px-6 py-4 border-t">

                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('tareas.edit', $x->id) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 transition">

                                        <span class="material-symbols-outlined text-[16px]">
                                            edit
                                        </span>

                                        Editar

                                    </a>


                                    <form action="{{ route('tareas.destroy', $x->id) }}"
                                        method="POST" class="inline-flex items-center m-0">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('¿Está seguro de eliminar esta tarea?')"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 transition">

                                            <span class="material-symbols-outlined text-[16px]">
                                                delete
                                            </span>

                                            Eliminar

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="py-16 text-center">

                                <div class="flex flex-col items-center gap-3">

                                    <span class="material-symbols-outlined text-6xl text-gray-300">
                                        task_off
                                    </span>

                                    <p class="text-gray-500 font-medium">
                                        No hay tareas registradas
                                    </p>

                                    <p class="text-sm text-gray-400">
                                        Crea tu primera tarea para comenzar.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>
    function toggleStatusDropdown(id) {
        // Close all other dropdowns first
        document.querySelectorAll('[id^="status-menu-"]').forEach(menu => {
            if (menu.id !== 'status-menu-' + id) {
                menu.classList.add('hidden');
            }
        });
        // Toggle current
        const menu = document.getElementById('status-menu-' + id);
        menu.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    window.addEventListener('click', function(e) {
        if (!e.target.closest('[onclick^="toggleStatusDropdown"]')) {
            document.querySelectorAll('[id^="status-menu-"]').forEach(menu => {
                menu.classList.add('hidden');
            });
        }
    });
</script>

@endsection