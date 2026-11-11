<?php

namespace App\Http\Requests;

use App\Models\Categoria;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Categoria::class);
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categoria', 'name')->where(
                    fn ($query) => $query->where('user_id', $userId)->whereNull('deleted_at')
                ),
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
