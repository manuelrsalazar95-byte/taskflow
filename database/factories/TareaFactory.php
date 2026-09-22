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
        $titulos = [
            'Avance proyecto final de base de datos',
            'Primer avance de desarrollo web',
            'Primer avance proyecto de programación',
            'Avances generales',
            'Diseño de interfaz de usuario',
            'Configuración del servidor',
            'Pruebas de integración',
            'Documentación de la API',
            'Revisión de código',
            'Despliegue a producción',
            'Optimización de consultas SQL',
            'Implementación de autenticación',
            'Diseño de base de datos',
            'Desarrollo del módulo de reportes',
            'Corrección de bugs reportados',
        ];

        return [
            'titulo' => fake()->unique()->randomElement($titulos),
            'descripcion' => fake()->sentence(10),
            'estado' => fake()->randomElement(['pendiente', 'en_progreso', 'completada']),
            'categoria_id' => Categoria::factory(),
            'usuario_id' => User::factory(),
        ];
    }
}
