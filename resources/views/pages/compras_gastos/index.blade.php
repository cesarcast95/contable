@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card" style="padding: 20px">
              <div class="card-header">
                <h4 class="card-title">EGRESOS</h4>
                <a href="{{route('compras_gastos.create')}}" class="btn btn-info">CREAR</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>AJUSTES</th>
                      <th>CUENTA</th>
                      <th>MOVIMEINTO</th>
                      <th>DETALLE</th>
                      <th>ASIENTO</th>
                      <th>valor</th>
                      <th>FECHA</th>
                      <th>ELIMINAR</th>
                    </thead>
                    <tbody>
                    @foreach($compras_gastos as $data)
                      <tr>
                        <td>
                          <center>
                            <a href="{{route('compras_gastos.edit', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                                 <i class="nc-icon nc-settings-gear-65"></i>
                               </a>
                          </center>
                        </td>
                        
                        <td>{{$data->cuenta}}</td>
                        <td>{{$data->nombre}}</td>
                        <td>{{$data->detalle}}</td>
                        <td>{{$data->pago}}</td>
                        <td>${{number_format((float)$data->acomulado_haber)}}</td>
                        <td>{{$data->fecha}}</td>
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
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

@endsection