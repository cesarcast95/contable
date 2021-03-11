@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px;">
                            <div class="header">
                                <h4 class="title">CUENTAS POR PAGAR </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                       {!! Form::open(['route'=>'cuentas_pagar.store']) !!}
                                    
                                    <div class="row">
                                          <div class="col-md-4">
                                            <div class="form-group">

                                                <label>TERCERO</label>
                                                {!! Form::select('tercero', $tercero, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                          <div class="col-md-4">
                                            <div class="form-group">

                                                <label>VALOR</label>
                                                {!! 
                                                    Form::text(
                                                        'valor', 
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

                                                <label>MOVIMIENTO</label>
                                                {!! Form::select('caja', $caja, null, ['class' => 'form-control']) !!}
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