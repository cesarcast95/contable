@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card" style="padding: 20px;">
              <div class="card-header">
                <h4 class="card-title">INVENTARIO</h4>

                 @if(\Session::has('message'))
                   @include('pages.partials.message')
                 @endif
             
                @if(isset($message))
                  @include('pages.partials.message')
                @endif

                <div class="row">
                  <div class="col-md-2">
               
                      <a href="{{route('inventario.create')}}" class="btn btn-info" style="width: 100%">CREAR</a>
                  </div>
                  <div class="col-md-10" style="padding-top: 10px;"> 
                   <div style="display: block; float:right;">
                    {{Form::open(array(
                         'action' => 'InventarioController@filtro_inventario',
                         'method' => 'GET',
                         'role'   => 'form',
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
                      <th><center>CÓDIGO</center></th>

                      <th><CENTER>PRODUCTO</CENTER></th>
                      <th><center>CANTIDAD ALMACEN</center></th>
                      <th><center>CANTIDAD BODEGA</center></th>
                      <th><center>CANTIDAD TOTAL</center></th>
                      <th><center>MINIMO</center></th>
                      <th><center>MAXIMO</center></th>
                    </thead>
                    <tbody>
                    @foreach($inventario as $data)
                    <!--{{$producto = App\Producto::find($data->producto_id)}}-->
                      <tr>
                        <td>
                          <center>
                            <a href="{{route('inventario.edit', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                                 <i class="nc-icon nc-settings-gear-65"></i>
                               </a>
                          </center>
                        </td>
                        <td><center>{{$data->codigo}}</center></td>
                        <td><center>{{$producto->nombre}}</center></td>
                        <td><center>{{number_format($data->almacen)}}</center></td>
                        <td><center>{{number_format($data->bodega)}}</center></td>
                        <td><center>{{number_format($data->existencia)}}</center></td>
                        <td><center>{{number_format($data->minimo)}}</center></td>
                        <td><center>{{number_format($data->maximo)}}</center></td>

                     </tr>
                    @endforeach
                     {{ $inventario->appends(request()->input())->links() }}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

@endsection