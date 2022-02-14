<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AddController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Back-end
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/jugadores', [JugadorController::class, 'index'])->middleware('role:jugadores');
Route::get('admin/jugadores/crear', [JugadorController::class, 'crear'])->middleware('role:jugadores');
Route::post('admin/jugadores/guardar', [JugadorController::class, 'guardar'])->middleware('role:jugadores');
Route::get('admin/jugadores/editar/{id}', [JugadorController::class, 'editar'])->middleware('role:jugadores');
Route::post('admin/jugadores/actualizar/{id}', [JugadorController::class, 'actualizar'])->middleware('role:jugadores');
Route::get('admin/jugadores/activar/{id}', [JugadorController::class, 'activar'])->middleware('role:jugadores');
Route::get('admin/jugadores/borrar/{id}', [JugadorController::class, 'borrar'])->middleware('role:jugadores');
// Route::get('admin/{nombre}', [JugadorController::class, 'index'])->middleware('role:jugadores'); -> Menú propio
Route::get('acerca-de', [AddController::class, 'acerca_de'])->name('acerca-de');
//Auth
Route::get('acceder', [AuthController::class, 'acceder'])->name('acceder');
Route::post('autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::get('registro', [AuthController::class, 'registro'])->name('registro');
Route::post('registrarse', [AuthController::class, 'registrarse'])->name('registrarse');
Route::post('salir', [AuthController::class, 'salir'])->name('salir');
//Api
Route::get('mostrar', [ApiController::class, 'mostrar'])->name('mostrar');
Route::get('leer', [ApiController::class, 'leer'])->name('leer');
Route::get('escribir/ProyectoDam-Daw/{id}', [ApiController::class, 'escribir'])->name('escribir');
