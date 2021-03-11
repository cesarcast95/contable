<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Categoria;
use Auth;
use App\Tipo;
use App\Producto;

class CategoriaController extends Controller
{
    public function index(){
    	$categoria = Categoria::where('empresa_id',  Auth::user()->empresa_id_temp)->paginate(5);
      $tipo = Tipo::where('tipo',11)
                    ->orderBy('id', 'asc')
                    ->lists('nombre', 'id');
    	return view('pages.categoria.index', compact('categoria', 'tipo'));
    }

    public function create(){
    	 return view('pages.categoria.create');
    }

      public function store(Request $request)
    {
        $this->validate($request,[
          'nombre' => 'required|unique:categoria|max:255'
        ]);
        
        $categoria = Categoria::create([
            'nombre' 			=> $request->get('nombre'),
            'empresa_id' 	=> Auth::user()->empresa_id_temp   
        ]);
        
        $message = $categoria ? 'Categoría agregada correctamente!' : 'La Categoría NO pudo agregarse!';
        
        return redirect()->route('categoria.index')->with('message', $message);
    }

  public function show(Categoria $categoria){
 	
    return $categoria;

  }

  public function edit(Categoria $categoria){
 	   return view('pages.categoria.edit', compact('categoria'));
  }

  public function update(Request $request, Categoria $categoria){
 	
        $this->validate($request,[
          'nombre' => 'required|max:255'
        ]);

        $categoria->fill($request->all());
        $updated = $categoria->save();
        $message = $updated ? 'Categoría actualizada correctamente!' : 'La Categoría NO pudo actualizarse!';
        return redirect()->route('categoria.index')->with('message', $message);
  }

   public function destroy(Categoria $categoria){
 	   
     $deleted = $categoria->delete();
        
    $message = $deleted ? 'Categoría eliminada correctamente!' : 'La Categoría NO pudo eliminarse!';
        
    return redirect()->route('categoria.index')->with('message', $message);
  }


  public function filtro_categoria(){

        if(isset($_GET["dato"]) and isset($_GET["tipo"])){

           $dato = htmlspecialchars(input::get("dato")); 
           $tipo = htmlspecialchars(input::get("tipo")); 
           if($tipo == 30){
             $categoria = Categoria::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('id', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }else if($tipo == 31){
             $categoria = Categoria::where('empresa_id',  Auth::user()->empresa_id_temp)
                                    ->where('nombre', 'LIKE','%'.$dato.'%')
                                    ->paginate(5);  
           }

           if(count($categoria) > 0){
              $message = 'Se encontro correctamente el registro!';
           }else{
              $message = 'No se encontro en los registros!';
           }

        }else{
          $categoria = Categoria::where('empresa_id',  Auth::user()->empresa_id_temp)->paginate(5);  
          $message = 'No se encontro en los registros!';
        }
        $tipo  = Tipo::where('tipo',11)->orderBy('id', 'asc')->lists('nombre', 'id');

        return view('pages.categoria.index', compact('categoria', 'message', 'tipo'));
  }

  public function relacion_c_p($id){
     $productos = Producto::where('empresa_id',  Auth::user()->empresa_id_temp)
                            ->where('categoria_id', $id)
                            ->paginate(5);
     $categoria = Categoria::find($id);
     if(count($productos) == 0){
        $message = 'La categoría '.$categoria->nombre.' No tiene productos';
        return redirect()->route('categoria.index')->with('message', $message);
     }
     

      return view('pages.categoria.relacion_c_p', compact('categoria', 'productos'));
  }
}
