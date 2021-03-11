<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteFormRequest;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Clientes_id;
use Auth;
use App\Tipo;

class ControllerClientes extends Controller
{
      public function index()
    {
       $clientes = Clientes_id::where('empresa_id',Auth::user()->empresa_id_temp)->paginate(5);
       $tipo = Tipo::where('tipo',14)
                    ->orderBy('id', 'asc')
                    ->lists('nombre', 'id');
       return view('pages.clientes.index', compact('clientes', 'tipo'));
    }


    public function create(){
      return view('pages.clientes.create');
    }

    public function store(ClienteFormRequest $request){
    	 $data = [
            'nombre'        		=> $request->get('nombre'),
            'tel'      		        => $request->get('tel'),
            'direccion'				=> $request->get('direccion'),
            'cedula' 		        => $request->get('cedula'),
            'empresa_id'		    => Auth::user()->empresa_id_temp
        ];

        $clientes = Clientes_id::create($data);

        $message = $clientes ? 'Se ha crado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('clientes.index')->with('message', $message);
    }

      public function show(Clientes_id $clientes)
    {
        return $clientes;
    }

  
    public function edit(Clientes_id $clientes)
    {
        return view('pages.clientes.edit', compact('clientes'));
    }

  
    public function update(ClienteFormRequest $request, Clientes_id $clientes)
    {
   
        $updated = $clientes->fill($request->all());
        $clientes->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        return redirect()->route('clientes.index')->with('message', $message);
    }

    public function destroy(Clientes_id $clientes){
       
        $deleted = $clientes->delete();
            
        $message = $deleted ? 'Categoría eliminada correctamente!' : 'La Categoría NO pudo eliminarse!';
            
        return redirect()->route('clientes.index')->with('message', $message);
    }

    public function filtro_clientes(){

        if(isset($_GET["dato"]) and isset($_GET["tipo"])){

           $dato = htmlspecialchars(input::get("dato")); 
           $tipo = htmlspecialchars(input::get("tipo")); 
           if($tipo == 39){
             $clientes = Clientes_id::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('id', $dato)
                                    ->paginate(5);  
           }else if($tipo == 40){
             $clientes = Clientes_id::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('nombre', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }else if($tipo == 41){
             $clientes = Clientes_id::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('cedula', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }else if($tipo == 42){
             $clientes = Clientes_id::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('tel', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }

           if(count($clientes) > 0){
              $message = 'Se encontro correctamente el registro!';
           }else{
              $message = 'No se encontro en los registros!';
           }

        }else{
          $clientes = Clientes_id::where('empresa_id',  Auth::user()->empresa_id_temp)->paginate(5);  
          $message = 'No se encontro en los registros!';
        }
        $tipo  = Tipo::where('tipo',14)->orderBy('id', 'asc')->lists('nombre', 'id');

        return view('pages.clientes.index', compact('clientes', 'message', 'tipo'));

  }

}
