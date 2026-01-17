<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'Admin')</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Accessibility Features-->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('AdminLTE-4.0.0-rc4/dist/css/adminlte.css') }}" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media='all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('AdminLTE-4.0.0-rc4/dist/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" crossorigin="anonymous" />

    <!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" crossorigin="anonymous" />

    <!-- Smooth mini sidebar (transform-based) + FIXES -->
    <style>
      :root{
        --sb-mini: 4.6rem;
        --sb-full: 250px;
        --dur: 420ms;
        --ease: cubic-bezier(.22, 1, .36, 1);
      }

      /* 1) Sidebar encima, para que no se “pierda” */
      .app-sidebar{
        overflow: visible;
        position: relative;
        z-index: auto;
      }

      /* 2) Panel real que se mueve */
      .app-sidebar .sidebar-inner{
        width: var(--sb-full);
        transform: translateX(0);
        transition: transform var(--dur) var(--ease);
        will-change: transform;
        position: relative;
        z-index: 1;
        pointer-events: auto;
      }

      /* 3) Estado mini: aside angosto */
      body.sidebar-mini.sidebar-collapse .app-sidebar{
        width: var(--sb-mini) !important;
        pointer-events: auto;
      }

      /* 4) En mini: metemos el panel dejando visible solo sb-mini */
      body.sidebar-mini.sidebar-collapse .app-sidebar .sidebar-inner{
        transform: translateX(calc(var(--sb-mini) - var(--sb-full)));
      }

      /* 5) Hover: sale suave */
      body.sidebar-mini.sidebar-collapse .app-sidebar:hover .sidebar-inner{
        transform: translateX(0);
        transition-delay: 60ms;
      }
      body.sidebar-mini.sidebar-collapse .app-sidebar:not(:hover) .sidebar-inner{
        transition-delay: 0ms;
      }

      /* =========================
         TEXTO: click/mini/hover
         ========================= */

      /* Normal: textos visibles */
      .app-sidebar .nav-link p,
      .app-sidebar .brand-text{
        opacity: 1;
        transition: opacity 160ms ease;
      }

      /* Mini (cuando haces click): ocultar textos, dejar iconos */
      body.sidebar-mini.sidebar-collapse .app-sidebar .nav-link p,
      body.sidebar-mini.sidebar-collapse .app-sidebar .brand-text{
        opacity: 0 !important;
        width: 0;
        overflow: hidden;
        white-space: nowrap;
      }

      /* Hover en mini: que reaparezcan textos */
      body.sidebar-mini.sidebar-collapse .app-sidebar:hover .nav-link p,
      body.sidebar-mini.sidebar-collapse .app-sidebar:hover .brand-text{
        opacity: 1 !important;
        width: auto;
      }

      /* =========================
         BRAND: logo + nombre alineados
         ========================= */

      .app-sidebar .sidebar-brand .brand-link{
        display: flex;
        align-items: center;
        gap: .6rem;
        padding: .75rem 1rem;
      }

      .app-sidebar .sidebar-brand .brand-image{
        width: 32px;
        height: 32px;
        object-fit: contain;
        border-radius: 8px;
        opacity: 1 !important; /* evita que se vea “lavado” */
      }

      .app-sidebar .sidebar-brand .brand-text{
        line-height: 1;
        font-weight: 600;
      }
      /* Línea y aire */
.app-sidebar{ border-right: 1px solid rgba(255,255,255,.08); }
.app-sidebar .sidebar-brand{ border-bottom: 1px solid rgba(255,255,255,.10); }

/* Menú: pill + hover */
.app-sidebar .nav.sidebar-menu > .nav-item > .nav-link{
  border-radius: .7rem;
  margin: .15rem .5rem;
  padding: .55rem .75rem;
  color: rgba(255,255,255,.80);
}
.app-sidebar .nav.sidebar-menu > .nav-item > .nav-link:hover{
  background: rgba(255,255,255,.06);
  color: rgba(255,255,255,.95);
}
.app-sidebar .nav-link.active{
  background: rgba(13,110,253,.20);
  border: 1px solid rgba(13,110,253,.35);
  color: #fff !important;
}

/* Submenú más fino */
.app-sidebar .nav-treeview .nav-link{
  border-radius: .6rem;
  margin: .10rem .5rem;
  padding: .45rem .75rem;
  color: rgba(255,255,255,.70);
}
.app-sidebar .nav-treeview .nav-link:hover{
  background: rgba(255,255,255,.05);
  color: rgba(255,255,255,.92);
}

/* Search (si usas form-control-sidebar / btn-sidebar) */
.form-control-sidebar, .btn-sidebar{
  background: rgba(255,255,255,.08) !important;
  border: 1px solid rgba(255,255,255,.12) !important;
  color: rgba(255,255,255,.9) !important;
}
.form-control-sidebar::placeholder{ color: rgba(255,255,255,.55) !important; }
/* Active más limpio (sin borde raro) */
.app-sidebar .nav-link.active{
  border: 0 !important;
  background: rgba(13,110,253,.22) !important;
  box-shadow: inset 0 0 0 1px rgba(13,110,253,.35);
}

/* En submenú, active un poco más suave */
.app-sidebar .nav-treeview .nav-link.active{
  background: rgba(255,255,255,.08) !important;
  box-shadow: none;
}

    </style>
  </head>
  <!--end::Head-->

  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link js-sidebar-toggle" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>

            <li class="nav-item d-none d-md-block">
              <a href="{{ route('admin.dashboard') }}" class="nav-link">Inicio</a>
            </li>

          </ul>

          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>

            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img src="{{ asset('uploads/avatars/UserIcon.png') }}"
                  class="user-image rounded-circle shadow"
                  alt="User Image" />

                  @auth
                  <span class="d-none d-md-inline">
                    {{ auth()->user()->name }}
                    <small class="text-muted">({{ auth()->user()->rol_usuario ?? 'Sin rol' }})</small>
                  </span>
                  @endauth
                  @guest
                    <span class="d-none d-md-inline">Invitado</span>
                  @endguest
              </a>


              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <li class="user-header text-bg-primary">
                  <img src="{{ asset('uploads/avatars/UserIcon.png') }}"
                      class="user-image rounded-circle shadow"
                      alt="User Image" />

                    @auth
                      <p>
                      {{ auth()->user()->name }}
                      <small>{{ auth()->user()->rol_usuario ?? 'Sin rol' }}</small>
                      </p>
                    @endauth

                    @guest
                      <p>
                      Invitado
                      <small>Sin sesión iniciada</small>
                      </p>
                    @endguest
                </li>

                <li class="user-footer">
                 <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Perfil</a>
                  <a href="#" class="btn btn-default btn-flat float-end" data-bs-toggle="modal" data-bs-target="#logoutModal">Salir</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!--end::Header-->

      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <div class="sidebar-inner">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand px-3">
  <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex align-items-center gap-2 py-3">
    <img src="{{ asset('uploads/logo/logoGesI.png') }}" class="brand-image shadow" alt="Logo">
    <span class="brand-text">GesInventario</span>
  </a>
</div>

    <!--end::Sidebar Brand-->

    {{-- USER PANEL --}}
    <div class="px-3 mt-2">
      <div class="d-flex align-items-center gap-2 py-2">
        <img
          src="{{ asset('uploads/avatars/UserIcon.png') }}"
          class="rounded-circle shadow"
          alt="User"
          style="width:34px;height:34px;object-fit:cover;"
        />

        <div class="lh-1">
          <div class="fw-semibold text-white" style="font-size:.95rem;">
            @auth {{ auth()->user()->name }} @endauth
            @guest Invitado @endguest
          </div>
          <small class="text-secondary">
            @auth {{ auth()->user()->rol_usuario ?? 'Sin rol' }} @endauth
            @guest Sin sesión @endguest
          </small>
        </div>
      </div>
    </div>

    {{-- SIDEBAR SEARCH (estilo AdminLTE) --}}
    <div class="px-3 mt-2">
  <div class="form-inline">
    <div class="input-group input-group-sm" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Buscar menú..." aria-label="Buscar menú">
      <button class="btn btn-sidebar" type="button"><i class="bi bi-search"></i></button>
    </div>
  </div>
</div>


    @php
      // Abrir padres automáticamente según ruta actual
      $openInventario = request()->routeIs('admin.bienes.*', 'admin.movimientos.*', 'admin.documentos.*');
      $openOrganizacion = request()->routeIs('admin.areas.*', 'admin.ubicaciones.*', 'admin.responsables.*');
      $openCatalogos = request()->routeIs('admin.tipo-bien.*', 'admin.tipo-movimiento.*', 'admin.estado-bien.*');
      $openSeguridad = request()->routeIs('admin.usuarios.*', 'admin.historial.*');
    @endphp

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <ul
  class="nav sidebar-menu flex-column"
  data-lte-toggle="treeview"
  role="navigation"
  aria-label="Main navigation"
  data-accordion="false"
  id="sidebarMenu"
>

          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon bi bi-speedometer"></i>
              <p>Panel</p>
            </a>
          </li>

          {{-- INVENTARIO --}}
          <li class="nav-item {{ $openInventario ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $openInventario ? 'active' : '' }}">
              <i class="nav-icon bi bi-box-seam"></i>
              <p>Inventario <i class="nav-arrow bi bi-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#"
                   class="nav-link {{ request()->routeIs('admin.bienes.*') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Bienes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#"
                   class="nav-link {{ request()->routeIs('admin.movimientos.*') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>
                    Movimientos
                    {{-- badge ejemplo --}}
                    <span class="nav-badge badge text-bg-warning me-3">!</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#"
                   class="nav-link {{ request()->routeIs('admin.documentos.*') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Documentos</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- ORGANIZACIÓN --}}
          <li class="nav-item {{ $openOrganizacion ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $openOrganizacion ? 'active' : '' }}">
              <i class="nav-icon bi bi-diagram-3"></i>
              <p>Organización <i class="nav-arrow bi bi-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Áreas</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Ubicaciones</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Responsables</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Responsable por Área</p></a></li>
            </ul>
          </li>

          {{-- CATÁLOGOS --}}
          <li class="nav-item {{ $openCatalogos ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $openCatalogos ? 'active' : '' }}">
              <i class="nav-icon bi bi-gear"></i>
              <p>Catálogos <i class="nav-arrow bi bi-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.tipo-bien.index') }}"
                   class="nav-link {{ request()->routeIs('admin.tipo-bien.*') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-tag"></i>
                  <p>Tipo de Bien</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Tipo de Movimiento</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Estado del Bien</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- SEGURIDAD --}}
          <li class="nav-item {{ $openSeguridad ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $openSeguridad ? 'active' : '' }}">
              <i class="nav-icon bi bi-shield-lock"></i>
              <p>Seguridad <i class="nav-arrow bi bi-chevron-right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Usuarios</p></a></li>
              <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon bi bi-circle"></i><p>Historial</p></a></li>
            </ul>
          </li>

          {{-- APARIENCIA --}}
          <li class="nav-item">
            <a href="{{ route('admin.theme-generate') }}"
               class="nav-link {{ request()->routeIs('admin.theme-generate') ? 'active' : '' }}">
              <i class="nav-icon bi bi-palette"></i>
              <p>Tema</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </div>
</aside>

      <!--end::Sidebar-->

      <!--begin::App Main-->
      <main class="app-main">
        @yield('content')
      </main>
      <!--end::App Main-->

      <!--begin::Footer-->
      <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">
          Versión 1.0.0
        </div>
        <strong>
          © {{ date('Y') }} GesInventario
        </strong>
          <span class="text-muted">— Todos los derechos reservados.</span>
      </footer>

      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <!--begin::Script-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('AdminLTE-4.0.0-rc4/dist/js/adminlte.js') }}"></script>

    <!-- OverlayScrollbars Configure -->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = { scrollbarTheme: 'os-theme-light', scrollbarAutoHide: 'leave', scrollbarClickScroll: true };

      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: { theme: Default.scrollbarTheme, autoHide: Default.scrollbarAutoHide, clickScroll: Default.scrollbarClickScroll },
          });
        }
      });
    </script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>
    <script>
      const el = document.querySelector('.connectedSortable');
      if (el) {
        new Sortable(el, { group: 'shared', handle: '.card-header' });
        document.querySelectorAll('.connectedSortable .card-header').forEach((h) => (h.style.cursor = 'move'));
      }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" crossorigin="anonymous"></script>

    <!-- Logout demo -->
    <script>
      document.getElementById('btnConfirmLogout')?.addEventListener('click', function (e) {
        e.preventDefault();
        window.location.href = "{{ route('admin.dashboard') }}";
      });
    </script>

    <!-- Sidebar mini toggle (click = mini, hover = expand) -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const body = document.body;
        const btn = document.querySelector('.js-sidebar-toggle');

        // Si quieres que inicie colapsado en mini, descomenta:
        // body.classList.add('sidebar-collapse');

        btn?.addEventListener('click', (e) => {
          e.preventDefault();
          body.classList.toggle('sidebar-collapse');
        });
      });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', () => {
  const input = document.querySelector('.form-control-sidebar');
  const menu  = document.getElementById('sidebarMenu');

  if (!input || !menu) return;

  // Solo enlaces (items reales)
  const links = Array.from(menu.querySelectorAll('a.nav-link'));

  // Quita highlights viejos
  const clearState = () => {
    links.forEach(a => {
      a.closest('li.nav-item')?.classList.remove('menu-open');
      a.closest('li.nav-item')?.style.removeProperty('display');
    });
    // Mostrar todos los li
    Array.from(menu.querySelectorAll('li.nav-item')).forEach(li => li.style.display = '');
  };

  const openParents = (a) => {
    let ul = a.closest('ul');
    while (ul && ul !== menu) {
      const parentLi = ul.closest('li.nav-item');
      if (parentLi) parentLi.classList.add('menu-open');
      ul = parentLi ? parentLi.closest('ul') : null;
    }
  };

  const apply = () => {
    const term = (input.value || '').trim().toLowerCase();

    if (!term) {
      clearState();
      return;
    }

    // Ocultar todo primero
    Array.from(menu.querySelectorAll('li.nav-item')).forEach(li => li.style.display = 'none');

    // Mostrar coincidencias + sus padres
    links.forEach(a => {
      const text = (a.textContent || '').trim().toLowerCase();
      if (!text.includes(term)) return;

      const li = a.closest('li.nav-item');
      if (li) li.style.display = '';

      // Mostrar todos los padres (li) y abrirlos
      let parent = li?.parentElement;
      while (parent && parent !== menu) {
        const parentLi = parent.closest('li.nav-item');
        if (parentLi) parentLi.style.display = '';
        parent = parentLi ? parentLi.parentElement : null;
      }

      openParents(a);
    });
  };

  input.addEventListener('input', apply);
});
</script>



    @stack('scripts')
    <!--end::Script-->

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmar salida</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">¿Deseas salir del sistema?</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Salir</button>
                    </form>
            </div>
        </div>
      </div>
    </div>
    <!--end::Logout Modal-->
  </body>
  <!--end::Body-->
</html>
