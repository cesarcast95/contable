<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Requests\TrabajadorFormRequest;
use App\Trabajadores;
use Auth;
use App\Tipo;

class ControllerTrabajadores extends Controller
{
    public function index()
    {
       $trabajadores = Trabajadores::where('empresa_id',Auth::user()->empresa_id_temp)->paginate(5);
       $tipo = Tipo::where('tipo',14)
                    ->orderBy('id', 'asc')
                    ->lists('nombre', 'id');
       return view('pages.trabajadores.index', compact('trabajadores','tipo'));
    }


    public function create(){
      return view('pages.trabajadores.create');
    }

    public function store(TrabajadorFormRequest $request){
    	 $data = [
            'nombre'        		=> $request->get('nombre'),
            'telefono'      		=> $request->get('telefono'),
            'direccion'				=> $request->get('direccion'),
            'cedula' 		        => $request->get('cedula'),
            'empresa_id'		    => Auth::user()->empresa_id_temp
        ];

        $trabajadores = Trabajadores::create($data);

        $message = $trabajadores ? 'Se ha crado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('trabajadores.index')->with('message', $message);
    }

      public function show(Trabajadores $trabajadores)
    {
        return $trabajadores;
    }

  
    public function edit(Trabajadores $trabajadores)
    {
        return view('pages.trabajadores.edit', compact('trabajadores'));
    }

  
    public function update(TrabajadorFormRequest $request, Trabajadores $trabajadores)
    {
   
        $updated = $trabajadores->fill($request->all());
        $trabajadores->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        
        return redirect()->route('trabajadores.index')->with('message', $message);
    }

    public function destroy(Trabajadores $trabajadores){
      $deleted = $trabajadores->delete();  
      $message = $deleted ? 'Trabajador eliminada correctamente!' : 'El trabajador NO pudo eliminarse!';
      return redirect()->route('trabajadores.index')->with('message', $message);
    }

     public function filtro_trabajadores(){

        if(isset($_GET["dato"]) and isset($_GET["tipo"])){

           $dato = htmlspecialchars(input::get("dato")); 
           $tipo = htmlspecialchars(input::get("tipo")); 
           if($tipo == 39){
             $trabajadores = Trabajadores::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('id', $dato)
                                    ->paginate(5);  
           }else if($tipo == 40){
             $trabajadores = Trabajadores::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('nombre', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }else if($tipo == 41){
             $trabajadores = Trabajadores::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('cedula', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }else if($tipo == 42){
             $trabajadores = Trabajadores::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('telefono', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }

           if(count($trabajadores) > 0){
              $message = 'Se encontro correctamente el registro!';
           }else{
              $message = 'No se encontro en los registros!';
           }

        }else{
          $trabajadores = Trabajadores::where('empresa_id',  Auth::user()->empresa_id_temp)->paginate(5);  
          $message = 'No se encontro en los registros!';
        }
        $tipo  = Tipo::where('tipo',14)->orderBy('id', 'asc')->lists('nombre', 'id');

        return view('pages.trabajadores.index', compact('trabajadores', 'message', 'tipo'));

  }
}
