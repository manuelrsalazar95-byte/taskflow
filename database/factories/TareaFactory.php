<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TareaFactory extends Factory
{
    protected $model = Tarea::class;

    public function definition(): array
    {
        return [
            'usuario_id' => User::factory(),
            'categoria_id' => function (array $attributes) {
                $userId = $attributes['usuario_id'];

                if ($userId instanceof User) {
                    $userId = $userId->id;
                }

                return Categoria::factory()->create(['user_id' => $userId])->id;
            },
            'titulo' => fake()->sentence(4),
            'descripcion' => fake()->sentence(10),
            'estado' => fake()->randomElement(['pendiente', 'en_progreso', 'completada']),
        ];
    }
}
