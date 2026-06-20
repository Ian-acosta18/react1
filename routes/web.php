<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminServiciosController;
use App\Http\Controllers\AdminProductosController; 
use App\Http\Controllers\AdminInstalacionesController;

// ==========================================
// 1. LOGIN Y ADMINISTRACIÓN (Se mantienen en Laravel)
// ==========================================
Route::get('/administrador', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/validar-login', [LoginController::class, 'login'])->name('validar');
Route::get('/cerrar-sesion', [LoginController::class, 'logout'])->name('cerrarsesion');

Route::middleware(['validaradmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/servicios', [AdminServiciosController::class, 'reporte'])->name('servicios.reporte');
    Route::get('/servicios/alta', [AdminServiciosController::class, 'alta'])->name('servicios.alta');
    Route::post('/servicios/guardar', [AdminServiciosController::class, 'guardar'])->name('servicios.guardar');
    Route::get('/servicios/editar/{id}', [AdminServiciosController::class, 'editar'])->name('servicios.editar');
    Route::post('/servicios/actualizar', [AdminServiciosController::class, 'actualizar'])->name('servicios.actualizar');
    Route::get('/servicios/eliminar/{id}', [AdminServiciosController::class, 'eliminar'])->name('servicios.eliminar');

    Route::get('/productos', [AdminProductosController::class, 'reporte'])->name('productos.reporte');
    Route::get('/productos/alta', [AdminProductosController::class, 'alta'])->name('productos.alta');
    Route::post('/productos/guardar', [AdminProductosController::class, 'guardar'])->name('productos.guardar');
    Route::get('/productos/editar/{id}', [AdminProductosController::class, 'editar'])->name('productos.editar');
    Route::post('/productos/actualizar', [AdminProductosController::class, 'actualizar'])->name('productos.actualizar');
    Route::get('/productos/eliminar/{id}', [AdminProductosController::class, 'eliminar'])->name('productos.eliminar');
    
    Route::get('/instalaciones', [AdminInstalacionesController::class, 'reporte'])->name('instalaciones.reporte');
    Route::get('/instalaciones/alta', [AdminInstalacionesController::class, 'alta'])->name('instalaciones.alta');
    Route::post('/instalaciones/guardar', [AdminInstalacionesController::class, 'guardar'])->name('instalaciones.guardar');
    Route::get('/instalaciones/editar/{id}', [AdminInstalacionesController::class, 'editar'])->name('instalaciones.editar');
    Route::post('/instalaciones/actualizar', [AdminInstalacionesController::class, 'actualizar'])->name('instalaciones.actualizar');
    Route::get('/instalaciones/eliminar/{id}', [AdminInstalacionesController::class, 'eliminar'])->name('instalaciones.eliminar');
});

// ==========================================
// 2. RUTAS PÚBLICAS (Delegadas a React Router)
// ==========================================
// Excluye las rutas que comiencen con admin o administrador para no interferir
Route::view('/{path?}', 'welcome')->where('path', '^(?!admin|administrador).*$');