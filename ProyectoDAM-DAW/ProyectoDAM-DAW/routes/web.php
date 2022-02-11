<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
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
Route::get('admin/jugadores', [UsuarioController::class, 'index'])->middleware('role:usuarios');
Route::get('admin/jugadores/crear', [UsuarioController::class, 'crear'])->middleware('role:usuarios');
Route::post('admin/jugadores/guardar', [UsuarioController::class, 'guardar'])->middleware('role:usuarios');
Route::get('admin/jugadores/editar/{id}', [UsuarioController::class, 'editar'])->middleware('role:usuarios');
Route::post('admin/jugadores/actualizar/{id}', [UsuarioController::class, 'actualizar'])->middleware('role:usuarios');
Route::get('admin/jugadores/activar/{id}', [UsuarioController::class, 'activar'])->middleware('role:usuarios');
Route::get('admin/jugadores/borrar/{id}', [UsuarioController::class, 'borrar'])->middleware('role:usuarios');
// Route::get('admin/{nombre}', [UsuarioController::class, 'index'])->middleware('role:usuarios'); -> Menú propio
Route::get('acerca-de', [AddController::class, 'acerca_de'])->name('acerca-de');
//Auth
Route::get('/', [AuthController::class, 'acceder'])->name('acceder');
Route::post('autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::get('registro', [AuthController::class, 'registro'])->name('registro');
Route::post('registrarse', [AuthController::class, 'registrarse'])->name('registrarse');
Route::post('salir', [AuthController::class, 'salir'])->name('salir');

Route::get('mostrar', [ApiController::class, 'mostrar'])->name('mostrar');
Route::get('leer', [ApiController::class, 'leer'])->name('leer');
Route::get('escribir/ProyectoDam-Daw/{id}', [ApiController::class, 'escribir'])->name('escribir');
