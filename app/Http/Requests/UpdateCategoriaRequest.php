<?php

namespace App\Http\Requests;

use App\Models\Categoria;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        $categoria = $this->route('categoria');

        return $categoria instanceof Categoria && $this->user()->can('update', $categoria);
    }

    public function rules(): array
    {
        $userId = $this->user()->id;
        $categoria = $this->route('categoria');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categoria', 'name')
                    ->where(fn ($query) => $query->where('user_id', $userId)->whereNull('deleted_at'))
                    ->ignore($categoria?->id),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Ya existe una categoría con ese nombre.',
        ];
    }
}
