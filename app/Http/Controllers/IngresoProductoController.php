<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IngresoProductoFormRequest;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Producto;
use App\Proveedor;
use App\Ingreso_producto;
use App\Inventario;
use Auth;
use App\Tipo;
use App\Empresas;

class IngresoProductoController extends Controller
{
    public function index(){
       $ingreso_producto = Ingreso_producto::where('empresa_id', Auth::user()->empresa_id_temp)
                                            ->orderBy('id', 'desc')
                                            ->paginate(5);
       $tipo = Tipo::where('tipo',13)
                    ->orderBy('id', 'asc')
                    ->lists('nombre', 'id');
    	return view('pages.ingreso_producto.index', compact('ingreso_producto', 'tipo'));
    }

    public function create(){
    	 $productos = Producto::where('empresa_id',Auth::user()->empresa_id_temp)
      						->orderBy('id', 'asc')
      						->lists('nombre', 'id');
        $proveedor = Proveedor::where('empresa_id',Auth::user()->empresa_id_temp)
      						->orderBy('id', 'asc')
      						->lists('nombre', 'id');
      	$tipo_ingreso = Tipo::where('tipo', 3)
      						->orderBy('id', 'asc')
      						->lists('nombre', 'nombre');
        $caja_tipo = Tipo::where('tipo', 7)
                  ->orderBy('id', 'asc')
                  ->lists('nombre', 'nombre');
    	return view('pages.ingreso_producto.create', compact('productos', 'proveedor','tipo_ingreso', 'caja_tipo'));
    }

    public function store(IngresoProductoFormRequest $request){

    	
      $inventario = Inventario::where('producto_id',$request->get('producto_id'))->first();
      $producto =  Producto::find($request->get('producto_id'));
      if(((int)$request->get('cantidad') + $inventario->existencia) > $inventario->maximo){
        $message =  'YA LLEGO A LA CANTIDAD MÁXIMA EL PRODUCTO '.$producto->nombre;
        return redirect()->route('ingreso_producto.index')->with('message', $message);
      }
      $data = [
		        'producto_id'   => $request->get('producto_id'), 
            'cantidad'      => $request->get('cantidad'), 
            'caja'          => $request->get('caja'), 
            'fecha_ingreso' => $request->get('fecha_ingreso'), 
            'tipo_ingreso'  => $request->get('tipo_ingreso'),
            'proveedor_id'  => $request->get('proveedor_id'),
            'empresa_id'	=> Auth::user()->empresa_id_temp
    	];

      $total = $producto->precio_utilidad * $request->get('cantidad');
      if(isset($inventario)){
        	if($request->get('tipo_ingreso') == 'ALMACEN'){
        	
        	 $inventario->almacen += (int)$request->get('cantidad');
        	
        	}else{
        	 $inventario->bodega += (int)$request->get('cantidad');
        	}

           $empresa = Empresas::find(Auth::user()->empresa_id_temp);
           if($request->get('caja') == 'CAJA MAYOR'){
              $temp = $empresa->caja_mayor - (float)$total;
              $empresa->caja_mayor = $temp;
           }elseif($request->get('caja') == 'CAJA MENOR'){
              $temp = $empresa->caja_menor - (float)$total;
              $empresa->caja_mayor = $temp;
           }elseif ($request->get('caja') == 'BANCO') {
              $temp = $empresa->banco - (float)$total;
              $empresa->banco = $temp;
           }
          $empresa->save();
          $inventario->existencia += (int)$request->get('cantidad');
        	$inventario->save();
    		  $create = Ingreso_producto::create($data);
    	}else{
    		$message = 'No puede crear un ingreso de producto si no tiene un inventario, por favor asegurese de que exista el inventario para ese producto';
    		return redirect()->route('ingreso_producto.index')->with('message', $message);
    	}

    	$message = $create ? 'Se ha creado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('ingreso_producto.index')->with('message', $message);
    }

    public function show(Ingreso_producto $ingreso_producto){
    	return $ingreso_producto;
    }

    public function edit(Ingreso_producto $ingreso_producto){
    	$productos = Producto::where('empresa_id',Auth::user()->empresa_id_temp)
      						->orderBy('id', 'asc')
      						->lists('nombre', 'id');
        $proveedor = Proveedor::where('empresa_id',Auth::user()->empresa_id_temp)
      						->orderBy('id', 'asc')
      						->lists('nombre', 'id');
      	$tipo_ingreso = Tipo::where('tipo', 3)
      						->orderBy('id', 'asc')
      						->lists('nombre', 'nombre');
        $caja_tipo = Tipo::where('tipo', 7)
                  ->orderBy('id', 'asc')
                  ->lists('nombre', 'nombre');
    	return view('pages.ingreso_producto.edit', compact('productos', 'proveedor','tipo_ingreso', 'ingreso_producto', 'caja_tipo'));
    }

    public function update(IngresoProductoFormRequest $request,Ingreso_producto $ingreso_producto){
        $inventario = Inventario::where('producto_id',$request->get('producto_id'))->first();
        if(isset($inventario)){
        $producto =  Producto::find($request->get('producto_id'));
        $total = $producto->precio_utilidad * $ingreso_producto->cantidad;
        $total2 = $producto->precio_utilidad * $request->cantidad;
        $empresa = Empresas::find(Auth::user()->empresa_id_temp);
        if($ingreso_producto->caja == 'CAJA MAYOR'){
          
          $temp = $empresa->caja_mayor + (float)$total;
          $empresa->caja_mayor = $temp - (float)$total2;

        }elseif($ingreso_producto->caja == 'CAJA MENOR'){

          $temp = $empresa->caja_menor + (float)$total;
          $empresa->caja_menor = $temp - (float)$total2;

        }elseif ($ingreso_producto->caja == 'BANCO') {

           $temp = $empresa->banco + (float)$total;
           $empresa->banco = $temp - (float)$total2;
        } 
        $empresa->save();
        if($request->get('tipo_ingreso') == 'ALMACEN'){
        	 $var = $inventario->almacen - $ingreso_producto->cantidad;
        	 $inventario->almacen = $var + (int)$request->get('cantidad');
        	
        	}else{
        	 $var = $inventario->bodega - $ingreso_producto->cantidad;
        	 $inventario->bodega = $var + (int)$request->get('cantidad');
        	}
        	$var2 = $inventario->existencia - $ingreso_producto->cantidad;
            $inventario->existencia = $var2 + (int)$request->get('cantidad');
        	$inventario->save();
    	}

    	$updated = $ingreso_producto->fill($request->all());
        $ingreso_producto->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        return redirect()->route('ingreso_producto.index')->with('message', $message);
    }

    public function destroy(Ingreso_producto $ingreso_producto){
        $inventario = Inventario::where('producto_id',$ingreso_producto->producto_id)->first();
        if(isset($inventario)){
           $empresa = Empresas::find(Auth::user()->empresa_id_temp);
           $producto =  Producto::find($request->get('producto_id'));
           $total = $producto->precio_utilidad * $ingreso_producto->cantidad;
           if($ingreso_producto->caja == 'CAJA MAYOR'){

              $temp = $empresa->caja_mayor + (float)$total;
              $empresa->caja_mayor = $temp;

           }elseif($ingreso_producto->caja == 'CAJA MENOR'){

              $temp = $empresa->caja_menor + (float)$total;
              $empresa->caja_menor = $temp;

           }elseif ($compras_gastos->caja == 'BANCO') {

               $temp = $empresa->banco + (float)$total;
               $empresa->banco = $temp;
           } 
           $empresa->save();
        	if($ingreso_producto->tipo_ingreso == 'ALMACEN'){
        	 $inventario->almacen -= $ingreso_producto->cantidad;
        	
        	}else{
        	 $inventario->bodega -= $ingreso_producto->cantidad;
        	}
            $inventario->existencia -= $ingreso_producto->cantidad;
        	$inventario->save();
    	}


      $deleted = $ingreso_producto->delete();  
      $message = $deleted ? 'Se ha eliminado correctamente!' : 'NO pudo eliminarse!';
      return redirect()->route('ingreso_producto.index')->with('message', $message);
    }

     public function filtro_ingreso_producto(){
        if(isset($_GET["dato"]) and isset($_GET["tipo"])){
           $dato = htmlspecialchars(input::get("dato")); 
           $tipo = htmlspecialchars(input::get("tipo")); 
     
           if($tipo == 35){
             $ingreso_producto = Ingreso_producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('id', $dato)
                                    ->paginate(5);  
           }else if($tipo == 37){
             $ingreso_producto = Ingreso_producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                      ->where('tipo_ingreso', $dato)
                                      ->get();
           }else if($tipo == 36){
                $producto = Producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                      ->where('nombre', $dato)
                                      ->first();
                if(isset($producto)){                      
                    $ingreso_producto = Ingreso_producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                            ->where('producto_id', $producto->id)
                                            ->paginate(5);  
                }else{
                  $ingreso_producto = Ingreso_producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                                      ->paginate(5);
                  $message =  $dato. ' No se encuentra en el registro!';
                  $tipo  = Tipo::where('tipo',13)->orderBy('id', 'asc')->lists('nombre', 'id');
                  return view('pages.ingreso_producto.index', compact('ingreso_producto', 'message', 'tipo'));
                } 
         }else if($tipo == 38){
                $proveedor = Proveedor::where('empresa_id',  Auth::user()->empresa_id_temp)
                                      ->where('nombre', $dato)
                                      ->first();
          
                if(isset($proveedor)){                      
                    $ingreso_producto = Ingreso_producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                            ->where('categoria_id', $proveedor->id)
                                            ->paginate(5);  
                }else{
                  $ingreso_producto = Ingreso_producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                                      ->paginate(5);
                  $message =  $dato. ' No se encuentra en el registro!';
                  $tipo  = Tipo::where('tipo',13)->orderBy('id', 'asc')->lists('nombre', 'id');
                  return view('pages.ingreso_producto.index', compact('ingreso_producto', 'message', 'tipo'));
                } 
         }

           if(count($ingreso_producto) > 0){
              $message = 'Se encontro correctamente el registro!';
           }else{
              $message = 'No se encontro en los registros!';
           }

        }else{
          $ingreso_producto = Ingreso_producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                                ->paginate(5);  
          $message = 'No se encontro en los registros!';
        }
        $tipo  = Tipo::where('tipo',13)->orderBy('id', 'asc')->lists('nombre', 'id');

        return view('pages.ingreso_producto.index', compact('ingreso_producto', 'message', 'tipo'));

    }
}
