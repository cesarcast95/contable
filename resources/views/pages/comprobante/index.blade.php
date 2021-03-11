@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card" style="padding: 20px;">
              <div class="card-header">
               <h4 class="card-title">COMPROBANTE</h4>
               <div class="row">
                <div class="col-md-6">
                   <a href="{{route('comprobante.create')}}" class="btn btn-info">CREAR</a>
                  @if(isset($message))
                    @include('pages.partials.message')
                  @endif    
                </div>
                <div class="col-md-6" style="float:right;">
                    {{Form::open(array(
                        'action' => 'ComprobanteController@cuadre_caja',
                         'method' => 'GET',
                         'role' => 'form',
                         'class' => 'form-inline'
                          ))
                       
                    }}

                     <div class="form-group ">

                    {{Form::date('fecha_1', 'fecha_1', Input::get('fecha_1'), array('class' => 'form-control buscador', 'required'))}}

                     </div>

                      <div class="form-group ">

                    {{Form::date('fecha_2', 'fecha_2', Input::get('fecha_2'), array('class' => 'form-control buscador', 'required'))}}

                     </div>

                     {{Form::input('submit', null, 'GENERAR', array('class' => 'btn btn-info submit'))}}
                    
                    {{Form::close()}}
              </div>
            </div>
          </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th><center>AJUSTES</center></th>
                      <th><center>CÓDIGO</center></th>
                      <th><CENTER>COMPROBANTE</CENTER></th>
                      <th><CENTER>CAJA</CENTER></th>
                      <th><center>TERCERO</center></th>
                      <th><center>DETALLE</center></th>
                      <th><center>FECHA</center></th>
                      <th><center>DEBITO</center></th>
                      <th><center>CREDITO</center></th>
                      <th><center>ELIMINAR</center></th>
                    </thead>
                    <tbody>
                    @foreach($comprobante as $data)
                    <!--{{$tercero = App\Terceros::find($data->tercero_id)}}-->
                      <tr>
                        <td>
                          <center>
                            <a href="{{route('comprobante.edit', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                                 <i class="nc-icon nc-settings-gear-65"></i>
                               </a>
                          </center>
                        </td>
                        <td><center>{{$data->codigo}}</center></td>
                        <td><center>{{$data->tipo_dato}}</center></td>
                        <td><center>{{$data->caja}}</center></td>
                        <td><center>{{$tercero->nombre}}</center></td>
                        <td><center>{{$data->detalle}}</center></td>
                        <td><center>{{$data->fecha}}</center></td>
                        @if($data->tipo_dato == 'INGRESO')
                          <td><center>${{number_format($data->valor)}}</center></td>
                          <td><center>0</center></td>
                        @else
                        <td><center>0</center></td>
                        <td><center>${{number_format($data->valor)}}</center></td>
                        @endif
                        <td>
                          {!! Form::open(['route' => ['comprobante.destroy', $data->id]]) !!}
                            <input type="hidden" name="_method" value="DELETE">
                             <center> <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger" style="font-size: 35px; padding: 2px; background: #fff; color:#F25959; ">
                             <i class="nc-icon nc-basket"></i>
                            </button></center>
                          {!! Form::close() !!}
                        </td>
                     </tr>
                    @endforeach
                     {{ $comprobante->appends(request()->input())->links() }}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

@endsection