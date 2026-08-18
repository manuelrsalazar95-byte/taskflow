@extends('layouts.base')
@section('body')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <div class="mb-4 text-center">
            <h1 class="text-2xl font-semibold text-gray-800">Bienvenido a TaskFlow</h1>
            <p class="text-gray-600">Gestiona tus tareas de manera eficiente</p>
        </div>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @yield('content')
        </div>
    </div>
@endsection