<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleados;
use App\Models\carreras;

class empleadoscontroller extends Controller
{
 public function inicio(){
  return view('principal');
 }

public function reporteempleados(){
	$empleados = \DB::select("SELECT e.idemp,
       CONCAT(e.nombre,' ',e.apellido) AS nomcompleto
       ,e.correo,c.nombre AS carre,e.rfc
FROM empleados AS e
INNER JOIN carreras AS c ON c.idca = e.idca 
ORDER BY e.nombre ASC");
  return view ('empleados.reporte')
         ->with('empleados',$empleados);
}

 public function altaempleado(){

   $carreras = carreras::where('activo','=','Si')
                         ->orderby('nombre','ASC')
                         ->get();


   return view ('empleados.alta')
          ->with('carreras',$carreras);
 }
 public function guardaempleado(request $request)
 {
      $this->validate($request,[   
			'idemp'=>'required|integer|regex:/^[0-9]{5}$/',
      'nombre'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,ó,ñ,Á,Ó]+$/',
      'apellido'=>'required|regex:/^[A-Z][A-Z,a-z, ,é,ó,ñ,Á,Ó]+$/',
      'edad'=>' required|integer|min:18|max:65',
      'correo'=>'required|email',
      'rfc'=>'required|regex:/^[A-Z]{4}[0-9]{6}[A-Z,0-9]{3}+$/',
        ]);
  
    $empleados = new empleados;
		$empleados->idemp = $request->idemp;
		$empleados->nombre = $request->nombre;
    $empleados->apellido = $request->apellido;
    $empleados->edad = $request->edad;
    $empleados->fechanac = $request->fechanac;
		$empleados->rfc =$request->rfc;
    $empleados->correo= $request->correo;
		$empleados->idca= $request->idca;
		$empleados->sexo=$request->sexo;
		$empleados->curriculum=$request->curriculum;
		$empleados->activo =$request->activo;
    $empleados->save();

        
  echo "Empleado guardado correctamente";
 }

}
