<?php

namespace App\Http\Requests;

use App\Models\Tarea;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTareaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Tarea::class);
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
