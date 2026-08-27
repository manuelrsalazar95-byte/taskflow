@extends('layouts.base')

@section('body')

<div
    class="min-h-screen flex items-center justify-center p-6
           bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100">

    <div
        class="w-full max-w-md
               bg-white/90 backdrop-blur
               rounded-3xl
               shadow-xl
               border border-white/50
               overflow-hidden">

        {{-- HEADER --}}
        <div class="px-8 pt-8 pb-6 text-center">

            <div
                class="w-20 h-20 mx-auto mb-5
                       rounded-3xl
                       bg-blue-600
                       flex items-center justify-center
                       shadow-lg">

                <span class="material-symbols-outlined text-white text-4xl">
                    task_alt
                </span>

            </div>

            <h1 class="text-3xl font-bold text-gray-800">
                TaskFlow
            </h1>

            <p class="text-gray-500 mt-2">
                Gestiona tus tareas de manera simple y eficiente
            </p>

        </div>

        {{-- CONTENIDO --}}
        <div class="px-8 pb-8">
            @yield('content')
        </div>

    </div>

</div>

@endsection