@extends('template')
@section('content')

 <div class="col-md-7">
            <div class="card" style="padding: 20px">

                <div class="header">
                    <h4 class="title">VENTAS</h4>
                </div>
              
                 @if (count($errors) > 0)
                    @include('pages.partials.errors')
                 @endif

                     <div class="content">
                           {!! Form::open(['route'=>'ventas.store']) !!}

                                     <div class="row">

                                         <div class="col-md-2">
                                            <div class="form-group">

                                                <label>CON</label>
                                                 
                                                {!! 
                                                    Form::text(
                                                        'consecutivo', 
                                                         $consecutivo->numero,
                                                        array(
                                                            'class'=>'form-control', 'readonly' => 'readonly'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>
                              

                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>TRANSACCIÓN</label>
                                                 
                                                {!! Form::select('tipo_transaccion_id', $transaccion, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>CAJA</label>
                                                 
                                                {!! Form::select('caja_tipo', $caja, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>UBICACIÓN</label>
                                                    
                                                {!! Form::select('tipo_estado_id', $estado, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                   

                                      
                                    </div>

                
                                    <div class="row">
                                      

                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>PRODUCTO</label>
                                                {!! Form::select('producto_id', $producto, null,['class' => 'form-control buscador selectpicker', 'data-live-search'=>'true']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
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

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>CLIENTE</label>
                            					{!! Form::select('cliente_id', $cliente, null, ['class' => 'form-control buscador selectpicker', 'data-live-search'=>'true']) !!}
                                            </div>
                                        </div>

                                    
                                    </div>

                                    <div class="row">
                                         <div class="col-md-6">
                                             <label>FECHA ELABORACION</label>
                                                {!! 
                                                    Form::date(
                                                        'fecha_elaboracion', 
                                                         $fecha,
                                                        array(
                                                            'class'=>'form-control'
                                                        )
                                                    ) 
                                                !!}
                                         </div>
                                    </div>
                               

                                   
                    

                                    <div class="clearfix"></div>
                                       <br> 
                       
                                    <div class="form-group">
                                        {!! Form::submit('LISTAR', array('class'=>'btn btn-primary')) !!}
                                    </div>
                                
                                {!! Form::close() !!}
                     </div>
            </div>
  </div>

<div class="col-md-5">
    <div class="card" style="padding: 20px 5px 0px 5px">
          <div class="header">
             <center><h5 class="title">PRODUCTOS</h5></center>
          </div>
          <div class="content">    
           <div class="table-cart">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th><center>COD</center></th>
                            <th><center>PRO</center></th>
                            <th><center>CANT</center></th>
                            <th><center>TOTAL</center></th>
                            <th><center>X</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                
                        </tr>
                    </tbody>
                </table><hr>
            
            </div>


            <hr>
            <p>
            

            
            </p>
         </div>
         
          </div>
    </div>
</div>
@endsection