<?php

use App\Http\Controllers\Admin\KematianController;
use App\Http\Controllers\Admin\KolamController;
use App\Http\Controllers\Admin\kualitasAirController;
use App\Http\Controllers\Admin\PanenController;
use App\Http\Controllers\Admin\penebaranBenihController;
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

    // Rute Kolam
    Route::prefix('kolam')->group(function() {
        Route::get('/', [KolamController::class, 'index'])->name('index.kolam');
        Route::get('/create', [KolamController::class, 'create'])->name('create.kolam');
        Route::post('/store', [KolamController::class, 'store'])->name('store.kolam');
        Route::get('/edit/{id}', [KolamController::class, 'edit'])->name('edit.kolam');
        Route::post('/update/{id}', [KolamController::class, 'update'])->name('update.kolam');
        Route::delete('/delete/{id}', [KolamController::class, 'destroy'])->name('delete.kolam');
    });

    // Rute Kematian
    Route::prefix('kematian')->group(function() {
        Route::get('/', [KematianController::class, 'index'])->name('index.kematian');
        Route::get('/create', [KematianController::class, 'create'])->name('create.kematian');
        Route::post('/store', [KematianController::class, 'store'])->name('store.kematian');
        Route::get('/edit/{id}', [KematianController::class, 'edit'])->name('edit.kematian');
        Route::post('/update/{id}', [KematianController::class, 'update'])->name('update.kematian');
        Route::delete('/delete/{id}', [KematianController::class, 'destroy'])->name('delete.kematian');
    });

    // Rute Kualitas Air
    Route::prefix('admin')->name('kualitas_air.')->group(function () {
        Route::get('/kualitas-air', [KualitasAirController::class, 'index'])->name('index');
        Route::get('/kualitas-air/create', [KualitasAirController::class, 'create'])->name('create');
        Route::post('/kualitas-air', [KualitasAirController::class, 'store'])->name('store');
        Route::get('/kualitas-air/{id}/edit', [KualitasAirController::class, 'edit'])->name('edit');
        Route::put('/kualitas-air/{id}', [KualitasAirController::class, 'update'])->name('update');
        Route::delete('/kualitas-air/{id}', [KualitasAirController::class, 'destroy'])->name('destroy');
    });

    // Rute Penebaran Benih
    Route::prefix('penebaran-benih')->group(function() {
        Route::get('/', [penebaranBenihController::class, 'index'])->name('index.benih');
        Route::get('/create', [penebaranBenihController::class, 'create'])->name('create.benih');
        Route::post('/store', [penebaranBenihController::class, 'store'])->name('store.benih');
        Route::get('/edit/{id}', [penebaranBenihController::class, 'edit'])->name('edit.benih');
        Route::post('/update/{id}', [penebaranBenihController::class, 'update'])->name('update.benih');
        Route::delete('/delete/{id}', [penebaranBenihController::class, 'destroy'])->name('delete.benih');
    });

    // Rute Spesies
    Route::prefix('spesies')->group(function() {
        Route::get('/', [SpesiesController::class, 'index'])->name('index.spesies');
        Route::get('/create', [SpesiesController::class, 'create'])->name('create.spesies');
        Route::post('/store', [SpesiesController::class, 'store'])->name('store.spesies');
        Route::get('/edit/{id}', [SpesiesController::class, 'edit'])->name('edit.spesies');
        Route::post('/update/{id}', [SpesiesController::class, 'update'])->name('update.spesies');
        Route::delete('/delete/{id}', [SpesiesController::class, 'destroy'])->name('delete.spesies');
    });

    // Rute Panen
    Route::prefix('panen')->group(function() {
        Route::get('/', [PanenController::class, 'index'])->name('index.panen');
        Route::get('/create', [PanenController::class, 'create'])->name('create.panen');
        Route::post('/store', [PanenController::class, 'store'])->name('store.panen');
        Route::get('/edit/{id}', [PanenController::class, 'edit'])->name('edit.panen');
        Route::post('/update/{id}', [PanenController::class, 'update'])->name('update.panen');
        Route::delete('/delete/{id}', [PanenController::class, 'destroy'])->name('delete.panen');
    });

    // Route Pakan Keluar
    Route::prefix('pakan-keluar')->group(function() {

    });

    // Rute Pengguna (User)
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



