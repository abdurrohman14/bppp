<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KolamController;
use App\Http\Controllers\Admin\PakanController;
use App\Http\Controllers\Admin\PanenController;
use App\Http\Controllers\Petugas\BnhController;
use App\Http\Controllers\Petugas\KlmController;
use App\Http\Controllers\Petugas\KuaController;
use App\Http\Controllers\Petugas\PanController;
use App\Http\Controllers\Petugas\SpsController;
use App\Http\Controllers\Petugas\KmtnController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\SpesiesController;
use App\Http\Controllers\Admin\KematianController;
use App\Http\Controllers\Petugas\JenisPController;
use App\Http\Controllers\Petugas\PakanKController;
use App\Http\Controllers\Petugas\PakanMController;
use App\Http\Controllers\Admin\pakanMasukController;
use App\Http\Controllers\Admin\JadwalPakanController;
use App\Http\Controllers\Admin\KualitasAirController;
use App\Http\Controllers\Admin\LprnController;
use App\Http\Controllers\Admin\pakanKeluarController;
use App\Http\Controllers\Admin\PenebaranBenihController;
use App\Http\Controllers\Manajer\LprnController as ManajerLprnController;

Route::get('/', function () {
    return view('auth.login');
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
        Route::put('/update/{id}', [PanenController::class, 'update'])->name('update.panen');
        Route::delete('/delete/{id}', [PanenController::class, 'destroy'])->name('delete.panen');
    });

    // Rute Pakan
    Route::prefix('jenis-pakan')->group(function () {
        Route::get('/', [PakanController::class, 'index'])->name('index.pakan');
        Route::get('/create', [PakanController::class, 'create'])->name('pakan.create');
        Route::post('/store', [PakanController::class, 'store'])->name('pakan.store');
        Route::get('/{id}/edit', [PakanController::class, 'edit'])->name('pakan.edit');
        Route::put('/update/{id}', [PakanController::class, 'update'])->name('pakan.update');
        Route::delete('/delete/{id}', [PakanController::class, 'destroy'])->name('pakan.destroy');
    });

    // Rute Pakan Keluar
    Route::prefix('pakan-keluar')->group(function () {
        Route::get('/', [pakanKeluarController::class, 'index'])->name('index.pakan.Keluar');
        Route::get('/create', [pakanKeluarController::class, 'create'])->name('pakan.Keluar.create');
        Route::post('/store', [pakanKeluarController::class, 'store'])->name('pakan.Keluar.store');
        Route::get('/{id}/edit', [pakanKeluarController::class, 'edit'])->name('pakan.Keluar.edit');
        Route::put('/update/{id}', [pakanKeluarController::class, 'update'])->name('pakan.Keluar.update');
        Route::delete('/delete/{id}', [pakanKeluarController::class, 'destroy'])->name('pakan.Keluar.destroy');
    });


    // Rute Pakan masuk
    Route::prefix('pakan-masuk')->group(function () {
        Route::get('/', [PakanMasukController::class, 'index'])->name('index.pakan.masuk');
        Route::get('/create', [PakanMasukController::class, 'create'])->name('pakan.masuk.create');
        Route::post('/store', [PakanMasukController::class, 'store'])->name('pakan.masuk.store');
        Route::get('/edit/{id}', [PakanMasukController::class, 'edit'])->name('edit.pakan.masuk');
        Route::put('/update/{id}', [PakanMasukController::class, 'update'])->name('update.pakan.masuk');
        Route::delete('/delete/{id}', [PakanMasukController::class, 'destroy'])->name('pakan.masuk.destroy');
    });

            // Rute Jadwal Pakan
    Route::prefix('jadwal-pakan')->group(function () {
        Route::get('/', [JadwalPakanController::class, 'index'])->name('index.jadwal.pakan');
        Route::get('/create', [JadwalPakanController::class, 'create'])->name('jadwal.pakan.create');
        Route::post('/store', [JadwalPakanController::class, 'store'])->name('jadwal.pakan.store');
        Route::get('/{id}/edit', [JadwalPakanController::class, 'edit'])->name('jadwal.pakan.edit');
        Route::put('/update/{id}', [JadwalPakanController::class, 'update'])->name('jadwal.pakan.update');
        Route::delete('/delete/{id}', [JadwalPakanController::class, 'destroy'])->name('jadwal.pakan.destroy');
    });

        // Rute Pengguna (User)
    Route::prefix('tambah-user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index.pengguna');
        Route::get('/create', [UserController::class, 'create'])->name('create.pengguna');
        Route::post('/store', [UserController::class, 'store'])->name('store.pengguna');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit.pengguna');
        Route::put('/{id}', [UserController::class, 'update'])->name('update.pengguna');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete.pengguna');
    });

    // Rute Laporan
    Route::prefix('laporan')->group(function() {
        Route::get('/', [LaporanController::class, 'index'])->name('index.laporan');
        Route::get('/generate', [LaporanController::class, 'generate'])->name('generate.laporan');
    });


Route::middleware(['auth', 'role:petugasKolam'])->group(function() {
    Route::get('/petugasKolam', [RoleController::class, 'petugasKolam'])->name('petugasKolam.dashboard');

    // Rute Kolam
    Route::prefix('petugas-kolam')->group(function () {
        Route::get('/', [KlmController::class, 'index'])->name('index.petugas.kolam');
        Route::get('/create', [KlmController::class, 'create'])->name('create.petugas.kolam');
        Route::post('/store', [KlmController::class, 'store'])->name('store.petugas.kolam');
        Route::get('/edit/{id}', [KlmController::class, 'edit'])->name('edit.petugas.kolam');
        Route::post('/update/{id}', [KlmController::class, 'update'])->name('update.petugas.kolam');
        Route::delete('/delete/{id}', [KlmController::class, 'destroy'])->name('delete.petugas.kolam');
    });

    // Rute Spesies
    Route::prefix('petugas-spesies')->group(function() {
        Route::get('/', [SpsController::class, 'index'])->name('index.petugas.spesies');
        Route::get('/create', [SpsController::class, 'create'])->name('create.petugas.spesies');
        Route::post('/store', [SpsController::class, 'store'])->name('store.petugas.spesies');
        Route::get('/edit/{id}', [SpsController::class, 'edit'])->name('edit.petugas.spesies');
        Route::post('/update/{id}', [SpsController::class, 'update'])->name('update.petugas.spesies');
        Route::delete('/delete/{id}', [SpsController::class, 'destroy'])->name('delete.petugas.spesies');
    });

     // Rute Penebaran Benih
     Route::prefix('petugas-benih')->group(function() {
        Route::get('/', [BnhController::class, 'index'])->name('index.petugas.benih');
        Route::get('/create', [BnhController::class, 'create'])->name('create.petugas.benih');
        Route::post('/store', [BnhController::class, 'store'])->name('store.petugas.benih');
        Route::get('/edit/{id}', [BnhController::class, 'edit'])->name('edit.petugas.benih');
        Route::post('/update/{id}', [BnhController::class, 'update'])->name('update.petugas.benih');
        Route::delete('/delete/{id}', [BnhController::class, 'destroy'])->name('delete.petugas.benih');
    });

    // Rute Penebaran Benih
    Route::prefix('petugas-kematian')->group(function() {
        Route::get('/', [KmtnController::class, 'index'])->name('index.petugas.kematian');
        Route::get('/create', [KmtnController::class, 'create'])->name('create.petugas.kematian');
        Route::post('/store', [KmtnController::class, 'store'])->name('store.petugas.kematian');
        Route::get('/edit/{id}', [KmtnController::class, 'edit'])->name('edit.petugas.kematian');
        Route::post('/update/{id}', [KmtnController::class, 'update'])->name('update.petugas.kematian');
        Route::delete('/delete/{id}', [KmtnController::class, 'destroy'])->name('delete.petugas.kematian');
    });

    // Rute Kematian
    Route::prefix('petugas-kualitas-air')->group(function() {
        Route::get('/', [KmtnController::class, 'index'])->name('index.petugas.kematian');
        Route::get('/create', [KmtnController::class, 'create'])->name('create.petugas.kematian');
        Route::post('/store', [KmtnController::class, 'store'])->name('store.petugas.kematian');
        Route::get('/edit/{id}', [KmtnController::class, 'edit'])->name('edit.petugas.kematian');
        Route::post('/update/{id}', [KmtnController::class, 'update'])->name('update.petugas.kematian');
        Route::delete('/delete/{id}', [KmtnController::class, 'destroy'])->name('delete.petugas.kematian');
    });

     // Rute Kualitas Air
     Route::prefix('petugas-kualitas-air')->group(function() {
        Route::get('/', [KuaController::class, 'index'])->name('index.petugas.kualitasair');
        Route::get('/create', [KuaController::class, 'create'])->name('create.petugas.kualitasair');
        Route::post('/store', [KuaController::class, 'store'])->name('store.petugas.kualitasair');
        Route::get('/edit/{id}', [KuaController::class, 'edit'])->name('edit.petugas.kualitasair');
        Route::post('/update/{id}', [KuaController::class, 'update'])->name('update.petugas.kualitasair');
        Route::delete('/delete/{id}', [KuaController::class, 'destroy'])->name('delete.petugas.kualitasair');
    });

     // Rute Panen
     Route::prefix('petugas-panen')->group(function() {
        Route::get('/', [PanController::class, 'index'])->name('index.petugas.panen');
        Route::get('/create', [PanController::class, 'create'])->name('create.petugas.panen');
        Route::post('/store', [PanController::class, 'store'])->name('store.petugas.panen');
        Route::get('/edit/{id}', [PanController::class, 'edit'])->name('edit.petugas.panen');
        Route::put('/update/{id}', [PanController::class, 'update'])->name('update.petugas.panen');
        Route::delete('/delete/{id}', [PanController::class, 'destroy'])->name('delete.petugas.panen');
    });

    // Rute Pakan Keluar
    Route::prefix('petugas-pakan-keluar')->group(function () {
        Route::get('/', [PakanKController::class, 'index'])->name('index.petugas.PakanKeluar');
        Route::get('/create', [PakanKController::class, 'create'])->name('create.petugas.PakanKeluar');
        Route::post('/store', [PakanKController::class, 'store'])->name('store.petugas.PakanKeluar');
        Route::get('/{id}/edit', [PakanKController::class, 'edit'])->name('edit.petugas.PakanKeluar');
        Route::put('/update/{id}', [PakanKController::class, 'update'])->name('update.petugas.PakanKeluar');
        Route::delete('/delete/{id}', [PakanKController::class, 'destroy'])->name('destroy.petugas.PakanKeluar');
    });

        // Rute Pakan Masuk
        Route::prefix('petugas-pakan-masuk')->group(function () {
            Route::get('/', [PakanMController::class, 'index'])->name('index.petugas.PakanMasuk');
            Route::get('/create', [PakanMController::class, 'create'])->name('create.petugas.PakanMasuk');
            Route::post('/store', [PakanMController::class, 'store'])->name('store.petugas.PakanMasuk');
            Route::get('/{id}/edit', [PakanMController::class, 'edit'])->name('edit.petugas.PakanMasuk');
            Route::put('/update/{id}', [PakanMController::class, 'update'])->name('update.petugas.PakanMasuk');
            Route::delete('/delete/{id}', [PakanMController::class, 'destroy'])->name('destroy.petugas.PakanMasuk');
        });

        // Rute Jenis Pakan
    Route::prefix('petugas-jenis-pakan')->group(function () {
        Route::get('/', [JenisPController::class, 'index'])->name('index.petugas.JenisPakan');
        Route::get('/create', [JenisPController::class, 'create'])->name('create.petugas.JenisPakan');
        Route::post('/store', [JenisPController::class, 'store'])->name('store.petugas.JenisPakan');
        Route::get('/{id}/edit', [JenisPController::class, 'edit'])->name('edit.petugas.JenisPakan');
        Route::put('/update/{id}', [JenisPController::class, 'update'])->name('update.petugas.JenisPakan');
        Route::delete('/delete/{id}', [JenisPController::class, 'destroy'])->name('destroy.petugas.JenisPakan');
    });
});

Route::middleware(['auth', 'role:manajer'])->group(function() {
    Route::get('/manajer', [RoleController::class, 'manajer'])->name('manajer.dashboard');
});

// // Rute Laporan
//     Route::prefix('laporan')->group(function() {
//         Route::get('/', [LprnController::class, 'index'])->name('index.manajer.lprn');
//         Route::get('/generate', [LprnController::class, 'generate'])->name('generate.manajer.lprn');
//     });
});
