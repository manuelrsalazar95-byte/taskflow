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
        $admin = User::create([
            'user_name' => 'admin',
            'email' => 'admin@taskflow.com',
            'password' => Hash::make('password'),
        ]);

        // Admin + 3 usuarios adicionales
        $usuarios = collect([$admin])->merge(User::factory(3)->create());

        // Cada usuario tiene sus propias categorías y tareas.
        foreach ($usuarios as $usuario) {
            $categorias = Categoria::factory()
                ->count(3)
                ->create(['user_id' => $usuario->id]);

            for ($i = 0; $i < 5; $i++) {
                Tarea::factory()->create([
                    'usuario_id' => $usuario->id,
                    'categoria_id' => $categorias->random()->id,
                ]);
            }
        }
    }
}
