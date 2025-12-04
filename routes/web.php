<?php

use Illuminate\Support\Facades\Route;

// --- IMPORTACIÓN DE CONTROLADORES ---
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\AdminProductosController; 
use App\Http\Controllers\AdminServiciosController; 
use App\Http\Controllers\AdminInstalacionesController;

/*
|--------------------------------------------------------------------------
| Web Routes (Rutas de la Aplicación)
|--------------------------------------------------------------------------
*/

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
// 2. RUTAS DE AUTENTICACIÓN (LOGIN)
// ==========================================
// Formulario de Login
Route::get('/administrador', [LoginController::class, 'showLoginForm'])->name('login'); 
// Procesar Login
Route::post('/validar-login', [LoginController::class, 'login'])->name('validar');
// Cerrar Sesión
Route::get('/cerrar-sesion', [LoginController::class, 'logout'])->name('cerrarsesion');

// Ruta de seguridad: Si alguien intenta ir a "/login", lo mandamos a "/administrador"
Route::get('/login', function () {
    return redirect()->route('login');
});


// ==========================================
// 3. RUTAS PROTEGIDAS (ADMINISTRACIÓN)
// ==========================================
// Todo lo que esté aquí requiere haber iniciado sesión (middleware 'auth')
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // --- DASHBOARD PRINCIPAL ---
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // --- CRUD DE PRODUCTOS ---
    Route::resource('productos', AdminProductosController::class);
    
    // --- CRUD DE SERVICIOS ---
    Route::resource('servicios', AdminServiciosController::class);
    
    // --- CRUD DE INSTALACIONES ---
    Route::resource('instalaciones', AdminInstalacionesController::class);

    // --- GESTIÓN DE CITAS ---
    // Reporte general
    Route::get('/citas', [CitasController::class, 'reportecitas'])->name('reportecitas');
    // Editar cita
    Route::get('/citas/editar/{id}', [CitasController::class, 'editacita'])->name('editacita');
    Route::post('/citas/actualizar', [CitasController::class, 'actualizacita'])->name('actualizacita');
    // Eliminar cita
    Route::get('/citas/eliminar/{id}', [CitasController::class, 'eliminacita'])->name('eliminacita');
});



