<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTipoBienRequest;
use App\Http\Requests\UpdateTipoBienRequest;
use App\Models\TipoBien;

class TipoBienController extends Controller
{
    public function index(Request $request)
    {   
        $perPage = (int) $request->get('per_page', 10);
        $perPage = in_array($perPage, [5, 10, 25, 50, 100], true) ? $perPage : 10;

        $q = trim((string) $request->get('q', ''));

        $items = TipoBien::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('nombre_tipo', 'like', "%{$q}%");
            })
            ->orderBy('nombre_tipo')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.tipo_bien.index', compact('items'));
    }

    public function create()
    {
        return view('admin.tipo_bien.create');
    }

    public function store(StoreTipoBienRequest $request)
    {
        TipoBien::create($request->validated());
        return redirect()->route('admin.tipo-bien.index')->with('ok','Registrado');
    }

    public function edit(TipoBien $tipo_bien)
    {
        return view('admin.tipo_bien.edit', ['item' => $tipo_bien]);
    }

    public function update(UpdateTipoBienRequest $request, TipoBien $tipo_bien)
    {
        $tipo_bien->update($request->validated());
        return redirect()->route('admin.tipo-bien.index')->with('ok','Actualizado');
    }

    public function destroy(TipoBien $tipo_bien)
    {
        $tipo_bien->delete();
        return back()->with('ok','Eliminado');
    }
    

    public function bulkDestroy(Request $request)
    {
        $data = $request->validate([
            'ids' => ['required','array','min:1'],
            'ids.*' => ['integer'],
        ]);

        DB::transaction(function () use ($data) {
        TipoBien::whereIn('id_tipo_bien', $data['ids'])->delete();
        });

        return back()->with('ok', 'Registros eliminados');
    }

}
