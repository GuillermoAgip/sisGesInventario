<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TipoBienController;

Route::get('/', fn () => view('welcome'));

/*
|--------------------------------------------------------------------------
| ADMIN (AdminLTE) - SOLO ADMIN
|--------------------------------------------------------------------------
*/
// 'role:ADMIN' (lo activas al final)
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

        Route::get('/theme-generate', fn () => view('admin.theme-generate'))
            ->name('theme-generate');

        // Catálogos
        Route::delete('tipo-bien/bulk-destroy', [TipoBienController::class, 'bulkDestroy'])
            ->name('tipo-bien.bulk-destroy');
        Route::resource('tipo-bien', TipoBienController::class);

        
    });

/*


/*
|--------------------------------------------------------------------------
| DASHBOARD "PUENTE" (Breeze)
|--------------------------------------------------------------------------
| Mientras solo existe TipoBien, manda a algo real.
*/
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| PROFILE (Breeze) - cualquier autenticado
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
