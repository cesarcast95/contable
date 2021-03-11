<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Empresas;
use App\User;
use Auth;
use App\Cuentas_por_pagar;
use App\Cobros;
use App\Trabajadores;
use App\Inventario;
use App\Clientes_id;
use App\Proveedor;
use App\Terceros;
use App\Comprobante;
use App\Ingreso_producto;
use App\Producto;
use App\Ventas;
use App\Pagos;
use App\Compras_gastos;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $empresas = Empresas::all();
       return view('pages.admin.index', compact('empresas'));
    }

    public function show($id){
         $empresa = Empresas::find($id);
         $user = User::find(Auth::user()->id);
         $user->empresa_id_temp = $id;
         $user->save();
         $terceros = Terceros::where('empresa_id', $id)->get();
         $trabajadores = Trabajadores::where('empresa_id', $id)->get();
         $proveedores = Proveedor::where('empresa_id', $id)->get();
         $clientes = Clientes_id::where('empresa_id', $id)->get();
         $inventario = Inventario::where('empresa_id', $id)->where('existencia','<=', 5)->get();
         return view('pages.empresa.index', compact('empresa', 'terceros', 'trabajadores', 'proveedores', 'clientes', 'inventario'));
    }

    public function limite_agotar(){
         $empresa = Empresas::find(Auth::user()->empresa_id_temp);
         $inventario = Inventario::where('empresa_id', Auth::user()->empresa_id_temp)->where('existencia','<=', 5)->get();
         $fecha = Date::now()->sub('5 hour');
         return view('pages.informe.limite_agotar', compact('empresa', 'fecha','inventario'));
    }

    public function informe_estado(){
        $empresa = Empresas::find(Auth::user()->empresa_id_temp);
        $cpp =  Cuentas_por_pagar::where('empresa_id', $empresa->id)->where('pagado',0)->get();
        $cobros = Cobros::where('empresa_id', $empresa->id)->where('pagado',0)->get();
        $fecha = Date::now()->sub('5 hour');
        return view('pages.informe.estado_empresa', compact('empresa', 'cpp', 'cobros','fecha'));
    }

    public function recaudo_cartera(){
        $empresa = Empresas::find(Auth::user()->empresa_id_temp);
        $fecha = Date::now()->sub('5 hour');
        return view('pages.informe.recaudo_cartera', compact('empresa','fecha'));
    }


    public function show_estado_resultado(){
      return view('pages.informe.estado_resultado.show_resultado');
    }


    public function rango_estado_resultado(){
        ini_set('max_execution_time', 1500);
        ini_set('max_input_time', 500); //3 minutes
        //ini_set('memory_limit', '16M');
       if(isset($_GET["fecha_1"]) and isset($_GET["fecha_2"])){
     

         $empresa = Empresas::find(Auth::user()->empresa_id_temp);
         $fecha_1 = htmlspecialchars(input::get("fecha_1")); 
         $fecha_2 = htmlspecialchars(input::get("fecha_2")); 
         $suma_ventas = 0;
         $suma_c_ingreso = 0;
         $suma_c_egreso = 0;
         $suma_i_p = 0;
         $suma_p_u =0;
         $suma_c_g = 0;
         $suma_pagos = 0;
         $suma_impuesto = 0;
         $ventas  = Ventas::where('empresa_id', $empresa->id)->where('fecha_elaboracion', '>', $fecha_1)->where('fecha_elaboracion', '<=',$fecha_2)->where('activo', 1)->get();
         foreach ($ventas as $data_v) {
             $suma_ventas += $data_v->total;
         }

         $comprobante  = Comprobante::where('empresa_id', $empresa->id)->where('fecha', '>', $fecha_1)->where('fecha', '<=',$fecha_2)->get();

         foreach ($comprobante as $data_c) {
            if($data_c->tipo_dato == 'INGRESO'){
             $suma_c_ingreso += $data_c->valor;
            }else{
             $suma_c_egreso += $data_c->valor;
            }
         }
        $ingreso_producto  = Ingreso_producto::where('empresa_id', $empresa->id)->where('fecha_ingreso', '>', $fecha_1)->where('fecha_ingreso', '<=',$fecha_2)->get();

        foreach ($ingreso_producto as $data_i_p) {

             $producto = Producto::find($data_i_p->producto_id);
           if($producto->descuento_activado == 1){
                $total =  (float)$producto->descuento * $data_i_p->cantidad;
                $total = ($total*($producto->impuesto/100));
             }else if($producto->promocion_activada == 1){  
                $total =  (float)$producto->descuento * $data_i_p->cantidad;
                $total = ($total*($producto->impuesto/100));
             }else if($producto->ganancia_activada == 1){
                $total =  ((float)$producto->valor)* $data_i_p->cantidad;
                $total = $total - ($total*($producto->impuesto/100));
                $total = ($total*($producto->impuesto/100));
             }else{
                $total =  (float)$producto->precio_utilidad * $data_i_p->cantidad;
                $total = $total - ($total*($producto->impuesto/100));
             }
         
             $suma_p_u += (float)$producto->precio_utilidad * $data_i_p->cantidad;
             $suma_impuesto += $total;
         }
        $compras_gastos  = Compras_gastos::where('empresa_id', $empresa->id)->where('fecha', '>', $fecha_1)->where('fecha', '<=',$fecha_2)->get();

        foreach ($compras_gastos as $data_c_g) {
            $suma_c_g += (float)$data_c_g->acomulado_haber;
        }

        $pagos  = Pagos::where('empresa_id', $empresa->id)->where('fecha', '>', $fecha_1)->where('fecha', '<=',$fecha_2)->get();

        foreach ($pagos as $data_p) {
            $suma_pagos += (float)$data_p->valor;
        }

         $fecha = Date::now()->sub('5 hour');
         $utilidad = $suma_ventas + $suma_c_ingreso-($suma_c_egreso + $suma_pagos + $suma_c_g)-$suma_p_u-$suma_impuesto;
        return view('pages.informe.estado_resultado.estado_resultado', compact('empresa', 'suma_i_p','suma_c_egreso','suma_c_ingreso','suma_ventas','suma_p_u','suma_c_g','suma_pagos','suma_impuesto','fecha','utilidad', 'fecha_1', 'fecha_2'));
     }
    }

     public function presupuesto_gastos(){
         ini_set('max_execution_time', 1500);
         ini_set('max_input_time', 500); //3 minutes
         $empresa = Empresas::find(Auth::user()->empresa_id_temp);
         $suma_ventas = 0;
         $suma_c_ingreso = 0;
         $suma_c_egreso = 0;
         $suma_i_p = 0;
         $suma_p_u =0;
         $suma_c_g = 0;
         $suma_pagos = 0;
         $suma_impuesto = 0;
         $ventas  = Ventas::where('empresa_id', $empresa->id)->where('activo', 1)->get();
         foreach ($ventas as $data_v) {
             $suma_ventas += $data_v->total;
         }

         $comprobante  = Comprobante::where('empresa_id', $empresa->id)->get();

         foreach ($comprobante as $data_c) {
            if($data_c->tipo_dato == 'INGRESO'){
             $suma_c_ingreso += $data_c->valor;
            }else{
             $suma_c_egreso += $data_c->valor;
            }
         }
        $ingreso_producto  = Ingreso_producto::where('empresa_id', $empresa->id)->get();

        foreach ($ingreso_producto as $data_i_p) {

             $producto = Producto::find($data_i_p->producto_id);
           if($producto->descuento_activado == 1){
                $total =  (float)$producto->descuento * $data_i_p->cantidad;
                $total = ($total*($producto->impuesto/100));
             }else if($producto->promocion_activada == 1){  
                $total =  (float)$producto->descuento * $data_i_p->cantidad;
                $total = ($total*($producto->impuesto/100));
             }else if($producto->ganancia_activada == 1){
                $total =  ((float)$producto->valor)* $data_i_p->cantidad;
                $total = $total - ($total*($producto->impuesto/100));
                $total = ($total*($producto->impuesto/100));
             }else{
                $total =  (float)$producto->precio_utilidad * $data_i_p->cantidad;
                $total = $total - ($total*($producto->impuesto/100));
             }
         
             $suma_p_u += (float)$producto->precio_utilidad * $data_i_p->cantidad;
             $suma_impuesto += $total;
         }
        $compras_gastos  = Compras_gastos::where('empresa_id', $empresa->id)->get();

        foreach ($compras_gastos as $data_c_g) {
            $suma_c_g += (float)$data_c_g->acomulado_haber;
        }

        $pagos  = Pagos::where('empresa_id', $empresa->id)->get();

        foreach ($pagos as $data_p) {
            $suma_pagos += (float)$data_p->valor;
        }

         $fecha = Date::now()->sub('5 hour');
         $utilidad = $suma_ventas + $suma_c_ingreso-($suma_c_egreso + $suma_pagos + $suma_c_g)-$suma_p_u-$suma_impuesto;
        return view('pages.informe.presupuesto_gasto', compact('empresa', 'suma_i_p','suma_c_egreso','suma_c_ingreso','suma_ventas','suma_p_u','suma_c_g','suma_pagos','suma_impuesto','fecha','utilidad'));
    }
}
