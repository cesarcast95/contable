@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px;">
                            <div class="header">
                                <h4 class="title">EDITAR PAGOS </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                        {!! Form::model($pagos, [
                                    'method' => 'PATCH',
                                    'route' => ['pagos.update', $pagos]
                                ]) !!}
                                     <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">

                                                <label>TRABAJADOR</label>
                                                {!! Form::select('trabajador_id', $trabajador, null, ['class' => 'form-control']) !!}
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

                                    </div>

                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>MOVIMIENTO</label>
                                                {!! Form::select('movimiento', $tipo_movimiento, null, ['class' => 'form-control']) !!}
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

                                                <label>DETALLE DE MOVIMIENTO</label>
                                                {!! 
                                                    Form::textarea(
                                                        'observacion', 
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

                                    </div>
                                    <div class="clearfix"></div>
                                        
                                        
                       
                        <div class="form-group">
                            {!! Form::submit('EDITAR', array('class'=>'btn btn-primary')) !!}
                        </div>
                    
                    {!! Form::close() !!}
                            </div>
                        </div>
  </div>
@endsection