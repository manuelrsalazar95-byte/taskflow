<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TareasController;
use Illuminate\Support\Facades\Route;

// Invitado: solo puede ver login/registro.
// throttle SOLO en los envíos (POST): limita los intentos de fuerza bruta sin castigar las recargas.
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:10,1');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
});

// Autenticado
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rutas para categoria
    Route::resource('categorias', CategoriaController::class)->except(['show']);

    // Rutas para tareas
    Route::get('/tareas/papelera', [TareasController::class, 'trash'])->name('tareas.trash');
    Route::patch('/tareas/{tarea}/restore', [TareasController::class, 'restore'])->name('tareas.restore');
    Route::delete('/tareas/{tarea}/force', [TareasController::class, 'forceDelete'])->name('tareas.forceDelete');
    Route::patch('/tareas/{tarea}/estado', [TareasController::class, 'updateEstado'])->name('tareas.estado');
    Route::resource('tareas', TareasController::class)->except(['show']);
});
