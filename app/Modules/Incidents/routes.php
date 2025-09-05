<?php

use App\Modules\Incidents\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

// Rutas del módulo de Incidents - Mantenemos el nombre /applications para consistencia
Route::middleware(['auth', 'role:4,1,3'])->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{id}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::get('/applications/{id}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{id}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
});
