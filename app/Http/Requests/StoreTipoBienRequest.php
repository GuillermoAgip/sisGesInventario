<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTipoBienRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Ideal: Policy/Gate, ej: return $this->user()->can('create', TipoBien::class);
        return true;
    }

    protected function prepareForValidation(): void
    {
        $nombre = (string) $this->input('nombre_tipo', '');
        $nombre = trim($nombre);
        $nombre = preg_replace('/\s+/', ' ', $nombre);

        $this->merge([
            'nombre_tipo' => $nombre,
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre_tipo' => [
                'required',
                'string',
                'max:50',
                // Evita duplicados (recomendado en catálogos)
                Rule::unique('tipo_bien', 'nombre_tipo'),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre_tipo' => 'tipo de bien',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_tipo.unique' => 'Ese tipo de bien ya está registrado.',
        ];
    }
}
