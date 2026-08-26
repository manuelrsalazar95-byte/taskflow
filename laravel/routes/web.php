<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;



Route::middleware('guest')->group(function () {
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);

    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    //Rutas para categoria
    Route::resource('categorias', CategoriaController::class)->except(['show']);

});