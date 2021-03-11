<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CompraFormRequest;
use App\Compras_gastos;
use App\Tipo;
use Auth;
USE App\Empresas;

class ControllerComprasGastos extends Controller
{
    public function index()
    {
       $compras_gastos = Compras_gastos::where('empresa_id', Auth::user()->empresa_id_temp)->get();
       return view('pages.compras_gastos.index', compact('compras_gastos'));
    }


    public function create(){
      $tipo = Tipo::where('tipo', 5)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tipo_cuenta = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tipo_pago = Tipo::where('tipo', 8)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tipo_movimiento = Tipo::where('tipo', 9)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      return view('pages.compras_gastos.create', compact('tipo','tipo_cuenta','tipo_pago', 'tipo_movimiento'));
    }

    public function store(CompraFormRequest $request){

       $empresa = Empresas::find(Auth::user()->empresa_id_temp);
       if($request->get('cuenta') == 'CAJA MAYOR'){
          $temp = $empresa->caja_mayor - (float)$request->get('acomulado_haber');
          $empresa->caja_mayor = $temp;
       }elseif($request->get('cuenta') == 'CAJA MENOR'){
          $temp = $empresa->caja_menor - (float)$request->get('acomulado_haber');
          $empresa->caja_mayor = $temp;
       }elseif ($request->get('cuenta') == 'BANCO') {
          $temp = $empresa->banco - (float)$request->get('acomulado_haber');
          $empresa->banco = $temp;
       } 
       $empresa->save();
    	 $data = [
            'nombre'        		=> $request->get('nombre'),
            'cuenta'         		=> $request->get('cuenta'),
            'detalle'               => $request->get('detalle'),
            'pago'                  => $request->get('pago'),
            'fecha'      	        => $request->get('fecha'),
            'acomulado_haber'		=> $request->get('acomulado_haber'),
            'tipo_estado' 		    => $request->get('tipo_estado'),
            'empresa_id'		    => Auth::user()->empresa_id_temp
        ];

        $compras_gastos = Compras_gastos::create($data);

        $message = $compras_gastos ? 'Se ha crado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('compras_gastos.index')->with('message', $message);
    }

      public function show(Compras_gastos $compras_gastos)
    {
        return $compras_gastos;
    }

  
    public function edit(Compras_gastos $compras_gastos)
    {
      $tipo = Tipo::where('tipo', 5)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tipo_cuenta = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tipo_pago = Tipo::where('tipo', 8)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tipo_movimiento = Tipo::where('tipo', 9)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      return view('pages.compras_gastos.edit', compact('compras_gastos','tipo','tipo_cuenta','tipo_pago', 'tipo_movimiento'));
    }

  
    public function update(CompraFormRequest $request, Compras_gastos $compras_gastos)
    {
   
       $empresa = Empresas::find(Auth::user()->empresa_id_temp);
       if($compras_gastos->cuenta == 'CAJA MAYOR'){
          $temp = $empresa->caja_mayor + (float)$compras_gastos->acomulado_haber;
          $empresa->caja_mayor = $temp - (float)$request->acomulado_haber;
       }elseif($compras_gastos->cuenta == 'CAJA MENOR'){
          $temp = $empresa->caja_menor + (float)$compras_gastos->acomulado_haber;
          $empresa->caja_menor = $temp - (float)$request->acomulado_haber;
       }elseif ($compras_gastos->cuenta == 'BANCO') {
           $temp = $empresa->banco + (float)$compras_gastos->acomulado_haber;
          $empresa->banco = $temp - (float)$request->acomulado_haber;
       } 
        $empresa->save();
        $updated = $compras_gastos->fill($request->all());
        $compras_gastos->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        
        return redirect()->route('compras_gastos.index')->with('message', $message);
    }

    public function destroy(Compras_gastos $compras_gastos){
       $empresa = Empresas::find(Auth::user()->empresa_id_temp);
       if($compras_gastos->cuenta == 'CAJA MAYOR'){
          $temp = $empresa->caja_mayor + (float)$compras_gastos->acomulado_haber;
          $empresa->caja_mayor = $temp;
       }elseif($compras_gastos->cuenta == 'CAJA MENOR'){
          $temp = $empresa->caja_menor + (float)$compras_gastos->acomulado_haber;
          $empresa->caja_menor = $temp;
       }elseif ($compras_gastos->cuenta == 'BANCO') {
           $temp = $empresa->banco + (float)$compras_gastos->acomulado_haber;
           $empresa->banco = $temp;
       } 
        $empresa->save();
        $destroy = $compras_gastos->delete();
        $message = $destroy ? 'Se ha eliminado correctamente!' : 'NO pudo eliminarse!';
         return redirect()->route('compras_gastos.index')->with('message', $message);

    }
}
