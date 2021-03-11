@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px">
                            <div class="header">
                                <h4 class="title">EDITAR VENTA </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
              
                       {!! Form::model($ventas, [
                                    'method' => 'PATCH',
                                    'route' => ['ventas.update', $ventas]
                                ]) !!}



                                    
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>TIPO DE TRANSACCION</label>
                                                 
                                                {!! Form::select('tipo_transaccion_id', $tipo, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>CAJA</label>
                                                 
                                                {!! Form::select('caja_tipo', $caja, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>CANTIDAD</label>
                                                {!! 
                                                    Form::text(
                                                        'cantidad', 
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

                                                <label>ESTADO</label>
                                                    
                                                {!! Form::select('tipo_estado_id', $tipo2, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                          <div class="col-md-4">
                                            <div class="form-group">

                                                <label>SUCURSAL</label>
                                                {!! 
                                                    Form::text(
                                                        'sucursal', 
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

                                                <label>CLIENTE</label>
                                                
                                                {!! Form::select('cliente_id', $cliente, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>PRODUCTO</label>
                                                {!! Form::select('producto_id', $producto, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                             
                                    </div>

                                    <div class="row">
                                         <div class="col-md-6">
                                             <label>FECHA ELABORACION</label>
                                                {!! 
                                                    Form::date(
                                                        'fecha_elaboracion', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control'
                                                        )
                                                    ) 
                                                !!}
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