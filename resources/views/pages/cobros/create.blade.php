@extends('template')
@section('content')
 <div class="col-md-12">
                        <div class="card" style="padding: 20px">
                            <div class="header">
                                <h4 class="title">CREAR PRESTAMOS </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                       {!! Form::open(['route'=>'cobros.store']) !!}
                                    
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>TERCERO</label>
                                                 {!! Form::select('tercero', $tercero, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>VALOR</label>
                                                {!! 
                                                    Form::text(
                                                        'libramiento', 
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

                                                <label>FECHA</label>
                                                {!! 
                                                    Form::date(
                                                        'vencimiento', 
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

                                                <label>CAJA</label>
                                                {!! Form::select('caja', $tipo, null, ['class' => 'form-control']) !!}
                                          </div>
                                        </div>
                                    </div>
                                    </div>


                                    <div class="clearfix"></div>
                                        
                       
                        <div class="form-group">
                            {!! Form::submit('CREAR', array('class'=>'btn btn-primary')) !!}
                        </div>
                    
                    {!! Form::close() !!}
                            </div>
                        </div>
  </div>

@endsection