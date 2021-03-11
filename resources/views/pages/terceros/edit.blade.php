@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px">
                            <div class="header">
                                <h4 class="title">EDITAR TERCERO </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                       {!! Form::model($terceros, [
                                    'method' => 'PATCH',
                                    'route' => ['terceros.update', $terceros]
                                ]) !!}
                                    
                                     <div class="row">

                                     <div class="col-md-4">
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

                                   
                                        <div class="col-md-4">
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

                                          <div class="col-md-2">
                                            <div class="form-group">

                                                <label>TELEFONO</label>
                                                {!! 
                                                    Form::number(
                                                        'celular', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>

                                        <div class="col-md-2" style="margin-top:14px">

                                             <div class="form-group">
                                                {!! Form::submit('CREAR', array('class'=>'btn btn-primary')) !!}
                                            </div>
                                        </div>
                             
                                    </div>

                                    <div class="clearfix"></div>
                                        
                       
                        <div class="form-group">
                            {!! Form::submit('ACTULIZAR', array('class'=>'btn btn-primary')) !!}
                        </div>
                    
                    {!! Form::close() !!}
                            </div>
                        </div>
  </div>
@endsection