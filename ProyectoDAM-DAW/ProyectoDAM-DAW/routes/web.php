<?php

use Illuminate\Support\Facades\Route;

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
Route::get('admin/usuarios', [UsuarioController::class, 'index'])->middleware('role:usuarios');
Route::get('admin/usuarios/crear', [UsuarioController::class, 'crear'])->middleware('role:usuarios');
Route::post('admin/usuarios/guardar', [UsuarioController::class, 'guardar'])->middleware('role:usuarios');
Route::get('admin/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->middleware('role:usuarios');
Route::post('admin/usuarios/actualizar/{id}', [UsuarioController::class, 'actualizar'])->middleware('role:usuarios');
Route::get('admin/usuarios/activar/{id}', [UsuarioController::class, 'activar'])->middleware('role:usuarios');
Route::get('admin/usuarios/borrar/{id}', [UsuarioController::class, 'borrar'])->middleware('role:usuarios');
// Route::get('admin/{nombre}', [UsuarioController::class, 'index'])->middleware('role:usuarios');
//Auth
Route::get('/', [AuthController::class, 'acceder'])->name('acceder');
Route::post('autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::get('registro', [AuthController::class, 'registro'])->name('registro');
Route::post('registrarse', [AuthController::class, 'registrarse'])->name('registrarse');
Route::post('salir', [AuthController::class, 'salir'])->name('salir');
