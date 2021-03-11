<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EmpresaFormRequest;
use App\Empresas;
use App\Tipo;
use Auth;

class ControllerEmpresa extends Controller
{
    
    public function index()
    {
       $empresas = Empresas::all();
       return view('pages.admin.index', compact('empresas'));
    }


    public function create(){
      $tipo = Tipo::where('tipo', 1)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      $tipo_empresa = Tipo::where('tipo', 16)->orderBy('id', 'asc')->lists('nombre', 'nombre');
      return view('pages.admin.empresa.create', compact('tipo', 'tipo_empresa'));
    }

    public function store(EmpresaFormRequest $request){
    	 $data = [
            'nombre'        		=> $request->get('nombre'),
            'tipo_empresa'          => $request->get('tipo_empresa'),
            'nit'         			=> $request->get('nit'),
            'telefono'      		=> $request->get('telefono'),
            'ciudad'				=> $request->get('ciudad'),
            'direccion'				=> $request->get('direccion'),
            'tipo_regimen_id' 		=> $request->get('tipo_regimen_id'),
            'actividad_economica'	=> $request->get('actividad_economica'),
            'caja_mayor'            => $request->get('caja_mayor'),
            'caja_menor'            => $request->get('caja_menor'),
            'banco'                 => $request->get('banco'),
            'user_id'				=> Auth::user()->id
        ];

        $empresa = Empresas::create($data);

        $message = $empresa ? 'Se ha crado correctamente!' : 'NO pudo crarse!';
        
        return redirect()->route('empresa.index')->with('message', $message);
    }

      public function show(Empresas $empresa)
    {
        return $empresa;
    }

  
    public function edit(Empresas $empresa)
    {
    	$tipo_empresa = Tipo::where('tipo', 16)->orderBy('id', 'asc')->lists('nombre', 'id');
        $tipo = Tipo::where('tipo', 1)->orderBy('id', 'asc')->lists('nombre', 'nombre');
        return view('pages.admin.empresa.edit', compact('empresa', 'tipo', 'tipo_empresa'));
    }

  
    public function update(EmpresaFormRequest $request, Empresas $empresa)
    {
   
        $updated = $empresa->fill($request->all());
        $empresa->save();
        $message = $updated ? 'Actualizado correctamente!' : 'NO pudo actualizarse!';
        
        return redirect()->route('empresa.index')->with('message', $message);
    }
}
