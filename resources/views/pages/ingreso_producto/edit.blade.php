@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px;">
                            <div class="header">
                                <h4 class="title">EDITAR INGRESO PRODUCTOS </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                 
                          {!! Form::model($ingreso_producto, [
                                    'method' => 'PATCH',
                                    'route' => ['ingreso_producto.update', $ingreso_producto]
                                ]) !!}


                                     <div class="row">

                                        <div class="col-md-2">
                                            <div class="form-group">

                                                <label>CAJA</label>
                                                {!! Form::select('caja', $caja_tipo, null, ['class' => 'form-control  buscador', 'data-live-search'=>'true']) !!}
                                          </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>PROVEEDOR</label>
                                                {!! Form::select('proveedor_id', $proveedor, null, ['class' => 'form-control  buscador', 'data-live-search'=>'true']) !!}
                                          </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>PRODUCTO</label>
                                                {!! Form::select('producto_id', $productos, null, ['class' => 'form-control  buscador', 'data-live-search'=>'true']) !!}
                                          </div>
                                        </div>

                                          <div class="col-md-2">
                                            <div class="form-group">

                                                <label>UBICACION</label>
                                                {!! Form::select('tipo_ingreso', $tipo_ingreso, null, ['class' => 'form-control  buscador', 'data-live-search'=>'true']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">

                                                <label>CANTIDAD</label>
                                                {!! 
                                                    Form::number(
                                                        'cantidad', 
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
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>FECHA INGRESO</label>
                                                {!! 
                                                    Form::date(
                                                        'fecha_ingreso', 
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