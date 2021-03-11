<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CuentasPorPagarFormRequest;
use App\Cuentas_por_pagar;
use Auth;
use App\Empresas;
use App\Tipo;
use App\Terceros;

class ControllerCuentasPagar extends Controller
{
    public function index(){
     	$cpp = Cuentas_por_pagar::where('empresa_id',Auth::user()->empresa_id_temp)
     							->where('pagado',0)
     							->get();
     	return view('pages.cuentas_por_pagar.index', compact('cpp'));
    }

    public function create(){
       $tercero = Terceros::where('empresa_id',Auth::user()->empresa_id_temp)
                        ->orderBy('id', 'asc')
                        ->lists('nombre', 'id');
       $caja = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
       return view('pages.cuentas_por_pagar.create', compact('caja','tercero'));
    }

    public function store(CuentasPorPagarFormRequest $request){

       $empresa = Empresas::find(Auth::user()->empresa_id_temp);
       $valor =  (float)$request->get('valor');

       if($request->get('caja') == 'CAJA MAYOR'){
          $empresa->caja_mayor += $valor;
       }elseif($request->get('caja') == 'CAJA MENOR'){
          $empresa->caja_menor += $valor;
       }elseif ($request->get('caja') == 'BANCO') {
          $empresa->banco += $valor;
       } 
       $empresa->save();
    	$data = [

    	 'fecha'              => $request->get('fecha'),
         'tercero'            => $request->get('tercero'),
    	 'caja'               => $request->get('caja'),
         'valor'		      => $request->get('valor'),
         'empresa_id'		  => Auth::user()->empresa_id_temp

    	];
    	$cpp = Cuentas_por_pagar::create($data);

    	$message = $cpp ? 'Se ha creado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('cuentas_pagar.index')->with('message', $message);


    }

    public function show(Cuentas_por_pagar $cpp)
    {
        return $cpp;
    }

    public function edit($id){
       $caja = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
       $tercero = Terceros::where('empresa_id',Auth::user()->empresa_id_temp)
                        ->orderBy('id', 'asc')
                        ->lists('nombre', 'id');
       $cpp = Cuentas_por_pagar::find($id);
       return view('pages.cuentas_por_pagar.edit', compact('caja', 'cpp', 'tercero'));
    }


    public function update(CuentasPorPagarFormRequest $request, $id){
    	$valor =  (int)$request->get('valor');
        $empresa = Empresas::find(Auth::user()->empresa_id_temp);
        $cpp = Cuentas_por_pagar::find($id);


        if($cpp->caja == "CAJA MAYOR"){
            $temp = $empresa->caja_mayor - $cpp->valor; 
            $empresa->caja_mayor = $temp;
            $empresa->caja_mayor += $valor;
        }elseif($cpp->caja == "CAJA MENOR"){
            $temp = $empresa->caja_menor - $cpp->valor; 
            $empresa->caja_menor = $temp;
            $empresa->caja_menor += $valor;

        }elseif ($cpp->caja == "BANCO") {
            $temp = $empresa->caja_menor - $cpp->valor; 
            $empresa->caja_menor = $temp;
            $empresa->banco += $valor;
        }

        $updated = $cpp->fill($request->all());
        $cpp->save();
        $empresa->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        return redirect()->route('cuentas_pagar.index')->with('message', $message);
    }

    public function destroy($id){
      $empresa = Empresas::find(Auth::user()->empresa_id_temp);
      $cpp = Cuentas_por_pagar::find($id);
      if($cpp->caja == "CAJA MAYOR"){
            $temp = $empresa->caja_mayor - $cpp->valor; 
            $empresa->caja_mayor = $temp;

        }elseif($cpp->caja == "CAJA MENOR"){
            $temp = $empresa->caja_menor - $cpp->valor; 
            $empresa->caja_menor = $temp;

        }elseif ($cpp->caja == "BANCO") {
            $temp = $empresa->caja_menor - $cpp->valor; 
            $empresa->caja_menor = $temp;

        }
        $empresa->save();
        $deleted = $cpp->delete();  
        $message = $deleted ? 'Cuenta por pagar eliminada correctamente!' : 'NO pudo eliminarse!';

      return redirect()->route('cuentas_pagar.index')->with('message', $message);
    }

    

}
