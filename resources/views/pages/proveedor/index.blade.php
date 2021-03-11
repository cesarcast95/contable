@extends('template')
@section('content')

          <div class="col-md-12">
            <div class="card" style="padding: 20px">
              <div class="card-header">
                <h4 class="card-title">PROVEEDOR</h4>
               @if(\Session::has('message'))
                   @include('pages.partials.message')
                 @endif
             
                @if(isset($message))
                  @include('pages.partials.message')
                @endif

               <div class="row">
                  <div class="col-md-2">
               
                      <a href="{{route('proveedor.create')}}" class="btn btn-info" style="width: 100%">CREAR</a>
                  </div>
                  <div class="col-md-10" style="padding-top: 10px;"> 
                   <div style="display: block; float:right;">
                    {{Form::open(array(
                         'action' => 'ProveedorController@filtro_proveedor',
                         'method' => 'GET',
                         'role'   => 'form',
                         'class'  => 'form-inline'
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
                      <th>NOMBRE</th>
                      <th>DIRECCION</th>
                      <th>TELEFONO</th>
                      <th>EMAIL</th>
                       <th><center>ELIMINAR</center></th>
                    </thead>
                    <tbody>
                    @foreach($proveedor as $data)
                      <tr>
                        <td>
                        <center>
                          <a href="{{route('proveedor.edit', $data->id)}}" style="font-size: 35px; padding: 2px; padding-bottom: 0px;">
                               <i class="nc-icon nc-settings-gear-65"></i>
                             </a>
                        </center>
                        </td>
                        <td><center>{{$data->id}}</center></td>
                        <td>{{$data->nombre}}</td>
                        <td>{{$data->direccion}}</td>
                        <td>{{$data->celular}}</td>
                        <td>{{$data->email}}</td>
                        <td>
                          {!! Form::open(['route' => ['proveedor.destroy', $data->id]]) !!}
                            <input type="hidden" name="_method" value="DELETE">
                             <center> <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger" style="font-size: 35px; padding: 2px; background: #fff; color:#F25959; ">
                             <i class="nc-icon nc-basket"></i>
                            </button></center>
                          {!! Form::close() !!}
                        </td>

                     </tr>
                    @endforeach
                    {{ $proveedor->appends(request()->input())->links() }}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

@endsection