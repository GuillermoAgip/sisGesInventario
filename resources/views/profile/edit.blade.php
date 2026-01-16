@extends('layouts.admin')

@section('title', 'Perfil')

@section('content')
  {{-- Header (estilo AdminLTE 4) --}}
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Perfil</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Perfil</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  {{-- Contenido --}}
  <div class="app-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-8">

          {{-- Perfil: datos --}}
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title mb-0">Información del perfil</h3>
            </div>
            <div class="card-body">
              @include('profile.partials.update-profile-information-form')
            </div>
          </div>

          {{-- Perfil: contraseña --}}
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title mb-0">Cambiar contraseña</h3>
            </div>
            <div class="card-body">
              @include('profile.partials.update-password-form')
            </div>
          </div>

          {{-- Perfil: eliminar cuenta --}}
          <div class="card mb-4 border border-danger">
            <div class="card-header text-bg-danger">
              <h3 class="card-title mb-0">Eliminar cuenta</h3>
            </div>
            <div class="card-body">
              @include('profile.partials.delete-user-form')
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
