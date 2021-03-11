<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CobroFormRequest;
use App\Cobros;
use Auth;
use App\Tipo;
use App\Empresas;
use App\Terceros;
class ControllerCobros extends Controller
{
     public function index()
    {
       $cobros = Cobros::where('empresa_id', Auth::user()->empresa_id_temp)->where('pagado',0)->get();
       return view('pages.cobros.index', compact('cobros'));
    }


    public function create(){
      $tercero = Terceros::where('empresa_id',Auth::user()->empresa_id_temp)
                        ->orderBy('id', 'asc')
                        ->lists('nombre', 'id');
      $tipo = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      return view('pages.cobros.create', compact('tipo', 'tercero'));
    }

    public function store(CobroFormRequest $request){

       $empresa = Empresas::find(Auth::user()->empresa_id_temp);
       if($request->get('caja') == 'CAJA MAYOR'){
          $temp = $empresa->caja_mayor - (float)$request->get('libramiento');
          $empresa->caja_mayor = $temp;
       }elseif($request->get('caja') == 'CAJA MENOR'){
          $temp = $empresa->caja_menor - (float)$request->get('libramiento');
          $empresa->caja_mayor = $temp;
       }elseif ($request->get('caja') == 'BANCO') {
          $temp = $empresa->banco - (float)$request->get('libramiento');
          $empresa->banco = $temp;
       } 
       $empresa->save();
    	 $data = [
            'tercero'        => $request->get('tercero'),
            'libramiento'           => $request->get('libramiento'),
            'vencimiento'      		=> $request->get('vencimiento'),
            'caja'      	        => $request->get('caja'),
            'empresa_id'		    => Auth::user()->empresa_id_temp
        ];

        $cobros = Cobros::create($data);

        $message = $cobros ? 'Se ha crado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('cobros.index')->with('message', $message);
    }

      public function show(Cobros $cobros)
    {
        return $cobros;
    }

  
    public function edit(Cobros $cobros)
    {
      $tercero = Terceros::where('empresa_id',Auth::user()->empresa_id_temp)
                        ->orderBy('id', 'asc')
                        ->lists('nombre', 'id');
    	$tipo = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      return view('pages.cobros.edit', compact('cobros','tipo','tercero'));
    }

  
    public function update(CobroFormRequest $request, Cobros $cobros)
    {
        $empresa = Empresas::find(Auth::user()->empresa_id_temp);
        if($cobros->caja == 'CAJA MAYOR'){

          $temp = $empresa->caja_mayor + (float)$cobros->libramiento;
          $empresa->caja_mayor = $temp - (float)$request->libramiento;

        }elseif($cobros->caja == 'CAJA MENOR'){

          $temp = $empresa->caja_menor + (float)$cobros->libramiento;
          $empresa->caja_menor = $temp - (float)$request->libramiento;

        }elseif ($cobros->caja == 'BANCO') {

           $temp = $empresa->banco + (float)$cobros->libramiento;
           $empresa->banco = $temp - (float)$request->libramiento;
        } 
        $empresa->save();
        $updated = $cobros->fill($request->all());
        $cobros->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        
        return redirect()->route('cobros.index')->with('message', $message);
    }

    public function destroy(Cobros $cobros){
        $empresa = Empresas::find(Auth::user()->empresa_id_temp);
        if($cobros->caja == 'CAJA MAYOR'){

          $temp = $empresa->caja_mayor + (float)$cobros->libramiento;
          $empresa->caja_mayor = $temp;

        }elseif($cobros->caja == 'CAJA MENOR'){

          $temp = $empresa->caja_menor + (float)$cobros->libramiento;
          $empresa->caja_menor = $temp;

        }elseif ($cobros->caja == 'BANCO') {

           $temp = $empresa->banco + (float)$cobros->libramiento;
           $empresa->banco = $temp;
        } 
        $empresa->save();
        $destroy = $cobros->delete();
        $message = $destroy ? 'Se ha eliminado correctamente!' : 'NO pudo eliminarse!';
         return redirect()->route('cobros.index')->with('message', $message);

    }

    public function cobros_show(){
      $cobros = Cobros::where('empresa_id', Auth::user()->empresa_id_temp)->where('pagado',0)->get();
       return view('pages.cuenta_por_cobrar.index', compact('cobros'));
    }

    public function cobros_pago($id){
      
      $cobro = Cobros::find($id);
      $empresa = Empresas::find(Auth::user()->empresa_id_temp);
      if($cobro->caja == 'CAJA MAYOR'){

        $temp = $empresa->caja_mayor + (float)$cobro->libramiento;
        $empresa->caja_mayor = $temp;

      }elseif($cobro->caja == 'CAJA MENOR'){

        $temp = $empresa->caja_menor + (float)$cobro->libramiento;
        $empresa->caja_menor = $temp;

      }elseif ($cobro->caja == 'BANCO') {

         $temp = $empresa->banco + (float)$cobro->libramiento;
         $empresa->banco = $temp;
      } 
      $cobro->pagado = 1;
      $cobro->save();
      $pago = $empresa->save();
      $cobros = Cobros::where('empresa_id', Auth::user()->empresa_id_temp)->where('pagado',0)->get();
      return view('pages.cuenta_por_cobrar.index', compact('cobros'));
    }
}
