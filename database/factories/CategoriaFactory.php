<?php

namespace Database\Factories;

use App\Models\Categoria;
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
        ];

        return [
            'name' => fake()->unique()->randomElement($nombres),
        ];
    }
}
