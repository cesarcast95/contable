@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px;">
                            <div class="header">
                                <h4 class="title">SEGUIMIENTO DE VENTAS</h4>
                        </div>

                         <div class="col-md-6" style="float:right;">
		                    {{Form::open(array(
		                        'action' => 'ControllerVentas@rango_venta',
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


@endsection