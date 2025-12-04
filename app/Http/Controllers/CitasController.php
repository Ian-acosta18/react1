<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva; // Usamos el modelo correcto
use Session;

class CitasController extends Controller
{
    public function reportecitas(){
        // Usamos Eloquent para obtener las citas ordenadas
        $citas = Reserva::orderBy('fechadeseada', 'DESC')->get();
        return view('citas.reporte')->with('citas', $citas);
    }

    public function altacita(){
        return view('citas.alta');
    }           

    public function guardacita(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|alpha',
            'apaterno' => 'required|alpha',
            'email' => 'required|email',
            'telefono' => 'required|numeric',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        $cita = new Reserva;
        $cita->nombre = $request->nombre;
        $cita->apaterno = $request->apaterno;
        $cita->amaterno = $request->amaterno;
        $cita->correo = $request->email;
        $cita->telefono = $request->telefono;
        $cita->fechadeseada = $request->fecha; // Corregido nombre columna
        $cita->horadeseada = $request->hora;
        $cita->mensajeadd = $request->mensaje; // Corregido nombre columna
        
        // Si tienes campo de servicios en el formulario
        if($request->has('servicios')){
             $cita->servicios = $request->servicios;
        }

        $cita->save();

        Session::flash('mensaje', "La cita para $request->nombre ha sido agendada");
        return redirect()->route('reportecitas');
    }

    public function eliminacita($id){
        $cita = Reserva::find($id);
        if($cita) {
            $cita->delete();
            Session::flash('mensaje', "La cita ha sido eliminada");
        }
        return redirect()->route('reportecitas');
    }

    public function editacita($id){
        $infocita = Reserva::find($id);
        return view('citas.edita')->with('infocita', $infocita);
    }

    public function actualizacita(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'nombre' => 'required|alpha',
            'email' => 'required|email',
        ]);

        $cita = Reserva::find($request->id);
        
        if($cita) {
            $cita->nombre = $request->nombre;
            $cita->apaterno = $request->apaterno;
            $cita->amaterno = $request->amaterno;
            $cita->correo = $request->email;
            $cita->telefono = $request->telefono;
            $cita->fechadeseada = $request->fecha;
            $cita->horadeseada = $request->hora;
            $cita->mensajeadd = $request->mensaje;
            $cita->save();

            Session::flash('mensaje', "La cita de $request->nombre ha sido actualizada");
        }

        return redirect()->route('reportecitas');
    }
}