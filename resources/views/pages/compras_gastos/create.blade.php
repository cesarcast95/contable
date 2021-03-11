@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px;">
                            <div class="header">
                                <h4 class="title">EGRESOS </h4>
                            </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                       {!! Form::open(['route'=>'compras_gastos.store']) !!}
                                    
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>MOVIMIENTO</label>
                                                {!! Form::select('nombre', $tipo_movimiento, null, ['class' => 'form-control']) !!}
                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>CUENTA</label>
                                                 {!! Form::select('cuenta', $tipo_cuenta, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label>DETALLE MOVIMIENTO</label>
                                                {!! 
                                                    Form::textarea(
                                                        'detalle', 
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

                                                <label>ASIENTO</label>
                                                 {!! Form::select('pago', $tipo_pago, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>VALOR</label>
                                                {!! 
                                                    Form::text(
                                                        'acomulado_haber', 
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
                                                        'fecha', 
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

                                                <label>ESTADO</label>
                                                {!! Form::select('tipo_estado', $tipo, null, ['class' => 'form-control']) !!}
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