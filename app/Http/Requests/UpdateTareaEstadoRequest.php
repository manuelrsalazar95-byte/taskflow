<?php

namespace App\Http\Requests;

use App\Models\Tarea;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTareaEstadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        $tarea = $this->route('tarea');

        return $tarea instanceof Tarea && $this->user()->can('update', $tarea);
    }

    public function rules(): array
    {
        return [
            'estado' => [
                'required',
                Rule::in(['pendiente', 'en_progreso', 'completada']),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'estado' => 'estado',
        ];
    }
}
