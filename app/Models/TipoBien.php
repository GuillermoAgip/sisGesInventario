<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TipoBien extends Model
{
    protected $table = 'tipo_bien';
    protected $primaryKey = 'id_tipo_bien';
    public $timestamps = false;

    // Opción A (recomendado): explícito, seguro
    protected $fillable = [
        'nombre_tipo',
    ];

    // Si en el futuro agregas columnas tipo boolean/fecha/json, aquí van casts.
    // protected function casts(): array
    // {
    //     return [];
    // }

    /**
     * Accessor/Mutator moderno:
     * - Al guardar: trim + colapsa espacios + Capitaliza
     * - Al leer: devuelve como está en BD (puedes formatear si quieres)
     */
    protected function nombreTipo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (string) $value, // aquí podrías formatear si lo necesitas
            set: function ($value) {
                $value = trim((string) $value);
                $value = preg_replace('/\s+/', ' ', $value);
                return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
            }
        );
    }

    /**
     * Scope para búsquedas limpias en listados.
     */
    public function scopeSearch($query, ?string $term)
    {
        $term = trim((string) $term);
        if ($term === '') return $query;

        return $query->where('nombre_tipo', 'ilike', "%{$term}%"); // PostgreSQL
        // Si usas MySQL cambia a: ->where('nombre_tipo', 'like', "%{$term}%");
    }
}
