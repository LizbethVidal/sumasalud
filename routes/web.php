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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);
Route::group(['middleware' => ['auth']], function () {
    Route::post('users/search_tutor', [App\Http\Controllers\UserController::class, 'search_tutor'])->name('users.search_tutor');
});
Route::resource('users', App\Http\Controllers\UserController::class)->middleware(['auth','permisos:admin']);
Route::resource('pacientes', App\Http\Controllers\PacientesController::class)->parameters(['pacientes' => 'user'])->middleware(['auth','permisos:admin']);

Route::resource('empleados', App\Http\Controllers\EmpleadosController::class)->middleware(['auth','permisos:admin']);

Route::resource('especialidades', App\Http\Controllers\EspecialidadesController::class)->parameters(['especialidades' => 'especialidad'])->middleware(['auth','permisos:admin']);


