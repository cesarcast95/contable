@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">PRODUCTOS </h4>
              

                @if(\Session::has('message'))
                   @include('pages.partials.message')
                 @endif
             
                @if(isset($message))
                  @include('pages.partials.message')
                @endif

               <div class="row">
                  <div class="col-md-2">
               
                      <a href="{{route('productos.create')}}" class="btn btn-info" style="width: 100%">CREAR</a>
                  </div>
                  <div class="col-md-10" style="padding-top: 10px;"> 
                   <div style="display: block; float:right;">
                    {{Form::open(array(
                         'action' => 'ControllerProducto@filtro_producto',
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
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th><center>AJUSTES</center></th>
                      <th><center>COD</center></th>
                      <th><center>CATEGORÍA</center></th>
                      <th><center>PRODUCTO</center></th>
                      <th><center>PRECIO UTILIDAD</center></th>
                      <th><center>PORCENTAJE GANANCIA</center></th>
                      <th><center>IMPUESTO</center></th>
                      <th><center>PRECIO PRODUCTO</center></th>
                      <th><center>DESCUENTO</center></th>
                      <th><center>PROMOCIÓN</center></th>
                      <th><center>ELIMINAR</center></th>
                    </thead>
                    <tbody>
                    @foreach($productos as $data)
                     <!--{{$categoria = App\Categoria::find($data->categoria_id)}}-->
                      <tr>
                        <td>
                          <center>
                            <a href="{{route('productos.edit', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                                 <i class="nc-icon nc-settings-gear-65"></i>
                               </a>
                          </center>
                        </td>
                        <td>{{$data->cod}}</td>
                        <td>{{$categoria->nombre}}</td>
                        <td>{{$data->nombre}}</td>
                        <td>${{number_format($data->precio_utilidad)}}</td>
                        <td><center>{{$data->porcentaje_ganancia}}%</center></td>
                        <td><center>{{$data->impuesto}}%</center></td>
                        <td>$ {{number_format((float)$data->valor)}}</td>
                        @if($data->descuento_activado == true)
                          <td> <span class="badge badge-success" style="font-size: 14px;">$ {{number_format((float)$data->descuento)}}</span></td>
                        @else 
                          <td> <span class="badge badge-secondary" style="font-size: 14px;">$ {{number_format((float)$data->descuento)}}</span></td>
                        @endif
               
                        @if($data->promocion_activada == true)
                          <td> <span class="badge badge-success" style="font-size: 14px;">$ {{number_format((float)$data->promocion)}}</span></td>
                        @else 
                          <td> <span class="badge badge-secondary" style="font-size: 14px;">$ {{number_format((float)$data->promocion)}}</span></td>
                        @endif

                     
                         <td>
                          {!! Form::open(['route' => ['productos.destroy', $data->id]]) !!}
                            <input type="hidden" name="_method" value="DELETE">
                             <center> <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger" style="font-size: 35px; padding: 2px; background: #fff; color:#F25959; ">
                             <i class="nc-icon nc-basket"></i>
                            </button></center>
                          {!! Form::close() !!}
                        </td>

                     </tr>
                    @endforeach
                    {{ $productos->appends(request()->input())->links() }}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

@endsection