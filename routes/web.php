<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminServiciosController;

// ==========================================
// 1. RUTAS PÚBLICAS (CLIENTES)
// ==========================================
Route::get('/', [PageController::class, 'inicio'])->name('inicio');
Route::get('/servicios', [PageController::class, 'servicios'])->name('servicios');
Route::get('/instalaciones', [PageController::class, 'instalaciones'])->name('instalaciones');
Route::get('/productos', [PageController::class, 'productos'])->name('productos');
Route::get('/nosotros', [PageController::class, 'nosotros'])->name('nosotros');
Route::get('/contacto', [PageController::class, 'contacto'])->name('contacto');
Route::get('/reservaciones', [PageController::class, 'reservaciones'])->name('reservaciones');

// Procesamiento de formularios públicos
Route::post('/reservar', [PageController::class, 'storeReserva'])->name('reserva.store');
Route::post('/contacto', [PageController::class, 'storeContacto'])->name('contacto.store');

// ==========================================
// 2. LOGIN Y AUTENTICACIÓN
// ==========================================
// Ruta para mostrar el formulario (alias 'login' para el middleware)
Route::get('/administrador', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/validar-login', [LoginController::class, 'login'])->name('validar');
Route::get('/cerrar-sesion', [LoginController::class, 'logout'])->name('cerrarsesion');


// ==========================================
// 3. ADMINISTRACIÓN (PROTEGIDAS)
// ==========================================
// Usamos el middleware 'validaradmin' que creamos
Route::middleware(['validaradmin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
Route::get('/servicios', [AdminServiciosController::class, 'reporte'])->name('servicios.reporte');
    Route::get('/servicios/alta', [AdminServiciosController::class, 'alta'])->name('servicios.alta');
    Route::post('/servicios/guardar', [AdminServiciosController::class, 'guardar'])->name('servicios.guardar');
    Route::get('/servicios/editar/{id}', [AdminServiciosController::class, 'editar'])->name('servicios.editar');
    Route::post('/servicios/actualizar', [AdminServiciosController::class, 'actualizar'])->name('servicios.actualizar');
    Route::get('/servicios/eliminar/{id}', [AdminServiciosController::class, 'eliminar'])->name('servicios.eliminar');

    Route::get('/productos', [App\Http\Controllers\AdminProductosController::class, 'reporte'])->name('productos.reporte');
    Route::get('/productos/alta', [App\Http\Controllers\AdminProductosController::class, 'alta'])->name('productos.alta');
    Route::post('/productos/guardar', [App\Http\Controllers\AdminProductosController::class, 'guardar'])->name('productos.guardar');
    Route::get('/productos/editar/{id}', [App\Http\Controllers\AdminProductosController::class, 'editar'])->name('productos.editar');
    Route::post('/productos/actualizar', [App\Http\Controllers\AdminProductosController::class, 'actualizar'])->name('productos.actualizar');
    Route::get('/productos/eliminar/{id}', [App\Http\Controllers\AdminProductosController::class, 'eliminar'])->name('productos.eliminar');


});