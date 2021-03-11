<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ProveedorFormRequest;
use Illuminate\Support\Facades\Input;
use App\Proveedor;
use Auth;
use App\Tipo;

class ProveedorController extends Controller
{
    public function index()
    {
       $proveedor = Proveedor::where('empresa_id',Auth::user()->empresa_id_temp)->paginate(5);
       $tipo = Tipo::where('tipo',14)
                    ->where('id', '!=', 41)
                    ->orderBy('id', 'asc')
                    ->lists('nombre', 'id');
       return view('pages.proveedor.index', compact('proveedor','tipo'));
    }


    public function create(){
      return view('pages.proveedor.create');
    }

    public function store(ProveedorFormRequest $request){
    	 $data = [
            'nombre'        		=> $request->get('nombre'),
            'celular'      		    => $request->get('celular'),
            'direccion'				=> $request->get('direccion'),
            'cedula' 		        => $request->get('cedula'),
            'email' 		        => $request->get('email'),
            'empresa_id'		    => Auth::user()->empresa_id_temp
        ];

        $proveedor = Proveedor::create($data);

        $message = $proveedor ? 'Se ha crado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('proveedor.index')->with('message', $message);
    }

      public function show(Proveedor $proveedor)
    {
        return $proveedor;
    }

  
    public function edit(Proveedor $proveedor)
    {
        return view('pages.proveedor.edit', compact('proveedor'));
    }

  
    public function update(ProveedorFormRequest $request, Proveedor $proveedor)
    {
   
        $updated = $proveedor->fill($request->all());
        $proveedor->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        
        return redirect()->route('proveedor.index')->with('message', $message);
    }

    public function destroy(Proveedor $proveedor){
      $deleted = $proveedor->delete();  
      $message = $deleted ? 'Proveedor eliminada correctamente!' : 'El proveedor NO pudo eliminarse!';
      return redirect()->route('proveedor.index')->with('message', $message);
    }

    public function filtro_proveedor(){

        if(isset($_GET["dato"]) and isset($_GET["tipo"])){

           $dato = htmlspecialchars(input::get("dato")); 
           $tipo = htmlspecialchars(input::get("tipo")); 
           if($tipo == 39){
             $proveedor = Proveedor::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('id', $dato)
                                    ->paginate(5);  
           }else if($tipo == 40){
             $proveedor = Proveedor::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('nombre', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }else if($tipo == 41){
             $proveedor = Proveedor::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('cedula', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }else if($tipo == 42){
             $proveedor = Proveedor::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('celular', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }

           if(count($proveedor) > 0){
              $message = 'Se encontro correctamente el registro!';
           }else{
              $message = 'No se encontro en los registros!';
           }

        }else{
          $proveedor = Proveedor::where('empresa_id',  Auth::user()->empresa_id_temp)->paginate(5);  
          $message = 'No se encontro en los registros!';
        }
        $tipo  = Tipo::where('tipo',14)->where('id', '!=', 41)->orderBy('id', 'asc')->lists('nombre', 'id');

        return view('pages.proveedor.index', compact('proveedor', 'message', 'tipo'));

  }
}
