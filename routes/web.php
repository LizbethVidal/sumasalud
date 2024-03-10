<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);
Route::group(['middleware' => ['auth']], function () {
    Route::post('users/search_tutor', [App\Http\Controllers\UserController::class, 'search_tutor'])->name('users.search_tutor');
    Route::group(['prefix' => 'citas'], function () {
        Route::get('paciente', [App\Http\Controllers\CitaController::class, 'search_paciente'])->name('citas.paciente');
        Route::get('busqueda', [App\Http\Controllers\CitaController::class, 'search'])->name('citas.busqueda');
        Route::get('{cita}/videollamada', [App\Http\Controllers\CitaController::class, 'videollamada'])->name('citas.videollamada');
    });

    Route::group(['prefix' => 'medicos'], function () {
        Route::get('calendario/{medico}', [App\Http\Controllers\MedicosController::class, 'calendario'])->name('medicos.calendario');
    });
});

Route::resource('users', App\Http\Controllers\UserController::class)->middleware(['auth','permisos:admin']);

Route::resource('pacientes', App\Http\Controllers\PacientesController::class)->parameters(['pacientes' => 'user'])->except(['show'])->middleware(['auth','permisos:admin']);
    Route::get('pacientes/{user}', [App\Http\Controllers\PacientesController::class, 'show'])->name('pacientes.show')->middleware(['auth','permisos:admin,medico']);

Route::resource('empleados', App\Http\Controllers\EmpleadosController::class)->parameters(['empleados' => 'user'])->middleware(['auth','permisos:admin']);

Route::resource('especialidades', App\Http\Controllers\EspecialidadesController::class)->parameters(['especialidades' => 'especialidad'])->middleware(['auth','permisos:admin']);

Route::resource('medicos', App\Http\Controllers\MedicosController::class)->parameters(['medicos' => 'user'])->middleware(['auth','permisos:admin,medico']);

Route::resource('citas', App\Http\Controllers\CitaController::class)->except(['show'])->middleware(['auth','permisos:admin,medico']);
    Route::get('citas/{cita}', [App\Http\Controllers\CitaController::class, 'show'])->name('citas.show')->middleware(['auth']);

Route::resource('tratamientos', App\Http\Controllers\TratamientosController::class)->middleware(['auth','permisos:admin,medico']);

Route::resource('consultas', App\Http\Controllers\ConsultasController::class)->middleware(['auth','permisos:admin,medico']);
