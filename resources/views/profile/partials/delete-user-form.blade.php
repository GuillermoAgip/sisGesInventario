<div class="card border border-danger">
  <div class="card-header text-bg-danger">
    <h3 class="card-title mb-0">Eliminar cuenta</h3>
  </div>

  <div class="card-body">
    <p class="text-muted">
      Una vez que elimines tu cuenta, todos tus datos se eliminarán permanentemente.
      Antes de eliminarla, descarga cualquier información que quieras conservar.
    </p>

    <button type="button" class="btn btn-danger"
            data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
      Eliminar cuenta
    </button>
  </div>
</div>

{{-- MODAL Confirmación --}}
<div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')

        <div class="modal-header">
          <h5 class="modal-title">Confirmar eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body">
          <p class="mb-2">
            ¿Seguro que deseas eliminar tu cuenta?
          </p>
          <p class="text-muted mb-3">
            Esta acción no se puede deshacer. Ingresa tu contraseña para confirmar.
          </p>

          <label for="delete_password" class="form-label">Contraseña</label>
          <input
            id="delete_password"
            name="password"
            type="password"
            class="form-control @error('password', 'userDeletion') is-invalid @enderror"
            placeholder="Contraseña"
            autocomplete="current-password"
          >
          @error('password', 'userDeletion')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="submit" class="btn btn-danger">
            Eliminar cuenta
          </button>
        </div>

      </form>

    </div>
  </div>
</div>

{{-- Si hay errores de validación en userDeletion, abre el modal automáticamente --}}
@if ($errors->userDeletion->isNotEmpty())
  @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('confirmUserDeletionModal');
        if (modalEl && window.bootstrap) {
          const modal = new bootstrap.Modal(modalEl);
          modal.show();
        }
      });
    </script>
  @endpush
@endif
