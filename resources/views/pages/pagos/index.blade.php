@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card" style="padding: 20px">
              <div class="card-header">
                <h4 class="card-title">CUENTAS TRABAJADORES</h4>
                <a href="{{route('pagos.create')}}" class="btn btn-info">CREAR</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th><center>AJUSTES</center></th>
                      <th>COD TRABAJADOR</th>
                      <th>MOVIMIENTO</th>
                      <th>DETALLE</th>
                      <th>CUENTA</th>
                      <th>valor</th>
                      <th>FECHA</th>
                      <th><center>ELIMINAR</center></th>
                      
                    </thead>
                    <tbody>
                    @foreach($pagos as $data)
                      <!--{{$trabajador = App\Trabajadores::find($data->trabajador_id)}}-->
                      <tr>
                        <td>
                          <center>
                            <a href="{{route('pagos.edit', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                                 <i class="nc-icon nc-settings-gear-65"></i>
                               </a>
                          </center>
                        </td>
                   
                        <td>{{$trabajador->nombre}}</td>
                        <td>{{$data->movimiento}}</td>
                        <td>{{$data->observacion}}</td>
                        <td>{{$data->cuenta}}</td>
                        <td>${{number_format($data->valor)}}</td>
                        <td>{{$data->fecha}}</td>

                        <td>
                          {!! Form::open(['route' => ['pagos.destroy', $data->id]]) !!}
                            <input type="hidden" name="_method" value="DELETE">
                             <center> <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger" style="font-size: 35px; padding: 2px; background: #fff; color:#F25959; ">
                             <i class="nc-icon nc-basket"></i>
                            </button></center>
                          {!! Form::close() !!}
                        </td>



                     </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
           
@endsection
