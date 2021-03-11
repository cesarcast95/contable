@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px;">
                            <div class="header">
                                <h4 class="title">EDITAR COMPROBANTE </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">

                          {!! Form::model($comprobante, [
                                    'method' => 'PATCH',
                                    'route' => ['comprobante.update', $comprobante]
                                ]) !!}

                                     <div class="row">
                                          <div class="col-md-3">
                                            <div class="form-group">

                                                <label>CÓDIGO</label>
                                                {!! 
                                                    Form::text(
                                                        'codigo', 
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

                                                <label>COMPROBANTE</label>
                                                {!! Form::select('tipo_dato', $tipo_dato, null, ['class' => 'form-control  buscador', 'data-live-search'=>'true']) !!}
                                          </div>
                                        </div>

                                       

                                        <div class="col-md-2">
                                            <div class="form-group">

                                                <label>TERCERO</label>
                                                {!! Form::select('tercero_id', $tercero, null, ['class' => 'form-control  buscador', 'data-live-search'=>'true']) !!}
                                          </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>CAJA</label>
                                                {!! Form::select('caja', $tipo_cuenta, null, ['class' => 'form-control  buscador', 'data-live-search'=>'true']) !!}
                                          </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">

                                                <label>VALOR</label>
                                                {!! 
                                                    Form::number(
                                                        'valor', 
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
                                         <div class="col-md-4">
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
                                        
                                         <div class="col-md-8">
                                            <div class="form-group">

                                                <label>DETALLE</label>
                                                {!! 
                                                    Form::text(
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

                                    
                                    <div class="clearfix"></div>
                                        
                                        
                       
                        <div class="form-group">
                            {!! Form::submit('ACTULIZAR', array('class'=>'btn btn-primary')) !!}
                        </div>
                    
                    {!! Form::close() !!}
                            </div>
                        </div>
  </div>
@endsection