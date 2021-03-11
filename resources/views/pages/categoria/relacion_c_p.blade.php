@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">PRODUTOS DE {{$categoria->nombre}}</h4>

                <a href="{{route('categoria.index')}}" class="btn btn-info"> <b><i class="nc-icon nc-minimal-left" style="font-size: 14px;"></i></b> VOLVER</a>
              

                @if(\Session::has('message'))
                   @include('pages.partials.message')
                 @endif
             
                @if(isset($message))
                  @include('pages.partials.message')
                @endif

              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th><center>AJUSTES</center></th>
                      <th><center>COD</center></th>
                      <th><center>PRODUCTO</center></th>
                      <th><center>PRECIO UTILIDAD</center></th>
                      <th><center>PORCENTAJE GANANCIA</center></th>
                      <th><center>PRECIO PRODUCTO</center></th>
                      <th><center>DESCUENTO</center></th>
                      <th><center>PROMOCIÓN</center></th>
                      <th><center>ELIMINAR</center></th>
                    </thead>
                    <tbody>
                    @foreach($productos as $data)
     
                      <tr>
                        <td>
                          <center>
                            <a href="{{route('productos.edit', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                                 <i class="nc-icon nc-settings-gear-65"></i>
                               </a>
                          </center>
                        </td>
                        <td>{{$data->cod}}</td>
   
                        <td>{{$data->nombre}}</td>
                        <td>${{number_format((float)$data->precio_utilidad)}}</td>
                        <td><center>{{$data->porcentaje_ganancia}}%</center></td>
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