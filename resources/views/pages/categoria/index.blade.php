@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card" style="padding: 20px;">
              <div class="card-header">
                 <h4 class="card-title">CATEGORÍA </h4>
               
                  @if(isset($message))
                    @include('pages.partials.message')
                  @endif
                <div class="row">
                  <div class="col-md-2">
               
                      <a href="{{route('categoria.create')}}" class="btn btn-info" style="width: 100%">CREAR</a>
                  </div>
                  <div class="col-md-10" style="padding-top: 10px;"> 
                   <div style="display: block; float:right;">
                    {{Form::open(array(
                         'action' => 'CategoriaController@filtro_categoria',
                         'method' => 'GET',
                         'role' => 'form',
                         'class' => 'form-inline'
                          ))
                       
                    }}
                  
                     <div class="form-group">
            
                        {{Form::input('dato', 'dato', Input::get('dato'), array('class' => 'form-control buscador', 'placeholder'=>'DATO A BUSCAR'))}}

                     </div>

                      <div class="form-group ">
           
                         {{Form::select('tipo', $tipo, null, array('class' => 'form-control buscador'))}}
                      </div>

                       <div class="form-group "> 
                           {{Form::input('submit', null, 'Buscar', array('class' => 'btn btn-info submit'))}}
                          </div>
                          {{Form::close()}}
                      </div>

                    </div>

                  </div>
              </div>

              

              @if(\Session::has('message'))
                 @include('pages.partials.message')
              @endif
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th><center>AJUSTES</center></th>
                      <th><center>PRODUCTOS</center></th>
                      <th><center>COD</center></th>
                      <th><center>N° PRODUCTOS</center></th>
                      <th><center>NOMBRE</center></th>
                      <th><center>ELIMINAR</center></th>
                    </thead>
                    <tbody>
                    @foreach($categoria as $data)
                    <!-- {{$productos = App\Producto::where('categoria_id', $data->id)->get()}}-->
                      <tr>
                        <td>
                          <center>
                            <a href="{{route('categoria.edit', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                                 <i class="nc-icon nc-settings-gear-65"></i>
                               </a>
                          </center>
                        </td>
                         <td>
                          <center>
                          
                            <a href="{{url('relacion_c_p', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                                 <i class="nc-icon nc-diamond"></i>
                               </a>
                          </center>
                        </td>
                        <td><center>{{$data->id}}</center></td>
                        <td><center>{{count($productos)}}</center></td>
                        <td><center>{{$data->nombre}}</center></td>
             
                     
                         <td>
                          {!! Form::open(['route' => ['categoria.destroy', $data->id]]) !!}
                            <input type="hidden" name="_method" value="DELETE">
                             <center> <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger" style="font-size: 35px; padding: 2px; background: #fff; color:#F25959; ">
                             <i class="nc-icon nc-basket"></i>
                            </button></center>
                          {!! Form::close() !!}
                        </td>

                     </tr>
                    @endforeach
                     {{ $categoria->appends(request()->input())->links() }}
                    </tbody>
                  </table>


                </div>
              </div>
            </div>
          </div>
  
@endsection