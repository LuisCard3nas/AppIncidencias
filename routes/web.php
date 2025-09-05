<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome2', function () {
    return view('welcome2');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta de debug simple
Route::get('/debug-user', function () {
    if (!auth()->check()) {
        return response()->json(['error' => 'No autenticado']);
    }
    
    $user = auth()->user();
    return response()->json([
        'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'role_id' => $user->role_id,
        'role_data' => $user->role ? [
            'id' => $user->role->id,
            'name' => $user->role->name,
            'slug' => $user->role->slug,
        ] : null,
        'methods' => [
            'isAlcalde' => $user->isAlcalde(),
            'isCiudadano' => $user->isCiudadano(),
            'isAdministrador' => $user->isAdministrador(),
            'isFuncionario' => $user->isFuncionario(),
        ]
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
