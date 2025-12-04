<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function servicios() {
        // 1. Consultamos los servicios de la base de datos
        $servicios = DB::select("SELECT * FROM servicios ORDER BY nombre_servicio ASC");

        // 2. Enviamos la variable $servicios a la vista
        return view('pages.servicios')->with('servicios', $servicios);
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
     * Utiliza StoreReservaRequest para la validación (Controlador Ligero).
     */
    public function storeReserva(StoreReservaRequest $request) {
        // La validación ya fue realizada por StoreReservaRequest
        $validated = $request->validated();

        // Preparamos los datos.
        // Usamos json_encode en 'servicios' para guardar el array como texto JSON en la BD.
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
     * Utiliza StoreContactoRequest para la validación.
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