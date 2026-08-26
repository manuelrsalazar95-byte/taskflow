@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
    
    <div class="flex items-center gap-4 mb-4">
        <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">
            🚀
        </div>

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Bienvenido a TaskFlow
            </h1>

            <p class="text-gray-500">
                Gestiona tus tareas, categorías y proyectos de manera simple y organizada.
            </p>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        
        <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
            <h3 class="font-semibold text-blue-700">📋 Tareas</h3>
            <p class="text-sm text-gray-600 mt-1">
                Administra y da seguimiento a tus actividades.
            </p>
        </div>

        <div class="bg-green-50 border border-green-100 rounded-lg p-4">
            <h3 class="font-semibold text-green-700">📁 Categorías</h3>
            <p class="text-sm text-gray-600 mt-1">
                Organiza la información de forma eficiente.
            </p>
        </div>

        <div class="bg-purple-50 border border-purple-100 rounded-lg p-4">
            <h3 class="font-semibold text-purple-700">📈 Productividad</h3>
            <p class="text-sm text-gray-600 mt-1">
                Mantén el control de tus avances y objetivos.
            </p>
        </div>

    </div>

</div>

@endsection