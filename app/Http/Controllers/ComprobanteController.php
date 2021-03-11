<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ComprobanteFormRequest;
use Illuminate\Support\Facades\Input;
use Jenssegers\Date\Date;
use App\Comprobante;
use App\Empresas;
use App\Tipo;
use App\Terceros;
use Auth;

class ComprobanteController extends Controller
{
    public function index(){
      $comprobante = Comprobante::where('empresa_id',  Auth::user()->empresa_id_temp)->orderBy('id', 'desc')->paginate(5);
      return view('pages.comprobante.index', compact('comprobante'));
    }

    public function create(){
    	 $tipo_cuenta = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
         $tipo_dato = Tipo::where('tipo', 17)->orderBy('id', 'asc')->lists('nombre', 'nombre');
         $tercero = Terceros::where('empresa_id',  Auth::user()->empresa_id_temp)
         					->orderBy('id', 'asc')
         					->lists('nombre', 'id');
    	 return view('pages.comprobante.create', compact('tipo_cuenta', 'tipo_dato', 'tercero'));
    }

      public function store(ComprobanteFormRequest $request)
    {

    	$empresa = Empresas::find(Auth::user()->empresa_id_temp);
    	if($request->get('tipo_dato') == 'EGRESO'){
	    	if($request->get('caja') == 'CAJA MAYOR'){
	          $temp = $empresa->caja_mayor - (float)$request->get('valor');
	          $empresa->caja_mayor = $temp;
	        }elseif($request->get('caja') == 'CAJA MENOR'){
	          $temp = $empresa->caja_menor - (float)$request->get('valor');
	          $empresa->caja_mayor = $temp;
	        }elseif ($request->get('caja') == 'BANCO') {
	          $temp = $empresa->banco - (float)$request->get('valor');
	          $empresa->banco = $temp;
	        } 
	   	}else{
	   	   $total =  $request->get('valor');
	       if($request->get('caja') == 'CAJA MAYOR'){
	          $empresa->caja_mayor += $total;
	       }elseif($request->get('caja') == 'CAJA MENOR'){
	          $empresa->caja_menor += $total;
	       }elseif ($request->get('caja') == 'BANCO'){
	          $empresa->banco += $total;
	       } 
	   	}
	   	$empresa->save();


        $comprobante = Comprobante::create([
        	'codigo'        => $request->get('codigo'),
            'tercero_id'     => $request->get('tercero_id'),
            'valor'    	    => $request->get('valor'),
            'detalle'       => $request->get('detalle'),
            'fecha'			=> $request->get('fecha'),
            'tipo_dato'		=> $request->get('tipo_dato'),
            'caja'			=> $request->get('caja'),
            'empresa_id' 	=> Auth::user()->empresa_id_temp   
        ]);
        
        $message = $comprobante ? 'Comprobante agregado correctamente!' : 'El Comprobante NO pudo agregarse!';
        
        return redirect()->route('comprobante.index')->with('message', $message);
    }

  public function show(Comprobante $comprobante){
 	
    return $comprobante;

  }

  public function edit(Comprobante $comprobante){
  	  $tipo_cuenta = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tipo_dato = Tipo::where('tipo', 17)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tercero = Terceros::where('empresa_id',  Auth::user()->empresa_id_temp)
         					->orderBy('id', 'asc')
         					->lists('nombre', 'id');
 	   return view('pages.comprobante.edit', compact('comprobante', 'tipo_dato', 'tipo_cuenta','tercero'));
  }

  public function update(ComprobanteFormRequest $request, Comprobante $comprobante){
 	    $empresa = Empresas::find(Auth::user()->empresa_id_temp);
 	    $valor =  (int)$request->get('valor');
 	    if($request->get('tipo_dato') == 'INGRESO'){
	        if($comprobante->caja == "CAJA MAYOR"){
	            $temp = $empresa->caja_mayor - $comprobante->valor; 
	            $empresa->caja_mayor = $temp;
	            $empresa->caja_mayor += $valor;
	        }elseif($comprobante->caja == "CAJA MENOR"){
	            $temp = $empresa->caja_menor - $comprobante->valor; 
	            $empresa->caja_menor = $temp;
	            $empresa->caja_menor += $valor;

	        }elseif ($comprobante->caja == "BANCO") {
	            $temp = $empresa->caja_menor - $comprobante->valor; 
	            $empresa->caja_menor = $temp;
	            $empresa->banco += $valor;
	        }
	   	}else{
	         if($comprobante->caja == 'CAJA MAYOR'){
	           $temp = $empresa->caja_mayor + (float)$comprobante->valor;
	           $empresa->caja_mayor = $temp - (float)$request->valor;
	         }elseif($comprobante->caja == 'CAJA MENOR'){
	           $temp = $empresa->caja_menor + (float)$comprobante->valor;
	           $empresa->caja_menor = $temp - (float)$request->valor;
	         }elseif ($comprobante->caja == 'BANCO') {
	           $temp = $empresa->banco + (float)$comprobante->valor;
	           $empresa->banco = $temp - (float)$request->valor;
	         } 
	   	}
	   	$empresa->save();
        $comprobante->fill($request->all());
        $updated = $comprobante->save();
        $message = $updated ? 'Comprobante actualizada correctamente!' : 'NO pudo actualizarse!';
        return redirect()->route('comprobante.index')->with('message', $message);
  }

   public function destroy(Comprobante $comprobante){
 	  $empresa = Empresas::find(Auth::user()->empresa_id_temp);
 	    if($request->get('tipo_dato') == 'INGRESO'){
	        if($comprobante->caja == "CAJA MAYOR"){
	            $temp = $empresa->caja_mayor - $comprobante->valor; 
	            $empresa->caja_mayor = $temp;
	        }elseif($comprobante->caja == "CAJA MENOR"){
	            $temp = $empresa->caja_menor - $comprobante->valor; 
	            $empresa->caja_menor = $temp;
	        }elseif ($comprobante->caja == "BANCO") {
	            $temp = $empresa->caja_menor - $comprobante->valor; 
	            $empresa->caja_menor = $temp;
	        }
	   	}else{
	         if($comprobante->caja == 'CAJA MAYOR'){
	           $temp = $empresa->caja_mayor + (float)$comprobante->valor;
	           $empresa->caja_mayor = $temp;
	         }elseif($comprobante->caja == 'CAJA MENOR'){
	           $temp = $empresa->caja_menor + (float)$comprobante->valor;
	           $empresa->caja_menor = $temp;
	         }elseif ($comprobante->caja == 'BANCO') {
	           $temp = $empresa->banco + (float)$comprobante->valor;
	           $empresa->banco = $temp;
	         } 
	   	}
	   $empresa->save();
       $deleted = $comprobante->delete(); 
       $message = $deleted ? 'eliminado correctamente!' : 'NO pudo eliminarse!';  
       return redirect()->route('comprobante.index')->with('message', $message);
  }

    public function cuadre_caja(){
        ini_set('max_execution_time', 1500);
        ini_set('max_input_time', 500); //3 minutes
        //ini_set('memory_limit', '16M');
       if(isset($_GET["fecha_1"]) and isset($_GET["fecha_2"])){
     
         $empresa = Empresas::find(Auth::user()->empresa_id_temp);
         $fecha_1 = htmlspecialchars(input::get("fecha_1")); 
         $fecha_2 = htmlspecialchars(input::get("fecha_2")); 
         $comprobante  = Comprobante::where('empresa_id', $empresa->id)->where('fecha', '>', $fecha_1)->where('fecha', '<=',$fecha_2)->get();
         $fecha = Date::now()->sub('5 hour');
        return view('pages.comprobante.cuadre_caja', compact('empresa', 'comprobante','fecha', 'fecha_1', 'fecha_2'));
     }
    }
    
}
