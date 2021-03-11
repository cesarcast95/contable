@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card" style="padding: 20px;">
              <div class="card-header">
                <h4 class="card-title">VENTAS</h4>
                <a href="{{route('ventas.create')}}" class="btn btn-info">CREAR</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>AJUSTES</th> 
                      <th>COD</th>
                      <th>CAJA</th>
                      <th>TIPO TRANSACCION</th>
                      <th>CANTIDAD</th>
                      <th>ESTADO</th>
                      <th>SUCURSAL</th>
                      <th>CLIENTE</th>
                      <th>PRODUCTO</th>
                      <th>TOTAL</th>
                      <th>FECHA ELABORACION</th>
                      <th>ELIMINAR</th>
                    </thead>
                    <tbody>
                    @foreach($ventas as $data)
                      <tr>
                        <td>
                          <center>
                            <a href="{{route('ventas.edit', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                                 <i class="nc-icon nc-settings-gear-65"></i>
                               </a>
                          </center>
                        </td>
                        <td>{{$data->id}}</td>
                        <td>{{$data->caja_tipo}}</td>
                        <td>{{$data->tipo_transaccion_id}}</td>
                        <td>{{$data->cantidad}}</td>
                        <td>{{$data->tipo_estado_id}}</td>
                        <td>{{$data->sucursal}}</td>
                        <td>{{$data->cliente_id}}</td>
                        <td>{{$data->producto_id}}</td>
                        <td>${{number_format($data->total)}}</td>
                        <td>{{$data->fecha_elaboracion}}</td>
                        <td>
                          {!! Form::open(['route' => ['ventas.destroy', $data->id]]) !!}
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
            </div>
          </div>

@endsection