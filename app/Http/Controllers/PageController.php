<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Mantenemos esta línea por si necesitas usar SQL directo en el futuro, 
// aunque para 'servicios' usaremos Eloquent.
use Illuminate\Support\Facades\DB;

use App\Models\Categoria;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Contacto;
use App\Models\Productos;

// Importamos las Clases de Solicitud (Requests) para validación
use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\StoreContactoRequest;

class PageController extends Controller
{
    public function inicio() {
        return view('pages.inicio');
    }

    /*
     * MÉTODO SERVICIOS CORREGIDO
     * Tu vista 'servicios.blade.php' usa un bucle @foreach($categorias...),
     * por lo tanto, aquí DEBEMOS enviar la variable $categorias.
     */
    public function servicios() {
        // Opción Correcta: Traer Categorías con sus Servicios
        $categorias = Categoria::with('servicios')->get();

        // Usamos compact para enviar la variable $categorias a la vista
        return view('pages.servicios', compact('categorias'));
    }

    public function nosotros() {
        return view('pages.nosotros');
    }

    public function contacto() {
        return view('pages.contacto');
    }

    public function productos() {
        $productos = Productos::all();
        return view('pages.productos', compact('productos'));
    }

    public function reservaciones() {
        $servicios = Servicio::with('categoria')->get();
        return view('pages.reservaciones', ['servicios' => $servicios]);
    }

    public function gracias() {
        return view('pages.gracias');
    }

    /**
     * Procesa y almacena una nueva reserva.
     */
    public function storeReserva(StoreReservaRequest $request) {
        $validated = $request->validated();

        $reservaData = [
            'nombre'       => $validated['nombres'],
            'apaterno'     => $validated['apellido_paterno'],
            'amaterno'     => $validated['apellido_materno'],
            'correo'       => $validated['correo'],
            'telefono'     => $validated['telefono'],
            'servicios'    => json_encode($validated['servicios']),
            'fechadeseada' => $validated['fecha'],
            'horadeseada'  => $validated['hora'],
            'mensaje'      => $validated['mensaje'] ?? null,
        ];

        Reserva::create($reservaData);

        return back()->with('success', '¡Tu reserva ha sido creada exitosamente! Pronto te contactaremos.');
    }

    /**
     * Procesa y almacena un nuevo mensaje de contacto.
     */
    public function storeContacto(StoreContactoRequest $request)
    {
        $validated = $request->validated();

        Contacto::create([
            'nombre'  => $validated['nombre'],
            'email'   => $validated['email'],
            'mensaje' => $validated['mensaje'],
        ]);

        return back()->with('success', '¡Tu mensaje ha sido enviado correctamente!');
    }
    
    public function instalaciones() {
        return view('pages.instalaciones');
    }
}