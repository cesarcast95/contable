@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card" style="padding: 20px;">
              <div class="card-header">
                <h4 class="card-title">CUENTAS POR PAGAR</h4>
                <a href="{{route('cuentas_pagar.create')}}" class="btn btn-info">CREAR</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th><center>AJUSTES</center></th>
                     
                      <th><center>TERCERO</center></th>
                      <th>VALOR A PAGAR</th>
                      <th>FECHA</th>
                      <th>CAJA</th>
                      <th><center>ELIMINAR</center></th>
                      
                    </thead>
                    <tbody>
                    @foreach($cpp as $data)
                     <!--{{$tercero = App\Terceros::find($data->tercero)}}-->
                      <tr>
                        <td>
                          <center>
                            <a href="{{route('cuentas_pagar.edit', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                                 <i class="nc-icon nc-settings-gear-65"></i>
                               </a>
                          </center>
                        </td>
                   
                        <td><center>{{$tercero->nombre}}</center></td>
                        <td>$ {{number_format((float)$data->valor)}}</td>
                        <td>{{$data->fecha}}</td>
                        <td>{{$data->caja}}</td>
                        <td>
                          {!! Form::open(['route' => ['cuentas_pagar.destroy', $data->id]]) !!}
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