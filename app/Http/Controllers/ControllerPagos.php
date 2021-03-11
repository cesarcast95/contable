<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PagoFormRequest;
use App\Pagos;
use Auth;
use App\Trabajadores;
use App\Tipo;
use App\Empresas;

class ControllerPagos extends Controller
{
    public function index()
    {
       $pagos = pagos::where('empresa_id', Auth::user()->empresa_id_temp)->get();
       return view('pages.pagos.index', compact('pagos'));
    }


    public function create(){
      $tipo_cuenta = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tipo_movimiento = Tipo::where('tipo', 10)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $trabajador = Trabajadores::where('empresa_id', Auth::user()->empresa_id_temp)->orderBy('id', 'asc')->lists('nombre', 'id');
      return view('pages.pagos.create', compact('tipo_cuenta','tipo_movimiento', 'trabajador'));
    }

    public function store(PagoFormRequest $request){

       $empresa = Empresas::find(Auth::user()->empresa_id_temp);
       if($request->get('cuenta') == 'CAJA MAYOR'){
          $temp = $empresa->caja_mayor - (float)$request->get('valor');
          $empresa->caja_mayor = $temp;
       }elseif($request->get('cuenta') == 'CAJA MENOR'){
          $temp = $empresa->caja_menor - (float)$request->get('valor');
          $empresa->caja_mayor = $temp;
       }elseif ($request->get('cuenta') == 'BANCO') {
          $temp = $empresa->banco - (float)$request->get('valor');
          $empresa->banco = $temp;
       } 
       $empresa->save();
       $data = [
            'movimiento'            => $request->get('movimiento'),
            'cuenta'                => $request->get('cuenta'),
            'trabajador_id'         => $request->get('trabajador_id'),
            'observacion'           => $request->get('observacion'),
            'valor'      			=> $request->get('valor'),
            'fecha'                 => $request->get('fecha'),
            'empresa_id'		    => Auth::user()->empresa_id_temp
        ];
        $total = $request->get('valor');
        $pagos = Pagos::create($data);
        $empresa = Empresas::find(Auth::user()->empresa_id_temp);

           if($request->get('cuenta') == 'CAJA MAYOR'){
              $temp = (float)$empresa->caja_mayor - (float)$total;
              dd($empresa->caja_mayor);
              $empresa->caja_mayor = $temp;
           }elseif($request->get('cuenta') == 'CAJA MENOR'){
              $temp = (float)$empresa->caja_menor - (float)$total;
              $empresa->caja_menor = $temp;
           }elseif ($request->get('cuenta') == 'BANCO') {
              $temp = (float)$empresa->banco - (float)$total;
              $empresa->banco = $temp;
           }
          $empresa->save();

        $message = $pagos ? 'Se ha crado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('pagos.index')->with('message', $message);
    }

      public function show(Pagos $pagos)
    {
        return $pagos;
    }

  
    public function edit(Pagos $pagos)
    {
        $tipo_cuenta = Tipo::where('tipo', 7)->orderBy('id', 'asc')->lists('nombre', 'nombre');
        $tipo_movimiento = Tipo::where('tipo', 10)->orderBy('id', 'asc')->lists('nombre', 'nombre');
        $trabajador = Trabajadores::where('empresa_id', Auth::user()->empresa_id_temp)->orderBy('id', 'asc')->lists('nombre', 'id');
        return view('pages.pagos.edit', compact('tipo_cuenta','tipo_movimiento', 'trabajador', 'pagos'));
    }

  
    public function update(EmpresaFormRequest $request, Pagos $pagos)
    {
        $empresa = Empresas::find(Auth::user()->empresa_id_temp);
        if($pagos->cuenta == 'CAJA MAYOR'){

          $temp = $empresa->caja_mayor + (float)$pagos->valor;
          $empresa->caja_mayor = $temp - (float)$request->valor;

        }elseif($pagos->cuenta == 'CAJA MENOR'){

          $temp = $empresa->caja_menor + (float)$pagos->valor;
          $empresa->caja_menor = $temp - (float)$request->valor;

        }elseif ($pagos->cuenta == 'BANCO') {

           $temp = $empresa->banco + (float)$pagos->valor;
           $empresa->banco = $temp - (float)$request->valor;
        } 
        $empresa->save();
        $updated = $pagos->fill($request->all());
        $pagos->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        
        return redirect()->route('pagos.index')->with('message', $message);
    }

    public function destroy(Pagos $pagos){
       $empresa = Empresas::find(Auth::user()->empresa_id_temp);
       if($pagos->cuenta == 'CAJA MAYOR'){

          $temp = $empresa->caja_mayor + (float)$pagos->valor;
          $empresa->caja_mayor = $temp;

       }elseif($pagos->cuenta == 'CAJA MENOR'){

          $temp = $empresa->caja_menor + (float)$pagos->valor;
          $empresa->caja_menor = $temp;

       }elseif ($compras_gastos->cuenta == 'BANCO') {

           $temp = $empresa->banco + (float)$pagos->valor;
           $empresa->banco = $temp;
       } 
        $empresa->save();
        $destroy = $pagos->delete();
        $message = $destroy ? 'Se ha eliminado correctamente!' : 'NO pudo eliminarse!';
         return redirect()->route('pagos.index')->with('message', $message);

    }
}
