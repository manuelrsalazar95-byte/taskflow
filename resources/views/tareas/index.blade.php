@extends('layouts.app')

@section('title', 'Tareas · TaskFlow')

@section('content')

<div class="space-y-6">

    {{-- ENCABEZADO --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center" aria-hidden="true">
                <span class="material-symbols-outlined text-blue-700" aria-hidden="true" focusable="false">task_alt</span>
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

        {{-- CREAR Y PAPELERA --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('tareas.trash') }}"
               class="inline-flex items-center gap-2 px-4 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium shadow-sm transition">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">delete_sweep</span>
                Papelera
            </a>

            <a href="{{ route('tareas.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-green-700 hover:bg-green-800 text-white font-medium shadow-sm transition">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">add</span>
                Crear Tarea
            </a>
        </div>

    </div>

    {{-- BÚSQUEDA Y FILTROS --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4">
        <form action="{{ route('tareas.index') }}" method="GET" id="filterForm" aria-label="Búsqueda y filtros de tareas">
            <div class="flex flex-col sm:flex-row gap-3">

                {{-- Búsqueda --}}
                <div class="relative flex-1">
                    <label for="buscar" class="sr-only">Buscar por título o descripción</label>
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-[20px]"
                          aria-hidden="true" focusable="false">search</span>
                    <input
                        type="search"
                        id="buscar"
                        name="buscar"
                        value="{{ $filtros['buscar'] ?? '' }}"
                        placeholder="Buscar por título o descripción..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 bg-white text-sm text-gray-700
                               placeholder:text-gray-500 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition">
                </div>

                {{-- Filtro Estado --}}
                <div class="sm:w-[190px]">
                    <label for="estado" class="sr-only">Filtrar por estado</label>
                    <select
                        name="estado"
                        id="estado"
                        onchange="document.getElementById('filterForm').submit()"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-300 bg-white text-sm text-gray-700
                               outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition">
                        <option value="" {{ ($filtros['estado'] ?? '') === '' ? 'selected' : '' }}>Todos los estados</option>
                        <option value="pendiente" {{ ($filtros['estado'] ?? '') === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en_progreso" {{ ($filtros['estado'] ?? '') === 'en_progreso' ? 'selected' : '' }}>En progreso</option>
                        <option value="completada" {{ ($filtros['estado'] ?? '') === 'completada' ? 'selected' : '' }}>Completada</option>
                    </select>
                </div>

                {{-- Filtro Categoría --}}
                <div class="sm:w-[210px]">
                    <label for="categoria_id" class="sr-only">Filtrar por categoría</label>
                    <select
                        name="categoria_id"
                        id="categoria_id"
                        onchange="document.getElementById('filterForm').submit()"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-300 bg-white text-sm text-gray-700
                               outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition">
                        <option value="" {{ ($filtros['categoria_id'] ?? '') === '' ? 'selected' : '' }}>Todas las categorías</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ (string) ($filtros['categoria_id'] ?? '') === (string) $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Aplicar (por si el navegador no envía el change) y limpiar --}}
                <div class="flex items-center gap-2">
                    <button type="submit"
                            class="px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">
                        Aplicar
                    </button>

                    @if(count($filtros))
                        <a href="{{ route('tareas.index') }}"
                           class="px-4 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium transition">
                            Limpiar
                        </a>
                    @endif
                </div>

            </div>
        </form>
    </div>


    {{-- TABLA --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-700">
                Lista de Tareas
            </h2>
        </div>

        <div class="overflow-x-auto pb-4" role="region" aria-label="Tabla de tareas" tabindex="0">

            <table class="w-full">
                <caption class="sr-only">
                    Listado de tareas con identificador, título, descripción, categoría, responsable, estado y acciones disponibles
                </caption>

                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            ID
                        </th>

                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Título
                        </th>

                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Descripción
                        </th>

                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Categoría
                        </th>

                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Asignada a
                        </th>

                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Estado
                        </th>

                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($model as $x)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- ID --}}
                            <td class="px-6 py-4 border-t">
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-semibold">
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

                            {{-- CATEGORÍA --}}
                            <td class="px-6 py-4 border-t text-sm text-gray-600">
                                {{ $x->categoria->name ?? 'Sin categoría' }}
                            </td>

                            {{-- ASIGNADA A --}}
                            <td class="px-6 py-4 border-t text-sm text-gray-600">
                                {{ $x->usuario->user_name ?? 'Sin asignar' }}
                            </td>

                            {{-- ESTADO --}}
                            <td class="px-6 py-4 border-t text-center relative">

                                <div class="relative inline-block text-left">
                                    <button type="button"
                                            onclick="toggleStatusDropdown({{ $x->id }})"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            aria-controls="status-menu-{{ $x->id }}"
                                            class="inline-flex items-center gap-1.5 text-xs font-semibold rounded-full px-3.5 py-1.5 border cursor-pointer transition shadow-sm
                                            @if($x->estado == 'pendiente') bg-yellow-100 text-yellow-800 border-yellow-300 hover:bg-yellow-200
                                            @elseif($x->estado == 'en_progreso') bg-blue-100 text-blue-800 border-blue-300 hover:bg-blue-200
                                            @elseif($x->estado == 'completada') bg-green-100 text-green-800 border-green-300 hover:bg-green-200
                                            @endif">
                                        <span class="sr-only">Estado de la tarea «{{ $x->titulo }}»: </span>
                                        @if($x->estado == 'pendiente') Pendiente
                                        @elseif($x->estado == 'en_progreso') En progreso
                                        @elseif($x->estado == 'completada') Completada
                                        @endif
                                        <span class="material-symbols-outlined text-[14px]" aria-hidden="true" focusable="false">expand_more</span>
                                    </button>

                                    <div id="status-menu-{{ $x->id }}"
                                         class="hidden absolute left-1/2 -translate-x-1/2 mt-2 w-48 rounded-xl bg-white shadow-xl border border-gray-100 py-1.5 z-50 text-left">
                                        <form action="{{ route('tareas.estado', $x->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="estado" id="input-estado-{{ $x->id }}">

                                            <button type="submit" onclick="document.getElementById('input-estado-{{ $x->id }}').value='pendiente'"
                                                class="w-full text-left px-4 py-2 text-xs font-medium text-yellow-800 hover:bg-yellow-50 flex items-center gap-2 transition">
                                                <span class="w-2 h-2 rounded-full bg-yellow-500" aria-hidden="true"></span>
                                                <span class="sr-only">Cambiar el estado de «{{ $x->titulo }}» a </span>Pendiente
                                            </button>

                                            <button type="submit" onclick="document.getElementById('input-estado-{{ $x->id }}').value='en_progreso'"
                                                class="w-full text-left px-4 py-2 text-xs font-medium text-blue-800 hover:bg-blue-50 flex items-center gap-2 transition">
                                                <span class="w-2 h-2 rounded-full bg-blue-500" aria-hidden="true"></span>
                                                <span class="sr-only">Cambiar el estado de «{{ $x->titulo }}» a </span>En progreso
                                            </button>

                                            <button type="submit" onclick="document.getElementById('input-estado-{{ $x->id }}').value='completada'"
                                                class="w-full text-left px-4 py-2 text-xs font-medium text-green-800 hover:bg-green-50 flex items-center gap-2 transition">
                                                <span class="w-2 h-2 rounded-full bg-green-500" aria-hidden="true"></span>
                                                <span class="sr-only">Cambiar el estado de «{{ $x->titulo }}» a </span>Completada
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </td>

                            {{-- ACCIONES --}}
                            <td class="px-6 py-4 border-t">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('tareas.edit', $x->id) }}"
                                       aria-label="Editar la tarea «{{ $x->titulo }}»"
                                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 transition">
                                        <span class="material-symbols-outlined text-[16px]" aria-hidden="true" focusable="false">edit</span>
                                        Editar
                                    </a>

                                    <form action="{{ route('tareas.destroy', $x->id) }}"
                                          method="POST" class="inline-flex items-center m-0">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                data-confirm="¿Está seguro de enviar a la papelera la tarea «{{ $x->titulo }}»?"
                                                onclick="return confirm(this.dataset.confirm)"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100 transition">
                                            <span class="material-symbols-outlined text-[16px]" aria-hidden="true" focusable="false">delete</span>
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
                                    <span class="material-symbols-outlined text-6xl text-gray-500" aria-hidden="true" focusable="false">task_off</span>

                                    <p class="text-gray-600 font-medium">
                                        @if(count($filtros))
                                            No hay tareas que coincidan con los filtros
                                        @else
                                            No hay tareas registradas
                                        @endif
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        @if(count($filtros))
                                            Prueba a cambiar la búsqueda o limpiar los filtros.
                                        @else
                                            Crea tu primera tarea para comenzar.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINACIÓN --}}
        @if($model->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $model->links() }}
            </div>
        @endif

    </div>

</div>

<script>
    // Menús de estado por fila
    function toggleStatusDropdown(id) {
        document.querySelectorAll('[id^="status-menu-"]').forEach(function (menu) {
            if (menu.id !== 'status-menu-' + id) {
                menu.classList.add('hidden');
                document.querySelector('[aria-controls="' + menu.id + '"]')?.setAttribute('aria-expanded', 'false');
            }
        });

        const menu = document.getElementById('status-menu-' + id);
        const trigger = document.querySelector('[aria-controls="status-menu-' + id + '"]');
        const willOpen = menu.classList.contains('hidden');

        menu.classList.toggle('hidden');
        trigger.setAttribute('aria-expanded', String(willOpen));
    }

    function closeStatusMenus() {
        document.querySelectorAll('[id^="status-menu-"]').forEach(function (menu) {
            menu.classList.add('hidden');
            document.querySelector('[aria-controls="' + menu.id + '"]')?.setAttribute('aria-expanded', 'false');
        });
    }

    document.addEventListener('click', function (e) {
        if (!e.target.closest('[onclick^="toggleStatusDropdown"]') && !e.target.closest('[id^="status-menu-"]')) {
            closeStatusMenus();
        }
    });

    // Escape cierra los menús y devuelve el foco al disparador (WCAG 2.1.2)
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;

        const openMenu = document.querySelector('[id^="status-menu-"]:not(.hidden)');
        if (openMenu) {
            const trigger = document.querySelector('[aria-controls="' + openMenu.id + '"]');
            closeStatusMenus();
            trigger?.focus();
        }
    });
</script>

@endsection
