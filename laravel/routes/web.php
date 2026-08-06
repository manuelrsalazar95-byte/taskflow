<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    $personas = [
        [
            'nombre' => "León XIV",
            'edad' => 57,
            'rol' => "Papa"
        ],
        [
            'nombre' => "Francisco I",
            'edad' => 87,
            'rol' => "Papa"
        ],
        [
            'nombre' => "Juan Pablo II",
            'edad' => 84,
            'rol' => "Papa"
        ]
    ];
    return view('welcome', compact('personas'));
});

Route::get('/about', function () {
    return view('about');
});
