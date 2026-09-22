<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario admin por defecto
        User::create([
            'user_name' => 'admin',
            'email' => 'admin@taskflow.com',
            'password' => Hash::make('password'),
        ]);

        // Crear 3 usuarios adicionales
        User::factory(3)->create();

        // Crear categorías
        $categorias = Categoria::factory(8)->create();

        // Crear 15 tareas con relaciones
        Tarea::factory(15)->create([
            'categoria_id' => $categorias->random()->id,
            'usuario_id' => User::inRandomOrder()->first()->id,
        ]);
    }
}
