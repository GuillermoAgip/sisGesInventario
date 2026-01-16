@extends('layouts.admin')

@section('title', 'Tipos de bien')

@section('content')
<div class="container-fluid">

  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
    <div>
      <h1 class="h3 mb-0">Tipos de bien</h1>
      <div class="text-secondary small">Gestión de catálogo</div>
    </div>

    {{-- Acciones (como la imagen): Nuevo + Eliminar al costado --}}
    <div class="d-flex align-items-center gap-2">
      <a href="{{ route('admin.tipo-bien.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Nuevo
      </a>

      <button type="button" class="btn btn-danger" id="btnBulkDelete" disabled>
        <i class="bi bi-trash me-1"></i> Eliminar
      </button>
    </div>
  </div>

  @if (session('ok'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('ok') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  @endif

  <div class="card">

    <div class="card-header py-2">
      {{-- Toolbar 1: Mostrar + Search --}}
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <form method="GET" action="{{ route('admin.tipo-bien.index') }}" class="d-flex align-items-center gap-2">
          <span class="text-secondary small">Mostrar</span>

          <select name="per_page" class="form-select form-select-sm" style="width:auto" onchange="this.form.submit()">
            @foreach([5,10,25,50,100] as $n)
              <option value="{{ $n }}" @selected((int)request('per_page', 10) === $n)>{{ $n }}</option>
            @endforeach
          </select>

          <span class="text-secondary small">registros</span>
        </form>

        <div class="input-group input-group-sm" style="width: 280px;">
          <span class="input-group-text"><i class="bi bi-search"></i></span>
          <input
            type="search"
            class="form-control"
            id="q"
            placeholder="Buscar…"
            autocomplete="off"
          />
        </div>
      </div>

      <hr class="my-2">

      {{-- Toolbar 2: contador + seleccionados (sin botones) --}}
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2 flex-wrap">
          <span class="badge text-bg-secondary">{{ $items->total() }}</span>
          <span class="text-secondary small">registros</span>

          <span class="text-secondary small">|</span>

          <span class="text-secondary small">
            Seleccionados: <span class="fw-semibold" id="selectedCount">0</span>
          </span>
        </div>
      </div>
    </div>

    <div class="card-body p-0">
      <form id="bulkForm" method="POST" action="{{ route('admin.tipo-bien.bulk-destroy') }}">
        @csrf
        @method('DELETE')

        <div class="table-responsive">
          <table class="table table-sm table-striped table-hover align-middle mb-0" id="tbTipos">
            <thead class="table-light">
              <tr>
                <th style="width: 44px;" class="text-center">
                  <input class="form-check-input" type="checkbox" id="checkAll">
                </th>
                <th>Nombre</th>
              </tr>
            </thead>

            <tbody>
              @forelse($items as $item)
                <tr class="row-dblclick"
                    data-id="{{ $item->id_tipo_bien }}"
                    data-nombre="{{ $item->nombre_tipo }}"
                    data-action="{{ route('admin.tipo-bien.update', $item) }}"
                    data-name="{{ $item->nombre_tipo }}">
                  <td class="text-center">
                    <input
                      class="form-check-input row-check"
                      type="checkbox"
                      name="ids[]"
                      value="{{ $item->id_tipo_bien }}"
                      onclick="event.stopPropagation()"
                      ondblclick="event.stopPropagation()"
                    >
                  </td>
                  <td>
                    <span class="fw-semibold">{{ $item->nombre_tipo }}</span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="text-center py-4 text-secondary">
                    No hay registros.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </form>
    </div>

    <div class="card-footer py-2">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="text-secondary small" id="tableInfo">
          Mostrando {{ $items->firstItem() ?? 0 }}–{{ $items->lastItem() ?? 0 }} de {{ $items->total() }}
        </div>

        <div class="ms-auto">
          {{ $items->onEachSide(1)->links() }}
        </div>
      </div>
    </div>

  </div>
</div>

{{-- MODAL EDIT (una sola vez) --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <form method="POST" id="editForm">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title">Editar Tipo de Bien</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="edit_id" name="id_tipo_bien">

          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre_tipo" id="edit_nombre" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <span id="deleteConfirmText">¿Deseas eliminar los registros seleccionados?</span>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnDeleteConfirmOk">Eliminar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const q = document.getElementById('q');
    const checkAll = document.getElementById('checkAll');
    const btnBulkDelete = document.getElementById('btnBulkDelete');
    const bulkForm = document.getElementById('bulkForm');
    const selectedCountEl = document.getElementById('selectedCount');
    const tableInfo = document.getElementById('tableInfo');

    const defaultInfo = @json(
      'Mostrando ' . ($items->firstItem() ?? 0) . '–' . ($items->lastItem() ?? 0) . ' de ' . $items->total()
    );

    const rows = () => Array.from(document.querySelectorAll('#tbTipos tbody tr.row-dblclick'));
    const checks = () => Array.from(document.querySelectorAll('.row-check'));

    const refreshSelection = () => {
      const selected = checks().filter(c => c.checked).length;
      selectedCountEl.textContent = selected;
      btnBulkDelete.disabled = selected === 0;

      const all = checks().length > 0 && checks().every(c => c.checked);
      checkAll.checked = all;
      checkAll.indeterminate = selected > 0 && !all;
    };

    const applyFilter = () => {
      const term = (q.value || '').trim().toLowerCase();
      let visible = 0;

      rows().forEach(tr => {
        const name = (tr.dataset.name || '').toLowerCase();
        const show = term === '' || name.includes(term);
        tr.style.display = show ? '' : 'none';
        if (show) visible++;
      });

      if (tableInfo) {
        tableInfo.textContent = term === ''
          ? defaultInfo
          : `Mostrando ${visible} resultado(s) (filtro aplicado)`;
      }

      refreshSelection();
    };

    let t = null;
    q?.addEventListener('input', () => {
      clearTimeout(t);
      t = setTimeout(applyFilter, 120);
    });

    checkAll?.addEventListener('change', () => {
      checks().forEach(c => c.checked = checkAll.checked);
      refreshSelection();
    });

    document.addEventListener('change', (e) => {
      if (e.target.classList?.contains('row-check')) refreshSelection();
    });

    // ====== EDIT MODAL (DOBLE CLICK SIN FETCH) ======
    const modalEl = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const modal = modalEl ? bootstrap.Modal.getOrCreateInstance(modalEl) : null;

    rows().forEach((tr) => {
      tr.style.cursor = 'pointer';
      tr.addEventListener('dblclick', (ev) => {
        if (ev.target.closest('input,button,a,select,textarea,label')) return;
        if (!modal) return;
        modal.show(tr);
      });
    });

    modalEl?.addEventListener('show.bs.modal', (event) => {
      const tr = event.relatedTarget;
      if (!tr) return;

      document.getElementById('edit_id').value = tr.dataset.id || '';
      document.getElementById('edit_nombre').value = tr.dataset.nombre || '';
      editForm.action = tr.dataset.action || '#';
    });

    modalEl?.addEventListener('hidden.bs.modal', () => {
      editForm.reset();
    });

    btnBulkDelete?.addEventListener('click', () => {
      const selected = checks().filter(c => c.checked).length;
      if (!selected) return;

      const modalElDel = document.getElementById('deleteConfirmModal');
const modalDel = modalElDel ? bootstrap.Modal.getOrCreateInstance(modalElDel) : null;
const deleteConfirmText = document.getElementById('deleteConfirmText');
const btnDeleteConfirmOk = document.getElementById('btnDeleteConfirmOk');

btnBulkDelete?.addEventListener('click', () => {
  const selected = checks().filter(c => c.checked).length;
  if (!selected || !modalDel) return;

  deleteConfirmText.textContent = `¿Eliminar ${selected} registro(s) seleccionados?`;
  modalDel.show();
});

btnDeleteConfirmOk?.addEventListener('click', () => {
  bulkForm.submit();
});

    });

    refreshSelection();
    applyFilter();
  });
</script>
@endpush
