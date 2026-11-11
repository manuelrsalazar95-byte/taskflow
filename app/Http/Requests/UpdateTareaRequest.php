<?php

namespace App\Http\Requests;

use App\Models\Tarea;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTareaRequest extends FormRequest
{
    public function authorize(): bool
    {
        $tarea = $this->route('tarea');

        return $tarea instanceof Tarea && $this->user()->can('update', $tarea);
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'categoria_id' => [
                'required',
                Rule::exists('categoria', 'id')->where(
                    fn ($query) => $query->where('user_id', $userId)->whereNull('deleted_at')
                ),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'titulo' => 'título',
            'descripcion' => 'descripción',
            'categoria_id' => 'categoría',
        ];
    }
}
