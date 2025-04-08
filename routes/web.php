<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function() {

    Route::prefix('kolam')->group(function() {

    });
    
    Route::prefix('kematian')->group(function() {
    
    });
    
    Route::prefix('kualitas-air')->group(function() {
    
    });
    
    Route::prefix('pakan')->group(function() {
    
    });
    
    Route::prefix('pakan-keluar')->group(function() {
    
    });
    
    Route::prefix('pakan-masuk')->group(function() {
    
    });
    
    Route::prefix('panen')->group(function() {
    
    });
    
    Route::prefix('penebaran-benih')->group(function() {
    
    });
    
    Route::prefix('spesies')->group(function() {
    
    });
});
Route::middleware(['auth', 'role:petugasKolam'])->group(function() {

});
Route::middleware(['auth', 'role:manajer'])->group(function() {

});



