<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTipoBienRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Ideal: Policy, ej: return $this->user()->can('update', $this->route('tipo_bien'));
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
        // Obtiene el ID desde la ruta (Route Model Binding)
        $id = $this->route('tipo_bien')?->id_tipo_bien;

        return [
            'nombre_tipo' => [
                'required',
                'string',
                'max:50',
                // Unique pero ignorando el registro actual
                Rule::unique('tipo_bien', 'nombre_tipo')->ignore($id, 'id_tipo_bien'),
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
