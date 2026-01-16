@extends('layouts.admin')

@section('title', 'Panel')

@php
  // =========================
  // MOCK DATA (temporal)
  // Luego esto viene de BD:
  // bien, movimiento, usuario, ubicacion, responsable, historial... [file:550]
  // =========================
  $kpis = [
    'bienes' => 150,
    'movimientos_mes' => 23,
    'ubicaciones' => 12,
    'usuarios_activos' => 4,
  ];

  $movimientos_recientes = [
    ['fecha' => '2025-12-18', 'tipo' => 'Alta', 'bien' => 'Laptop Dell', 'ubicacion' => 'Sede Central - 2do piso', 'usuario' => 'Invitado'],
    ['fecha' => '2025-12-17', 'tipo' => 'Traslado', 'bien' => 'Impresora HP', 'ubicacion' => 'Sede Central - 1er piso', 'usuario' => 'Invitado'],
    ['fecha' => '2025-12-16', 'tipo' => 'Baja', 'bien' => 'Silla ergonómica', 'ubicacion' => 'Almacén', 'usuario' => 'Invitado'],
  ];

  $bienes_recientes = [
    ['codigo' => 'P-000123', 'denominacion' => 'Laptop Dell', 'tipo' => 'Cómputo', 'fecha' => '2025-12-18'],
    ['codigo' => 'P-000124', 'denominacion' => 'Impresora HP', 'tipo' => 'Oficina', 'fecha' => '2025-12-17'],
    ['codigo' => 'P-000125', 'denominacion' => 'Proyector', 'tipo' => 'Audiovisual', 'fecha' => '2025-12-15'],
  ];

  $alertas = [
    ['nivel' => 'warning', 'texto' => 'Hay bienes sin foto registrada.'],
    ['nivel' => 'info', 'texto' => 'Falta configurar los Catálogos: tipo de movimiento y estado del bien.'],
  ];
@endphp

@section('content')
  <!-- Header -->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Panel</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="app-content">
    <div class="container-fluid">

      <!-- KPIs -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-primary">
            <div class="inner">
              <h3>{{ $kpis['bienes'] }}</h3>
              <p>Bienes registrados</p>
            </div>
            <i class="small-box-icon bi bi-box-seam"></i>
            <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Ver bienes <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-success">
            <div class="inner">
              <h3>{{ $kpis['movimientos_mes'] }}</h3>
              <p>Movimientos (mes)</p>
            </div>
            <i class="small-box-icon bi bi-arrow-left-right"></i>
            <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Ver movimientos <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-warning">
            <div class="inner">
              <h3>{{ $kpis['ubicaciones'] }}</h3>
              <p>Ubicaciones</p>
            </div>
            <i class="small-box-icon bi bi-geo-alt"></i>
            <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
              Ver ubicaciones <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box text-bg-danger">
            <div class="inner">
              <h3>{{ $kpis['usuarios_activos'] }}</h3>
              <p>Usuarios activos</p>
            </div>
            <i class="small-box-icon bi bi-people"></i>
            <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
              Ver usuarios <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Alerts + Tables -->
      <div class="row">

        <!-- Alertas del sistema -->
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Alertas</h3>
            </div>
            <div class="card-body">
              @forelse($alertas as $a)
                <div class="alert alert-{{ $a['nivel'] }} mb-2">{{ $a['texto'] }}</div>
              @empty
                <div class="text-secondary">Sin alertas.</div>
              @endforelse
            </div>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Acciones rápidas</h3>
            </div>
            <div class="card-body d-grid gap-2">
              <a href="#" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Registrar bien</a>
              <a href="#" class="btn btn-success"><i class="bi bi-arrow-left-right me-1"></i> Registrar movimiento</a>
              <a href="#" class="btn btn-outline-secondary"><i class="bi bi-upload me-1"></i> Importar (próximamente)</a>
            </div>
          </div>
        </div>

        <!-- Movimientos recientes -->
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Movimientos recientes</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-sm btn-outline-secondary">Ver todo</a>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm align-middle">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Tipo</th>
                      <th>Bien</th>
                      <th>Ubicación</th>
                      <th>Usuario</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($movimientos_recientes as $m)
                      <tr>
                        <td>{{ $m['fecha'] }}</td>
                        <td>{{ $m['tipo'] }}</td>
                        <td>{{ $m['bien'] }}</td>
                        <td>{{ $m['ubicacion'] }}</td>
                        <td>{{ $m['usuario'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Bienes recientes -->
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Últimos bienes registrados</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-sm btn-outline-secondary">Ver todo</a>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm align-middle">
                  <thead>
                    <tr>
                      <th>Código patrimonial</th>
                      <th>Denominación</th>
                      <th>Tipo</th>
                      <th>Fecha registro</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($bienes_recientes as $b)
                      <tr>
                        <td>{{ $b['codigo'] }}</td>
                        <td>{{ $b['denominacion'] }}</td>
                        <td>{{ $b['tipo'] }}</td>
                        <td>{{ $b['fecha'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
@endsection
