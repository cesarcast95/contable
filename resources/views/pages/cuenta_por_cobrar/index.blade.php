@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">CUENTAS POR COBRAR</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th><center> TERCERO</center></th>
                      <th><center>VALOR A COBRAR</center></th>
                      <th><center>FECHA</center></th>
                      <th><center>CAJA</center></th>
                      <th><center>EFECTUAR PAGO</center></th>
                      
                    </thead>
                    <tbody>
                    @foreach($cobros as $data)
                      <tr>
                       <!--{{$tercero = App\Terceros::find($data->tercero)}}-->
                        <td><center>{{$tercero->nombre}}</center></td>
                        <td><center>$ {{number_format($data->libramiento)}}</center></td>
                        <td><center>{{$data->vencimiento}}</center></td>
                        <td><center>{{$data->caja}}</center></td>
                        <td>
                          <center>
                            <a href="{{url('cobros-pago', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px; color:#87E733">
                              <i class="nc-icon nc-money-coins"></i>
                            </a>
                          </center>

                        </td>

                     </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
           
@endsection