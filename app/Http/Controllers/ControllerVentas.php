<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\VentaFormRequest;
use App\Ventas;
use App\Inventario;
use App\Clientes_id;
use App\Producto;
use App\Tipo;
use Auth;
use App\Empresas;
use App\Consecutivo;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Input;

class ControllerVentas extends Controller
{
      public function index()
    {
       $ventas = Ventas::where('empresa_id',Auth::user()->empresa_id_temp)->get();
       return view('pages.ventas.index', compact('ventas'));
    }


    public function create(){
      $transaccion = Tipo::where('tipo', 2)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $estado = Tipo::where('tipo', 3)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $caja = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $cliente = Clientes_id::where('empresa_id', Auth::user()->empresa_id_temp)
      						->orderBy('id', 'asc')
      						->lists('cedula', 'id');
      $producto = Producto::where('empresa_id', Auth::user()->empresa_id_temp)
      				->orderBy('id', 'asc')
      				->lists('cod', 'id');
      $fecha = Date::now()->sub('5 hour');
      $consecutivo =  Consecutivo::orderBy('id', 'desc')->first();
      $dato =  $consecutivo->numero + 1;
      $data = ['numero' => $dato];
      $create =  Consecutivo::create($data);

      return view('pages.ventas.create', compact('cliente','producto','transaccion','estado', 'caja', 'fecha', 'consecutivo'));
    }

    public function store(VentaFormRequest $request){

       $producto = Producto::find($request->get('producto_id'));
       $inventario = Inventario::where('producto_id', $request->get('producto_id'))->first();
       $message = '';
       $empresa = Empresas::find(Auth::user()->empresa_id_temp);
       if($producto->descuento_activado == 1){
          $total =  (float)$producto->descuento * $request->get('cantidad');
          $total = $total + ($total*($producto->impuesto/100));
       }else if($producto->promocion_activada == 1){  
          $total =  (float)$producto->descuento * $request->get('cantidad');
          $total = $total + ($total*($producto->impuesto/100));
       }else if($producto->ganancia_activada == 1){
           $total =  ((float)$producto->valor)* $request->get('cantidad');
       }else{
          $total =  (float)$producto->precio_utilidad * $request->get('cantidad');
          $total = $total + ($total*($producto->impuesto/100));
       }

       $venta_producto = Ventas::where('producto_id', $request->get('producto_id')) 
                          ->where('consecutivo', $request->get('consecutivo'))
                          ->first();
       
       $transaccion = $request->get('tipo_transaccion_id');
       $estado = $request->get('tipo_estado_id');
       $caja = $request->get('caja_tipo');
       $cliente = Clientes_id::find($request->get('cliente_id'));
       $consecutivo = $request->get('consecutivo');
       $producto = Producto::where('empresa_id', Auth::user()->empresa_id_temp)
                           ->orderBy('id', 'asc')
                           ->lists('cod', 'id');
       $fecha = $request->get('fecha_elaboracion');
       $factura =  Ventas::where('empresa_id', Auth::user()->empresa_id_temp) 
                          ->where('consecutivo', $request->get('consecutivo'))
                          ->get();
      
       if($inventario->existencia <= 0){
     
        $message = 'ESTE PRODUCTO SE ENCUENTRA AGOTADO';
        return view('pages.ventas.factura', compact('cliente','producto','transaccion','estado', 'caja', 'fecha', 'consecutivo', 'factura', 'message'));
       }

        if($inventario->existencia < $request->get('cantidad')){
     
        $message = 'NO SE ENCUENTRA LA CANTIDAD DE PRODUCTOS SOLICITADOS';
        return view('pages.ventas.factura', compact('cliente','producto','transaccion','estado', 'caja', 'fecha', 'consecutivo', 'factura', 'message'));
       }

        if($request->get('cantidad') <= 0){
     
        $message = 'DEBES INGRESAR LA CANTIDAD DE LA VENTA';
        return view('pages.ventas.factura', compact('cliente','producto','transaccion','estado', 'caja', 'fecha', 'consecutivo', 'factura', 'message'));
       }


      
       if(!isset($venta_producto)){
      	 $data = [
              'tipo_transaccion_id' => $request->get('tipo_transaccion_id'),
              'tipo_estado_id'		  => $request->get('tipo_estado_id'),
              'fecha_elaboracion'		=> $request->get('fecha_elaboracion'),
              'cantidad'		        => $request->get('cantidad'),
              'cliente_id'		      => $request->get('cliente_id'),
              'producto_id'		      => $request->get('producto_id'),
              'caja_tipo'           => $request->get('caja_tipo'),
              'activo'              => 0,
              'consecutivo'         => $request->get('consecutivo'),
              'cajero'              => Auth::user()->name,
              'total'		            => $total,
              'empresa_id'		      => Auth::user()->empresa_id_temp
        ];

        $ventas = Ventas::create($data);
      }else{
         $venta_producto->cantidad += (int)$request->get('cantidad');
         $venta_producto->total += $total;
         $venta_producto->save();
      }
     $factura =  Ventas::where('empresa_id', Auth::user()->empresa_id_temp) 
                          ->where('consecutivo', $request->get('consecutivo'))
                          ->get();
      return view('pages.ventas.factura', compact('cliente','producto','transaccion','estado', 'caja', 'fecha', 'consecutivo', 'factura', 'message'));
    }

      public function show(Ventas $ventas)
    {
        return $ventas;
    }

    public function edit(Ventas $ventas)
    {
      $tipo = Tipo::where('tipo', 2)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tipo2 = Tipo::where('tipo', 3)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $caja = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');


      $cliente = Clientes_id::where('empresa_id', Auth::user()->empresa_id_temp)
      						->orderBy('id', 'asc')
      						->lists('nombre', 'id');
      $producto = Producto::where('empresa_id', Auth::user()->empresa_id_temp)
      				->orderBy('id', 'asc')
      				->lists('nombre', 'id');
        return view('pages.ventas.edit', compact('ventas','cliente','producto','tipo','tipo2', 'caja'));
    }

  
    public function update(VentaFormRequest $request, Ventas $ventas)
    {
   
        $updated = $ventas->fill($request->all());
        $producto = Producto::find($ventas->producto_id);
        $total =  (int)$producto->valor * $request->get('cantidad');
        $empresa = Empresas::find(Auth::user()->empresa_id_temp);


        if($ventas->caja_tipo == "CAJA MAYOR"){
            $temp = $empresa->caja_mayor - $ventas->total; 
            $empresa->caja_mayor = $temp;
            $empresa->caja_mayor += $total;
        }elseif($ventas->caja_tipo == "CAJA MENOR"){
            $temp = $empresa->caja_menor - $ventas->total; 
            $empresa->caja_menor = $temp;
            $empresa->caja_menor += $total;

        }elseif ($ventas->caja_tipo == "BANCO") {
            $temp = $empresa->caja_menor - $ventas->total; 
            $empresa->caja_menor = $temp;
            $empresa->banco += $total;
        }
        $ventas->total = $total; 
        $ventas->save();
        $empresa->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        return redirect()->route('ventas.index')->with('message', $message);
    }

    public function destroy(Ventas $ventas){

     /* $empresa = Empresas::find(Auth::user()->empresa_id_temp);
      if($ventas->caja_tipo == "CAJA MAYOR"){
            $temp = $empresa->caja_mayor - $ventas->total; 
            $empresa->caja_mayor = $temp;

        }elseif($ventas->caja_tipo == "CAJA MENOR"){
            $temp = $empresa->caja_menor - $ventas->total; 
            $empresa->caja_menor = $temp;

        }elseif ($ventas->caja_tipo == "BANCO") {
            $temp = $empresa->caja_menor - $ventas->total; 
            $empresa->caja_menor = $temp;

        }*/
       $deleted = $ventas->delete();  
       $factura =  Ventas::where('empresa_id', Auth::user()->empresa_id_temp) 
                          ->where('consecutivo', $ventas->consecutivo)
                          ->get();
       $transaccion = $ventas->tipo_transaccion_id;
       $estado = $ventas->tipo_estado_id;
       $caja = $ventas->caja_tipo;
       $cliente = Clientes_id::find($ventas->cliente_id);
       $consecutivo = $ventas->consecutivo;
       $producto = Producto::where('empresa_id', Auth::user()->empresa_id_temp)
                           ->orderBy('id', 'asc')
                           ->lists('cod', 'id');
       $fecha = $ventas->fecha_elaboracion;
     
       $message = 'Registro eliminado correctamente!';
       return view('pages.ventas.factura', compact('cliente','producto','transaccion','estado', 'caja', 'fecha', 'consecutivo', 'factura', 'message'));
    }

    public function factura_venta($id){
      $empresa = Empresas::find(Auth::user()->empresa_id_temp);

      $facturas = Ventas::where('empresa_id', Auth::user()->empresa_id_temp) 
                          ->where('consecutivo', $id)
                          ->get();
      $factura = Ventas::where('empresa_id', Auth::user()->empresa_id_temp) 
                          ->where('consecutivo', $id)
                          ->orderBy('id', 'desc')
                          ->first();
      $fecha = Date::now()->sub('5 hour');
      $cliente = Clientes_id::find($factura->cliente_id);
      foreach ($facturas as $data) {
         $inventario = Inventario::where('producto_id', $data->producto_id)->first();
         if($data->caja_tipo == 'CAJA MAYOR'){
          $empresa->caja_mayor += (float)$data->total;
         }elseif($data->caja_tipo == 'CAJA MENOR'){
            $empresa->caja_menor += (float)$data->total;
         }elseif ($data->caja_tipo == 'BANCO') {
            $empresa->banco += (float)$data->total;
         } 
         
         if($data->tipo_estado_id == 'ALMACEN'){
            $inventario->almacen -= $data->cantidad;
            $inventario->existencia -=  $data->cantidad;
         }else{
            $inventario->bodega -= $data->cantidad;
            $inventario->existencia -=  $data->cantidad;
         }
         $data->activo = 1;
         $data->save();
         $empresa->save();
         $inventario->save();
      }
      
      
      return view('pages.ventas.ticket', compact('empresa','factura', 'fecha', 'cliente', 'facturas'));
    }

    public function show_rango_venta(){
      return view('pages.informe.show_venta');
    }

    public function rango_venta(){
       ini_set('max_execution_time', 1500);
        ini_set('max_input_time', 500); //3 minutes
        //ini_set('memory_limit', '16M');
       if(isset($_GET["fecha_1"]) and isset($_GET["fecha_2"])){
     
         $empresa = Empresas::find(Auth::user()->empresa_id_temp);
         $fecha_1 = htmlspecialchars(input::get("fecha_1")); 
         $fecha_2 = htmlspecialchars(input::get("fecha_2")); 
         $ventas  = Ventas::where('empresa_id', $empresa->id)->where('fecha_elaboracion', '>', $fecha_1)->where('fecha_elaboracion', '<=',$fecha_2)->where('activo', 1)->get();
         $fecha = Date::now()->sub('5 hour');
        return view('pages.informe.seguimiento_venta', compact('empresa', 'ventas','fecha', 'fecha_1', 'fecha_2'));
     }
    }
}
