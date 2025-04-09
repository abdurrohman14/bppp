<?php

use App\Http\Controllers\Admin\KolamController;
use App\Http\Controllers\Admin\SpesiesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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
    Route::get('/admin', [RoleController::class, 'admin'])->name('admin.dashboard');

    Route::prefix('kolam')->group(function() {
        Route::get('/', [KolamController::class, 'index'])->name('index.kolam');
        Route::get('/create', [KolamController::class, 'create'])->name('create.kolam');
        Route::post('/store', [KolamController::class, 'store'])->name('store.kolam');
        Route::get('/edit/{id}', [KolamController::class, 'edit'])->name('edit.kolam');
        Route::post('/update/{id}', [KolamController::class, 'update'])->name('update.kolam');
        Route::delete('/delete/{id}', [KolamController::class, 'destroy'])->name('delete.kolam');
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
        Route::get('/', [SpesiesController::class, 'index'])->name('index.spesies');
        Route::get('/create', [SpesiesController::class, 'create'])->name('create.spesies');
        Route::post('/store', [SpesiesController::class, 'store'])->name('store.spesies');
        Route::get('/edit/{id}', [SpesiesController::class, 'edit'])->name('edit.spesies');
        Route::post('/update/{id}', [SpesiesController::class, 'update'])->name('update.spesies');
        Route::delete('/delete/{id}', [SpesiesController::class, 'destroy'])->name('delete.spesies');
    });

    Route::prefix('tambah-user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index.pengguna');
        Route::get('/create', [UserController::class, 'create'])->name('create.pengguna');
        Route::post('/store', [UserController::class, 'store'])->name('store.pengguna');
    });
});
Route::middleware(['auth', 'role:petugasKolam'])->group(function() {
    Route::get('/petugasKolam', [RoleController::class, 'petugasKolam'])->name('petugasKolam.dashboard');

});
Route::middleware(['auth', 'role:manajer'])->group(function() {
    Route::get('/manajer', [RoleController::class, 'manajer'])->name('manajer.dashboard');
});



