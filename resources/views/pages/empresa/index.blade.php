@extends('template')
@section('content')

<div class="row">

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-info">
                      <i class="nc-icon nc-globe text-info"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">CAJA MAYOR</p>
                      <p style="font-size: 18px;">$ {{number_format($empresa->caja_mayor)}}
                        </p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="#">MOVIMIENTO DE CAJA</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">CAJA MENOR</p>
                      <p style="font-size: 18px;">$ {{number_format($empresa->caja_menor)}}
                        </p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="#">MOVIMIENTO DE CAJA</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-bank text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                       <p class="card-category">CAJA BANCO</p>
                      <p style="font-size: 18px;">$ {{number_format($empresa->banco)}}
                        </p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="#">MOVIMIENTO DE CAJA</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-diamond text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">LIMITE DE AGOTAR</p>
                      <p style="font-size: 18px">{{count($inventario)}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                   <a href="{{url('limite_agotar')}}">LISTADO PRODUCTOS</a>
                </div>
              </div>
            </div>
          </div>
        
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="../assets/img/damir-bosnjak.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="../assets/img/logo-small.png" alt="...">
                    <h5 class="title">{{$empresa->nombre}}</h5>
                  </a>
                  <p>
                    NIT: {{$empresa->nit}}
                  </p>
                   <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-md-6"> 
                      <p>TRABAJADORES</p>
                      <p><center>{{count($trabajadores)}}</center></p>
                    </div>
                   <div class="col-md-6"> 
                      <p>CLIENTES</p>
                      <p><center>{{count($clientes)}}</center></p>
                  </div>
                
                  </div>
                  <div class="row">
                    <div class="col-md-6"> 
                      <p>PROVEEDORES</p>
                      <p><center>{{count($proveedores)}}</center></p>
                    </div>
                   <div class="col-md-6"> 
                      <p>TERCEROS</p>
                      <p><center>{{count($terceros)}}</center></p>
                  </div>
                
                  </div>

                </div>
              </div>
             
              </div>
            </div>
   
          </div>
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">DATOS DE LA EMPRESA</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>NOMBRE</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="{{$empresa->nombre}}">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>DIRECCION</label>
                        <input type="text" class="form-control" placeholder="Username" value="{{$empresa->direccion}}">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">TELEFONO</label>
                        <input type="email" class="form-control" placeholder="{{$empresa->telefono}}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>TIPO REGIMEN</label>
                        <input type="text" class="form-control" placeholder="Company" value="{{$empresa->tipo_regimen_id}}">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>ACTIVIDAD ECONOMICA</label>
                        <input type="text" class="form-control" placeholder="Last Name" value="{{$empresa->actividad_economica}}">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <a href="{{route('empresa.edit', $empresa->id)}}" class="btn btn-primary btn-round">ACTUALIZAR</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
@endsection