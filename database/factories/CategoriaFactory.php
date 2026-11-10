<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition(): array
    {
        $nombres = [
            'Desarrollo web', 'Diseño UX/UI', 'Marketing digital',
            'Base de datos', 'Proyecto final', 'Investigación',
            'Soporte técnico', 'Infraestructura', 'Seguridad',
            'Móvil', 'Testing', 'DevOps',
            'Análisis de datos', 'Automatización', 'Documentación',
            'Innovación', 'Logística', 'Recursos Humanos',
            'Ventas', 'Educación',
        ];

        return [
            'name' => fake()->randomElement($nombres),
            'user_id' => User::factory(),
        ];
    }
}
