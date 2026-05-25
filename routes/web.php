<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\AperturaExpensaController;
use App\Http\Controllers\ExpensaController;

/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // 🏢 Selección de edificio
    Route::get('/seleccionar-edificio', [EdificioController::class, 'seleccionar'])
        ->name('edificios.seleccionar');

    Route::post('/seleccionar-edificio/{id}', [EdificioController::class, 'elegir'])
        ->name('edificios.elegir');

    // 📊 Dashboard (PROTEGIDO por selección de edificio)
    Route::get('/dashboard', function () {

        if (!session('edificio_id')) {
            return redirect()->route('edificios.seleccionar');
        }

        return view('dashboard');

    })->name('dashboard');

    // 👤 Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🏢 CRUD Edificio
    Route::get('/edificios', [EdificioController::class, 'index'])->name('edificios.index');
    Route::get('/edificios/crear', [EdificioController::class, 'create'])->name('edificios.create');
    Route::post('/edificios', [EdificioController::class, 'store'])->name('edificios.store');
    Route::get('/edificios/{id}/edit', [EdificioController::class, 'edit'])->name('edificios.edit');
    Route::put('/edificios/{id}', [EdificioController::class, 'update'])->name('edificios.update');

    // Rutas para pdf de edificio
    Route::get('/propietarios/pdf/reporte', [PropietarioController::class, 'pdf'])->name('propietarios.pdf');

    // 🏢 CRUD Propietario

    Route::get('propietarios', [PropietarioController::class, 'index'])->name('propietarios.index');
    Route::get('propietarios/create', [PropietarioController::class, 'create'])->name('propietarios.create');
    Route::post('propietarios', [PropietarioController::class, 'store'])->name('propietarios.store');
    Route::get('/propietarios/{id}/edit', [PropietarioController::class, 'edit'])->name('propietarios.edit');
    Route::put('/propietarios/{id}', [PropietarioController::class, 'update'])->name('propietarios.update');

    // 🏢 CRUD Departamento
    Route::get('/departamentos', [DepartamentoController::class, 'index'])->name('departamentos.index');
    Route::get('/departamentos/create', [DepartamentoController::class, 'create'])->name('departamentos.create');
    Route::post('/departamentos', [DepartamentoController::class, 'store'])->name('departamentos.store');
    Route::get('/departamentos/{id}/edit', [DepartamentoController::class, 'edit'])->name('departamentos.edit');
    Route::put('/departamentos/{id}', [DepartamentoController::class, 'update'])->name('departamentos.update');
    Route::get('/departamentos/pdf/reporte', [DepartamentoController::class, 'pdf'])->name('departamentos.pdf');


    //Rutas CRUD Apertura Expensa
    Route::get('/apertura-expensas', [AperturaExpensaController::class, 'index'])->name('apertura-expensas.index');
    Route::get('/apertura-expensas/create', [AperturaExpensaController::class, 'create'])->name('apertura-expensas.create');
    Route::post('/apertura-expensas/store', [AperturaExpensaController::class, 'store'])->name('apertura-expensas.store');
    Route::get('/apertura-expensas/{apertura_expensa}/edit', [AperturaExpensaController::class, 'edit'])->name('apertura-expensas.edit');
    Route::put('/apertura-expensas/{apertura_expensa}', [AperturaExpensaController::class, 'update'])->name('apertura-expensas.update');
    Route::delete('/apertura-expensas/{apertura_expensa}', [AperturaExpensaController::class, 'destroy'])->name('apertura-expensas.destroy');

    // Rutas de CRUD Expensa
    Route::get('/expensas', [ExpensaController::class, 'index'])->name('expensas.index');
    Route::get('/expensas/create', [ExpensaController::class, 'create'])->name('expensas.create');
    Route::post('/expensas/store', [ExpensaController::class, 'store'])->name('expensas.store');
    Route::get('/expensas/{expensa}/edit', [ExpensaController::class, 'edit'])->name('expensas.edit');
    Route::put('/expensas/{expensa}', [ExpensaController::class, 'update'])->name('expensas.update');
    Route::delete('/expensas/{expensa}', [ExpensaController::class, 'destroy'])->name('expensas.destroy');

    // PAGO EXPENSAS
    Route::get('/pago-expensas', [ExpensaController::class, 'pagoExpensas'])->name('pago-expensas.index');
    Route::get('/pago-expensas/{apertura}', [ExpensaController::class, 'expensasPorApertura'])->name('pago-expensas.expensas');



});

/*
|--------------------------------------------------------------------------
| Rutas de autenticación (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';