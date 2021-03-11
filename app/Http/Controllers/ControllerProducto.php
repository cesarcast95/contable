<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ProductoFormRequest;
use Illuminate\Support\Facades\Input;
use App\Producto;
use Auth;
use App\Categoria;
use PhpParser\Node\Stmt\If_;
use App\Tipo;


class ControllerProducto extends Controller
{
      public function index()
    {
       $productos = Producto::where('empresa_id',Auth::user()->empresa_id_temp)->paginate(5);
       $tipo = Tipo::where('tipo',12)
                    ->orderBy('id', 'asc')
                    ->lists('nombre', 'id');
       return view('pages.productos.index', compact('productos','tipo'));
    }


    public function create(){
      $categoria = Categoria::where('empresa_id',Auth::user()->empresa_id_temp)
                              ->orderBy('id', 'asc')
                              ->lists('nombre', 'id');
      return view('pages.productos.create', compact('categoria'));
    }


    public function store(ProductoFormRequest $request){

       $this->validate($request,[
          'nombre' => 'required|unique:productos|max:255',
          'cod' => 'required|unique:productos|max:255'
        ]);
       
       $descuento = (float)$request->get('descuento');
       $promocion = (float)$request->get('promocion');
       if($request->get('ganancia_activada') == 'on' || $request->get('ganancia_activada') == '1'){
          $ganancia_activada = true;
          $valor_producto_ganancia = (float)$request->get('precio_utilidad') * (float)($request->get('porcentaje_ganancia')/100); 
          $valor_producto = (float)$request->get('precio_utilidad') + $valor_producto_ganancia + (((float)$request->get('precio_utilidad') + $valor_producto_ganancia)*(float)($request->get('impuesto')/100)); 
       }else{
          $ganancia_activada = false;
          $valor_producto = (float)$request->get('precio_utilidad')* ((float)$request->get('precio_utilidad')*(float)($request->get('impuesto')/100));
       }
        if($request->get('descuento_activado') == 'on' || $request->get('descuento_activado') == '1'){
          $descuento_activado = true;       
       }else{
          $descuento_activado = false;
   
       }

       if($request->get('promocion_activada') == 'on' || $request->get('promocion_activada') == '1'){
          $promocion_activada = true;       
       }else{
          $promocion_activada = false;
   
       }
       
    	 $data = [
            'nombre'        		    => $request->get('nombre'),
            'valor'      		        => $valor_producto,
            'cod'				            => $request->get('cod'),
            'empresa_id'		        => Auth::user()->empresa_id_temp,
            'precio_utilidad'       => $request->get('precio_utilidad'),
            'ganancia_activada'     => $ganancia_activada,
            'porcentaje_ganancia'   => $request->get('porcentaje_ganancia'),
            'categoria_id'          => $request->get('categoria_id'),
            'descripcion'           => $request->get('descripcion'),
            'descuento_activado'    => $descuento_activado,
            'descuento'             => $descuento,
            'promocion_activada'    => $promocion_activada,
            'impuesto'              => $request->impuesto,
            'promocion'             => $promocion,
        ];

        $productos = Producto::create($data);

        $message = $productos ? 'Se ha crado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('productos.index')->with('message', $message);
    }

      public function show(Producto $productos)
    {
        return $productos;
    }

  
    public function edit(Producto $productos)
    {
        $categoria = Categoria::where('empresa_id',Auth::user()->empresa_id_temp)
                              ->orderBy('id', 'asc')
                              ->lists('nombre', 'id');
        return view('pages.productos.edit', compact('productos', 'categoria'));
    }


    public function update(ProductoFormRequest $request, Producto $productos)
    {

          if($request->get('ganancia_activada') == '1' || $request->get('ganancia_activada') == 'on'){
            $ganancia_activada = true;
            $valor_producto_ganancia = (float)$request->get('precio_utilidad') * (float)($request->get('porcentaje_ganancia')/100); 
            $valor_producto = (float)$request->get('precio_utilidad') + $valor_producto_ganancia; 
         }else{
            $ganancia_activada = false;
            $valor_producto = (float)$request->get('precio_utilidad');
         }
         
         if($request->get('descuento_activado') == '1' || $request->get('descuento_activado') == 'on'){
          $descuento_activado = true;    
         }else{
            $descuento_activado = false;
     
         }

         if($request->get('promocion_activada') == '1' || $request->get('promocion_activada') == 'on'){
            $promocion_activada = true;       
         }else{
            $promocion_activada = false;
     
         }

        $updated = $productos->fill($request->all());
        $productos->ganancia_activada  = $ganancia_activada;
        $productos->descuento_activado = $descuento_activado;
        $productos->promocion_activada = $promocion_activada;
        $productos->valor = $valor_producto;
        $productos->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        return redirect()->route('productos.index')->with('message', $message);
    }

    public function destroy(Producto $productos){
      $deleted = $productos->delete();  
      $message = $deleted ? 'Producto eliminada correctamente!' : 'El producto NO pudo eliminarse!';
      return redirect()->route('productos.index')->with('message', $message);
    }


    public function postCompleteGanancia(Request $request)
    {
      //  Checkbox para ganancia
      if ($request->ajax()) {
         if ($request->input('estado') == 1) {
            $productos = Producto::find($request->input('ganancia_attr'));
            $productos->ganancia_activada = $request->input('estado');
            $productos->save();
            return response()->json(['respuesta' => 'La ganancia se activó correctamente']);
         } else {
            $productos = Producto::find($request->input('ganancia_attr'));
            $productos->ganancia_activada = $request->input('estado');
            $productos->save();
            return response()->json(['respuesta' => 'La ganancia se desactivó correctamente']);
         }
         
      } else {
         abort(404);
      }
      
    }
    public function postCompleteDescuento(Request $request)
    {
          //  Checkbox para descuento
          if ($request->ajax()) {
            if ($request->input('estado') == 1) {
               $productos = Producto::find($request->input('descuento_attr'));
               $productos->descuento_activado = $request->input('estado');
               $productos->save();
               return response()->json(['respuesta' => 'El descuento se activó correctamente']);
            } else {
               $productos = Producto::find($request->input('descuento_attr'));
               $productos->descuento_activado = $request->input('estado');
               $productos->save();
               return response()->json(['respuesta' => 'El descuento se desactivó correctamente']);
            }
            
         } else {
            abort(404);
         }
      }


      public function postCompletePromocion(Request $request)
      {
            //  Checkbox para promoción
            if ($request->ajax()) {
              if ($request->input('estado') == 1) {
                 $productos = Producto::find($request->input('promocion_attr'));
                 $productos->promocion_activada = $request->input('estado');
                 $productos->save();
                 return response()->json(['respuesta' => 'La promoción se activó correctamente']);
              } else {
                 $productos = Producto::find($request->input('promocion_attr'));
                 $productos->promocion_activada = $request->input('estado');
                 $productos->save();
                 return response()->json(['respuesta' => 'La promoción se desactivó correctamente']);
              }
              
           } else {
              abort(404);
           }
        }

    public function filtro_producto(){
        if(isset($_GET["dato"]) and isset($_GET["tipo"])){
           $dato = htmlspecialchars(input::get("dato")); 
           $tipo = htmlspecialchars(input::get("tipo")); 
     
           if($tipo == 32){
             $productos = Producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('cod', $dato)
                                    ->paginate(5);  
           }else if($tipo == 33){
             $productos = Producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('nombre', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }else if($tipo == 34){
                $categoria = Categoria::where('empresa_id',  Auth::user()->empresa_id_temp)
                                      ->where('nombre', $dato)
                                      ->first();
          
                if(isset($categoria)){                      
                    $productos = Producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                                            ->where('categoria_id', $categoria->id)
                                            ->paginate(5);  
                }else{
                  $productos = Producto::where('empresa_id',  Auth::user()->empresa_id_temp)->paginate(5);
                  $message =  'El producto '.$dato. ' No se encuentra en el registro!';
                  $tipo  = Tipo::where('tipo',12)->orderBy('id', 'asc')->lists('nombre', 'id');
                  return view('pages.productos.index', compact('productos', 'message', 'tipo'));
                } 
           }

           if(count($productos) > 0){
              $message = 'Se encontro correctamente el registro!';
           }else{
              $message = 'No se encontro en los registros!';
           }

        }else{
          $productos = Producto::where('empresa_id',  Auth::user()->empresa_id_temp)->paginate(5);  
          $message = 'No se encontro en los registros!';
        }
        $tipo  = Tipo::where('tipo',12)->orderBy('id', 'asc')->lists('nombre', 'id');

        return view('pages.productos.index', compact('productos', 'message', 'tipo'));

  }

}
