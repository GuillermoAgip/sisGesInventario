<div class="card">
  <div class="card-header">
    <h3 class="card-title mb-0">Cambiar contraseña</h3>
  </div>

  <div class="card-body">
    <p class="text-muted mb-3">
      Usa una contraseña larga y aleatoria para mantener tu cuenta segura.
    </p>

    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      @method('PUT')

      <div class="row g-3">
        <div class="col-12">
          <label for="update_password_current_password" class="form-label">Contraseña actual</label>
          <input
            id="update_password_current_password"
            name="current_password"
            type="password"
            class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
            autocomplete="current-password"
          >
          @error('current_password', 'updatePassword')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12">
          <label for="update_password_password" class="form-label">Nueva contraseña</label>
          <input
            id="update_password_password"
            name="password"
            type="password"
            class="form-control @error('password', 'updatePassword') is-invalid @enderror"
            autocomplete="new-password"
          >
          @error('password', 'updatePassword')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12">
          <label for="update_password_password_confirmation" class="form-label">Confirmar contraseña</label>
          <input
            id="update_password_password_confirmation"
            name="password_confirmation"
            type="password"
            class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
            autocomplete="new-password"
          >
          @error('password_confirmation', 'updatePassword')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-12 d-flex gap-2 align-items-center">
          <button type="submit" class="btn btn-primary">
            Guardar
          </button>

          @if (session('status') === 'password-updated')
            <span class="text-success">Guardado.</span>
          @endif
        </div>
      </div>
    </form>
  </div>
</div>
