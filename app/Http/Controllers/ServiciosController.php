<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;   
use App\Models\Categoria;  
use Session;

class ServiciosController extends Controller
{
    public function reporteservicios(){
        // Eloquent hace el JOIN automáticamente con 'with'
        $servicios = Servicio::with('categoria')->orderBy('nombre_servicio', 'ASC')->get();
        return view ('servicios.reporte')->with('servicios', $servicios);
    }

    public function altaservicio(){
        $categorias = Categoria::orderBy('nombre_categoria','ASC')->get();
        // En Eloquent no necesitamos calcular el ID siguiente manualmente, es auto-incremental
        return view ('servicios.alta')->with('categorias', $categorias);
    }           

    public function guardaservicio(Request $request)
    {
        $this->validate($request, [
            'nombre_servicio' => 'required|regex:/^[A-Z,a-z, ,0-9]+$/', 
            'precio' => 'required|numeric|min:0',
            'id_categoria' => 'required|integer' // Este viene del <select name="id_categoria"> de la vista
        ]);

        $servicio = new Servicio;
        // Nota: id se genera solo
        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->precio = $request->precio;
        $servicio->categoria_id = $request->id_categoria; // Mapeamos input vista -> columna BD
        $servicio->save();

        Session::flash('mensaje', "El servicio $request->nombre_servicio ha sido creado");
        return redirect()->route('reporteservicios');
    }

    public function eliminaservicio(Request $request){
        // Asumiendo que recibes el id del servicio a eliminar
        $servicio = Servicio::find($request->id_servicio);
        if($servicio) {
            $servicio->delete();
            Session::flash('mensaje', "El servicio ha sido eliminado");
        }
        return redirect()->route('reporteservicios');
    }

    public function editaservicio(Request $request){
        $infoservicio = Servicio::find($request->id_servicio);
        $categorias = Categoria::orderBy('nombre_categoria','ASC')->get();

        return view ('servicios.edita')
            ->with('categorias', $categorias)
            ->with('infoservicio', $infoservicio);
    }

    public function actualizaservicio(Request $request)
    {
        $this->validate($request, [
            'id_servicio' => 'required|integer',
            'nombre_servicio' => 'required|regex:/^[A-Z,a-z, ,0-9]+$/',
            'precio' => 'required|numeric|min:0',
            'id_categoria' => 'required|integer'
        ]);

        $servicio = Servicio::find($request->id_servicio);
        $servicio->nombre_servicio = $request->nombre_servicio;
        $servicio->precio = $request->precio;
        $servicio->categoria_id = $request->id_categoria;
        $servicio->save();

        Session::flash('mensaje', "El servicio ha sido actualizado");
        return redirect()->route('reporteservicios');
    }
}