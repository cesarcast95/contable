@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px">
                            <div class="header">
                                <h4 class="title">EDITAR TRABAJADOR </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                        {!! Form::model($trabajadores, [
                                    'method' => 'PATCH',
                                    'route' => ['trabajadores.update', $trabajadores]
                                ]) !!}
                                    
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>NOMBRE</label>
                                                {!! 
                                                    Form::text(
                                                        'nombre', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>CEDULA</label>
                                                {!! 
                                                    Form::text(
                                                        'cedula',
                                                         null,
                                                        array(
                                                            'class'=>'form-control'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>DIRECCION</label>
                                                {!! 
                                                    Form::text(
                                                        'direccion', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>

                                          <div class="col-md-6">
                                            <div class="form-group">

                                                <label>TELEFONO</label>
                                                {!! 
                                                    Form::text(
                                                        'telefono', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>
                             
                                    </div>

                                    <div class="clearfix"></div>
                                        
                       
                        <div class="form-group">
                            {!! Form::submit('GUARDAR', array('class'=>'btn btn-primary')) !!}
                        </div>
                    
                    {!! Form::close() !!}
                            </div>
                        </div>
  </div>
@endsection