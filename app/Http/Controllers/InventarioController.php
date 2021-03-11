<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\InventarioFormRequest;
use Illuminate\Support\Facades\Input;
use App\Inventario;
use Auth;
use App\Empresa;
use App\Producto;
use App\Tipo;

class InventarioController extends Controller
{
   
    public function index()
    {
       $inventario = Inventario::where('empresa_id',Auth::user()->empresa_id_temp)->paginate(5);
       $tipo  = Tipo::where('tipo',15)->orderBy('id', 'asc')->lists('nombre', 'id');
       return view('pages.inventario.index', compact('inventario', 'tipo'));
    }


    public function create(){
      $productos = Producto::where('empresa_id',Auth::user()->empresa_id_temp)
      						->orderBy('id', 'asc')
      						->lists('nombre', 'id');      
      return view('pages.inventario.create', compact('productos'));
    }

    public function store(InventarioFormRequest $request){

        $this->validate($request,[
          'producto_id' => 'required|unique:inventario'
        ]);

    	 $data = [
            'codigo'        		=> $request->get('codigo'),
            'producto_id'      	=> $request->get('producto_id'),
            'existencia'		    => $request->get('bodega') + $request->get('almacen'),
            'minimo'		        => $request->get('minimo'),
            'maximo'		        => $request->get('maximo'),
            'almacen'           => $request->get('almacen'),
            'bodega'            => $request->get('bodega'),
            'empresa_id'		    => Auth::user()->empresa_id_temp
        ];

        $inventario = Inventario::create($data);

        $message = $inventario ? 'Se ha crado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('inventario.index')->with('message', $message);
    }

      public function show(Inventario $inventario)
    {
        return $inventario;
    }

  
    public function edit(Inventario $inventario)
    {
    	$productos = Producto::where('empresa_id',Auth::user()->empresa_id_temp)
      						->orderBy('id', 'asc')
      						->lists('nombre', 'id');   
        return view('pages.inventario.edit', compact('inventario','productos'));
    }

  
    public function update(InventarioFormRequest $request, Inventario $inventario)
    {
        
        $updated = $inventario->fill($request->all());
        $inventario->existencia = $inventario->almacen + $inventario->bodega;
        $inventario->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        return redirect()->route('inventario.index')->with('message', $message);
    }

    public function destroy(Inventario $inventario){
      $deleted = $inventario->delete();  
      $message = $deleted ? 'Producto eliminada correctamente!' : 'El producto NO pudo eliminarse!';
      return redirect()->route('inventario.index')->with('message', $message);
    }

    public function filtro_inventario(){
        if(isset($_GET["dato"]) and isset($_GET["tipo"])){
           $dato = htmlspecialchars(input::get("dato")); 
           $tipo = htmlspecialchars(input::get("tipo")); 
           if($tipo == 43){
               $inventario = Inventario::where('empresa_id',  Auth::user()->empresa_id_temp)
                                      ->where('codigo', $dato)
                                      ->paginate(5);  
          }else if($tipo == 44){
                $producto = Producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                      ->where('nombre', $dato)
                                      ->first();
          
                if(isset($producto)){                      
                    $inventario = Inventario::where('empresa_id',  Auth::user()->empresa_id_temp)
                                            ->where('producto_id', $producto->id)
                                            ->paginate(5);  
                }else{

                  $inventario = Inventario::where('empresa_id',  Auth::user()->empresa_id_temp)->paginate(5);
                  $message =  'El producto '.$dato. ' No se encuentra en el registro!';
                  $tipo  = Tipo::where('tipo',15)->orderBy('id', 'asc')->lists('nombre', 'id');
                  return view('pages.inventario.index', compact('inventario', 'message', 'tipo'));

                }
             }
             
             if(count($inventario) > 0){
                $message = 'Se encontro correctamente el registro!';
             }else{
                $message = 'No se encontro en los registros!';
             }

      }else{
          $inventario = Inventario::where('empresa_id',  Auth::user()->empresa_id_temp)->paginate(5);  
          $message = 'No se encontro en los registros!';
      }
      $tipo  = Tipo::where('tipo',15)->orderBy('id', 'asc')->lists('nombre', 'id');

      return view('pages.inventario.index', compact('inventario', 'message', 'tipo'));

  }

    
}
