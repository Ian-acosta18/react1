<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminServiciosController;
use App\Http\Controllers\AdminProductosController; 
use App\Http\Controllers\AdminInstalacionesController;

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

    // --- SERVICIOS ---
    Route::get('/servicios', [AdminServiciosController::class, 'reporte'])->name('servicios.reporte');
    Route::get('/servicios/alta', [AdminServiciosController::class, 'alta'])->name('servicios.alta');
    Route::post('/servicios/guardar', [AdminServiciosController::class, 'guardar'])->name('servicios.guardar');
    Route::get('/servicios/editar/{id}', [AdminServiciosController::class, 'editar'])->name('servicios.editar');
    Route::post('/servicios/actualizar', [AdminServiciosController::class, 'actualizar'])->name('servicios.actualizar');
    Route::get('/servicios/eliminar/{id}', [AdminServiciosController::class, 'eliminar'])->name('servicios.eliminar');

    // --- PRODUCTOS (CORREGIDO: Mapeamos rutas a métodos en Inglés: index, create...) ---
    // La URL y el nombre de ruta siguen igual, pero llamamos a 'index' en vez de 'reporte'
    Route::get('/productos', [AdminProductosController::class, 'index'])->name('productos.reporte');
    Route::get('/productos/alta', [AdminProductosController::class, 'create'])->name('productos.alta');
    Route::post('/productos/guardar', [AdminProductosController::class, 'store'])->name('productos.guardar');
    Route::get('/productos/editar/{id}', [AdminProductosController::class, 'edit'])->name('productos.editar');
    Route::post('/productos/actualizar/{id}', [AdminProductosController::class, 'update'])->name('productos.actualizar');
    Route::get('/productos/eliminar/{id}', [AdminProductosController::class, 'destroy'])->name('productos.eliminar');
    
    // --- INSTALACIONES (Verifica que tu controlador tenga estos métodos) ---
    // Si AdminInstalacionesController también es nuevo y usa inglés, debes corregirlo igual que Productos.
    // Si usa español (reporte, alta...), déjalo así.
    Route::get('/instalaciones', [AdminInstalacionesController::class, 'reporte'])->name('instalaciones.reporte');
    Route::get('/instalaciones/alta', [AdminInstalacionesController::class, 'alta'])->name('instalaciones.alta');
    Route::post('/instalaciones/guardar', [AdminInstalacionesController::class, 'guardar'])->name('instalaciones.guardar');
    Route::get('/instalaciones/editar/{id}', [AdminInstalacionesController::class, 'editar'])->name('instalaciones.editar');
    Route::post('/instalaciones/actualizar', [AdminInstalacionesController::class, 'actualizar'])->name('instalaciones.actualizar');
    Route::get('/instalaciones/eliminar/{id}', [AdminInstalacionesController::class, 'eliminar'])->name('instalaciones.eliminar');
});