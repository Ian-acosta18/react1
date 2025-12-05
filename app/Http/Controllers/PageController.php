<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Contacto;
use App\Models\Productos;

class PageController extends Controller
{
    public function inicio() {
        return view('pages.inicio');
    }

    // --- CORRECCIÓN 1: Lógica de Servicios ---
    public function servicios() {
        // Usamos Eloquent para traer categorías CON sus servicios.
        // Esto permite iterar en la vista: @foreach($categorias as $cat) ...
        $categorias = Categoria::with('servicios')->get();

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

    // --- CORRECCIÓN 2: Validación Directa (Reserva) ---
    public function storeReserva(Request $request) {
        // Validamos aquí mismo para no depender de archivos externos que faltan
        $validated = $request->validate([
            'nombres'          => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'correo'           => 'required|email',
            'telefono'         => 'required|string',
            'servicios'        => 'required|array',
            'fecha'            => 'required|date',
            'hora'             => 'required',
            'mensaje'          => 'nullable|string',
        ]);

        $reservaData = [
            'nombre'       => $validated['nombres'],
            'apaterno'     => $validated['apellido_paterno'],
            'amaterno'     => $validated['apellido_materno'],
            'correo'       => $validated['correo'],
            'telefono'     => $validated['telefono'],
            // Convertimos el array de servicios a JSON para guardarlo
            'servicios'    => json_encode($validated['servicios']),
            'fechadeseada' => $validated['fecha'],
            'horadeseada'  => $validated['hora'],
            'mensaje'      => $validated['mensaje'] ?? null,
        ];

        Reserva::create($reservaData);

        return back()->with('success', '¡Tu reserva ha sido creada exitosamente! Pronto te contactaremos.');
    }

    // --- CORRECCIÓN 3: Validación Directa (Contacto) ---
    public function storeContacto(Request $request)
    {
        $validated = $request->validate([
            'nombre'  => 'required|string|max:255',
            'email'   => 'required|email',
            'mensaje' => 'required|string',
        ]);

        Contacto::create([
            'nombre'  => $validated['nombre'],
            'email'   => $validated['email'],
            'mensaje' => $validated['mensaje'],
        ]);

        return back()->with('success', '¡Tu mensaje ha sido enviado correctamente!');
    }

    public function instalaciones() {
        // Asegúrate de que el nombre del archivo en 'resources/views/pages' 
        // sea exactamente 'Instalaciones.blade.php' (con I mayúscula) o cámbialo aquí.
        // Si tu archivo es minúscula, usa 'pages.instalaciones'.
        return view('pages.Instalaciones'); 
    }
}