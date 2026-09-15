<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\AuthController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rutas para categoria
    Route::resource('categorias', CategoriaController::class)->except(['show']);

    // Rutas para tareas
    Route::get('/tareas/papelera', [TareasController::class, 'trash'])->name('tareas.trash');
    Route::patch('/tareas/{id}/restore', [TareasController::class, 'restore'])->name('tareas.restore');
    Route::delete('/tareas/{id}/force', [TareasController::class, 'forceDelete'])->name('tareas.forceDelete');
    Route::patch('/tareas/{id}/estado', [TareasController::class, 'updateEstado'])->name('tareas.estado');
    Route::resource('tareas', TareasController::class)->except(['show']);
});