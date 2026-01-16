@extends('layouts.admin')

@section('title', 'Crear Tipo de Bien')

@section('content')
<div class="container-fluid">

  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
    <div>
      <h1 class="h3 mb-0">Crear Tipo de Bien</h1>
      <div class="text-secondary small">
        Completa el formulario para registrar un nuevo tipo.
      </div>
    </div>

    <a href="{{ route('admin.tipo-bien.index') }}" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
  </div>

  <div class="card">
    <div class="card-header">
      <span class="fw-semibold">Datos del tipo de bien</span>
    </div>

    <form method="POST" action="{{ route('admin.tipo-bien.store') }}" novalidate>
      @csrf {{-- protección CSRF obligatoria en POST --}} {{-- [web:301] --}}

      <div class="card-body">

        <div class="mb-3">
          <label for="nombre_tipo" class="form-label">Nombre <span class="text-danger">*</span></label>

          <input
            type="text"
            class="form-control @error('nombre_tipo') is-invalid @enderror"
            id="nombre_tipo"
            name="nombre_tipo"
            value="{{ old('nombre_tipo') }}"
            placeholder="Ej: Mueble, Equipo, Instrumento…"
            maxlength="50"
            required
            autofocus
          >

          @error('nombre_tipo')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror

          <div class="form-text">
            Máximo 50 caracteres.
          </div>
        </div>

      </div>

      <div class="card-footer d-flex justify-content-end gap-2">
        <a href="{{ route('admin.tipo-bien.index') }}" class="btn btn-outline-secondary">
          Cancelar
        </a>

        <button type="submit" class="btn btn-primary">
          <i class="bi bi-check2-circle me-1"></i> Guardar
        </button>
      </div>
    </form>
  </div>

</div>
@endsection
