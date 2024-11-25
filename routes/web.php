<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\librosController;
use App\Http\Controllers\clientesController;
use App\Http\Controllers\clientesInaController;
use App\Http\Controllers\prestamosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificacionController;

// Rutas de autenticación para usuarios no autenticados
/*Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});

// Rutas para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});*/

//Ruta Principal
Route::get('/', function(){
    return view('auth.login');
});

//Rutas de Login y Salir
Route::post('/login', [LoginController::class, 'login'])->name('login');
//Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout'); 

// Rutas para autenticación
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');


//Rutas para el apartado de préstamos
Route::resource('/prestamos', prestamosController::class);
Route::get('/prestamos', [prestamosController::class, 'index'])->name('prestamos');
Route::get('/prestamos/create', 'App\Http\Controllers\prestamosController@create')->name('prestamos.create');
Route::post('/prestamos', [prestamosController::class, 'store'])->name('prestamos.store');
Route::get('/prestamos/{id}/edit', [prestamosController::class, 'edit'])->name('prestamos.edit');
Route::put('/prestamos/{id}', [prestamosController::class], 'update');
Route::get('prestamos/{id}/delete', 'App\Http\Controllers\prestamosController@delete')->name('prestamos.delete');

//Rutas para el apartado de libros
Route::resource('/libros', librosController::class);
Route::get('/libros', [librosController::class, 'index'])->name('libros');
Route::get('/libros/create', 'App\Http\Controllers\librosController@create')->name('libros.create');
Route::get('/libros/{id}/show', 'App\Http\Controllers\librosController@show')->name('libros.show');
Route::post('/libros', [librosController::class, 'store'])->name('libros.store');
Route::put('/libros/{id}', [librosController::class], 'update');
Route::get('libros/{id}/delete', 'App\Http\Controllers\librosController@delete')->name('libros.delete');

//Rutas para la pestaña de clientes activos
Route::resource('/clientes', clientesController::class);
Route::get('/clientes', [clientesController::class, 'index'])->name('clientes');
Route::get('/clientes/create', 'App\Http\Controllers\clientesController@create')->name('clientes.create');
Route::get('/clientes/{id}/show', 'App\Http\Controllers\clientesController@show')->name('clientes.show');
Route::post('/clientes', [clientesController::class, 'store'])->name('clientes.store');
Route::put('/clientes/{id}', [clientesController::class], 'update');
//Route::get('clientes/{id}/delete', 'App\Http\Controllers\clientesController@delete')->name('clientes.delete');

//Rutas para la pestaña de clientes inactivos
Route::resource('/inactivos', clientesInaController::class);
Route::get('/inactivos', [clientesInaController::class, 'index'])->name('inactivos');
Route::get('/inactivos/{id}/mover-activo', [clientesInaController::class, 'moverActivo'])->name('inactivos.moverActivo');

//Ruta para la lectura de notificaciones
Route::get('/notificacion/{id}', [NotificacionController::class, 'leerNoti'])->name('notificacion.leer');