@extends('layouts.app')
@section('content')
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">EMPRESAS</h4>
                <a href="{{route('empresa.create')}}" class="btn btn-success">CREAR</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>EDITAR</th>
                      <th>MODULO</th>
                      <th>EMPRESA</th>
                      <th>NIT</th>
                      <th>CIUDAD</th>
                      <th>DIRECCION</th>
                      <th>TELEFONO</th>
                      <th>TIPO REGIMEN</th>
                      <th>ACTIVIDAD ECONOMICA</th>
                    </thead>
                    <tbody>
                    @foreach($empresas as $data)
                      <tr>
                        <td><a href="{{route('empresa.edit', $data->id)}}" class="btn btn-success">EDITAR</a></td>
                         <td><a href="{{url('empresa-show',$data->id)}}" class="btn btn-info">ENTRAR</a></td>
                        <td>{{$data->nombre}}</td>
                        <td>{{$data->nit}}</td>
                        <td>{{$data->ciudad}}</td>
                        <td>{{$data->direccion}}</td>
                        <td>{{$data->telefono}}</td>
                        <td>{{$data->tipo_regimen_id}}</td>
                        <td>{{$data->actividad_economica}}</td>

                     </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
@endsection
