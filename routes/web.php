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
    Route::group(['prefix' => 'pacientes'], function () {
        Route::get('medicos_paciente/{paciente}', [App\Http\Controllers\PacientesController::class, 'medicos_paciente'])->name('pacientes.medicos_paciente');
        Route::post('asignar_medico', [App\Http\Controllers\PacientesController::class, 'asignar_medico'])->name('pacientes.asignar_medico');
        Route::post('desasignar_medico/{paciente}/{doctor}', [App\Http\Controllers\PacientesController::class, 'desasignar_medico'])->name('pacientes.desasignar_medico');
    });
    Route::group(['prefix' => 'medicos'], function () {
        Route::get('calendario/{medico}', [App\Http\Controllers\MedicosController::class, 'calendario'])->name('medicos.calendario');
        Route::get('get_medicos', [App\Http\Controllers\MedicosController::class, 'get_medicos'])->name('medicos.get_medicos');
    });

    Route::group(['prefix' => 'tratamientos'], function () {
        Route::get('busqueda', [App\Http\Controllers\TratamientosController::class, 'search'])->name('tratamientos.busqueda');
    });
});

Route::resource('users', App\Http\Controllers\UserController::class)->middleware(['auth','permisos:admin']);

Route::resource('pacientes', App\Http\Controllers\PacientesController::class)->parameters(['pacientes' => 'user'])->except(['show,index'])->middleware(['auth','permisos:admin']);
    Route::get('pacientes/{user}', [App\Http\Controllers\PacientesController::class, 'show'])->name('pacientes.show')->middleware(['auth','permisos:admin,medico']);
    Route::get('pacientes', [App\Http\Controllers\PacientesController::class, 'index'])->name('pacientes.index')->middleware(['auth','permisos:admin,medico']);

Route::resource('empleados', App\Http\Controllers\EmpleadosController::class)->parameters(['empleados' => 'user'])->middleware(['auth','permisos:admin']);

Route::resource('especialidades', App\Http\Controllers\EspecialidadesController::class)->parameters(['especialidades' => 'especialidad'])->except(['edit,create'])->middleware(['auth','permisos:admin,medico']);
Route::get('especialidades/create', [App\Http\Controllers\EspecialidadesController::class, 'create'])->name('especialidades.create')->middleware(['auth','permisos:admin']);
Route::get('especialidades/{especialidad}/edit', [App\Http\Controllers\EspecialidadesController::class, 'edit'])->name('especialidades.edit')->middleware(['auth','permisos:admin']);

Route::resource('medicos', App\Http\Controllers\MedicosController::class)->parameters(['medicos' => 'user'])->middleware(['auth','permisos:admin,medico']);

Route::resource('citas', App\Http\Controllers\CitaController::class)->except(['show'])->middleware(['auth','permisos:admin,medico']);
Route::get('citas/{cita}', [App\Http\Controllers\CitaController::class, 'show'])->name('citas.show')->middleware(['auth']);

Route::resource('tratamientos', App\Http\Controllers\TratamientosController::class)->middleware(['auth','permisos:admin,medico']);

Route::resource('consultas', App\Http\Controllers\ConsultasController::class)->except(['create,update'])->middleware(['auth','permisos:admin,medico']);

Route::resource('solicitudes', App\Http\Controllers\SolicitudController::class)->except(['create'])->middleware(['auth','permisos:admin,medico']);

Route::get('solicitudes/create/{paciente}', [App\Http\Controllers\SolicitudController::class, 'create'])->name('solicitudes.create')->middleware(['auth','permisos:admin,medico']);

Route::group(['prefix' => 'consultas'], function () {
    Route::get('create/{cita}', [App\Http\Controllers\ConsultasController::class, 'create'])->name('consultas.create')->middleware(['auth','permisos:medico']);
    Route::post('store/', [App\Http\Controllers\ConsultasController::class, 'store'])->name('consultas.store')->middleware(['auth','permisos:medico']);
    Route::get('edit/{consulta}', [App\Http\Controllers\ConsultasController::class, 'edit'])->name('consultas.edit')->middleware(['auth','permisos:medico']);
    Route::put('update/{consulta}', [App\Http\Controllers\ConsultasController::class, 'update'])->name('consultas.update')->middleware(['auth','permisos:medico']);
});
