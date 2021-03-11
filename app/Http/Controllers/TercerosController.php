<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TercerosFormRequest;
use Illuminate\Support\Facades\Input;
use App\Terceros;
use Auth;
use App\Tipo;

class TercerosController extends Controller
{
    public function index(){
       $terceros = Terceros::where('empresa_id', Auth::user()->empresa_id_temp)->paginate(5);
       $tipo = Tipo::where('tipo',14)
                    ->where('id', '!=', 41)
                    ->orderBy('id', 'asc')
                    ->lists('nombre', 'id');
    	return view('pages.terceros.index',compact('terceros', 'tipo'));

    }

     public function create(){
      return view('pages.terceros.create');
    }

    public function store(TercerosFormRequest $request){
    	 $data = [
            'nombre'        		=> $request->get('nombre'),
            'celular'      			=> $request->get('celular'),
            'direccion'				=> $request->get('direccion'),
            'empresa_id'		    => Auth::user()->empresa_id_temp
        ];

        $terceros = Terceros::create($data);

        $message = $terceros ? 'Se ha crado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('terceros.index')->with('message', $message);
    }

      public function show(terceros $terceros)
    {
        return $terceros;
    }

  
    public function edit(Terceros $terceros)
    {
        return view('pages.terceros.edit', compact('terceros'));
    }

  
    public function update(TercerosFormRequest $request, Terceros $terceros)
    {
   
        $updated = $terceros->fill($request->all());
        $terceros->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        
        return redirect()->route('terceros.index')->with('message', $message);
    }

    public function destroy(Terceros $terceros){
      $deleted = $terceros->delete();  
      $message = $deleted ? 'Tercero eliminado correctamente!' : 'El tercero NO pudo eliminarse!';
      return redirect()->route('terceros.index')->with('message', $message);
    }

    public function filtro_terceros(){

        if(isset($_GET["dato"]) and isset($_GET["tipo"])){

           $dato = htmlspecialchars(input::get("dato")); 
           $tipo = htmlspecialchars(input::get("tipo")); 
           if($tipo == 39){
             $terceros = Terceros::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('id', $dato)
                                    ->paginate(5);  
           }else if($tipo == 40){
             $terceros = Terceros::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('nombre', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }else if($tipo == 42){
             $terceros = Terceros::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('celular', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }

           if(count($terceros) > 0){
              $message = 'Se encontro correctamente el registro!';
           }else{
              $message = 'No se encontro en los registros!';
           }

        }else{
          $terceros = Terceros::where('empresa_id',  Auth::user()->empresa_id_temp)->paginate(5);  
          $message = 'No se encontro en los registros!';
        }
        $tipo  = Tipo::where('tipo',14)->where('id', '!=', 41)->orderBy('id', 'asc')->lists('nombre', 'id');

        return view('pages.terceros.index', compact('terceros', 'message', 'tipo'));

  }

}
