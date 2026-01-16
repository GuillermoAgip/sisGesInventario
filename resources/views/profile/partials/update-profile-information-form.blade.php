<div class="card">
  <div class="card-header">
    <h3 class="card-title mb-0">Información del perfil</h3>
  </div>

  <div class="card-body">
    <p class="text-muted mb-3">
      Actualiza la información de tu perfil y tu correo.
    </p>

    {{-- Reenviar verificación --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
      @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      @method('PATCH')

      <div class="row g-3">
        <div class="col-12">
          <label for="name" class="form-label">Nombre</label>
          <input
            id="name"
            name="name"
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $user->name) }}"
            required
            autofocus
            autocomplete="name"
          >
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-12">
  <label for="dni_usuario" class="form-label">DNI</label>
  <input
    id="dni_usuario"
    name="dni_usuario"
    type="text"
    maxlength="8"
    class="form-control @error('dni_usuario') is-invalid @enderror"
    value="{{ old('dni_usuario', $user->dni_usuario) }}"
    required
    autocomplete="off"
  >
  @error('dni_usuario')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

        <div class="col-12">
          <label for="email" class="form-label">Email</label>
          <input
            id="email"
            name="email"
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $user->email) }}"
            required
            autocomplete="username"
          >
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror

          @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-3">
              <div class="alert alert-warning mb-2">
                Tu correo aún no está verificado.
              </div>

              <button type="submit"
                      form="send-verification"
                      class="btn btn-outline-secondary btn-sm">
                Reenviar correo de verificación
              </button>

              @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success mt-2 mb-0">
                  Se envió un nuevo enlace de verificación a tu correo.
                </div>
              @endif
            </div>
          @endif
        </div>

        <div class="col-12 d-flex gap-2 align-items-center">
          <button type="submit" class="btn btn-primary">
            Guardar
          </button>

          @if (session('status') === 'profile-updated')
            <span class="text-success">Guardado.</span>
          @endif
        </div>
      </div>
    </form>
  </div>
</div>
