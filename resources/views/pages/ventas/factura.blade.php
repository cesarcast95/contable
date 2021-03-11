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

                @if(isset($message) and !empty($message))
                  @include('pages.partials.message')
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
                                                         $consecutivo,
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
                                                  {!! 
                                                    Form::text(
                                                        'tipo_transaccion_id', 
                                                        $transaccion,
                                                        array(
                                                            'class'=>'form-control', 'readonly' => 'readonly'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>CAJA</label>
                                                 
                                                 {!! 
                                                    Form::text(
                                                        'caja_tipo', 
                                                        $caja,
                                                        array(
                                                            'class'=>'form-control', 'readonly' => 'readonly'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>UBICACIÓN</label>
                                                {!! 
                                                    Form::text(
                                                        'tipo_estado_id', 
                                                        $estado,
                                                        array(
                                                            'class'=>'form-control', 'readonly' => 'readonly'
                                                        )
                                                    ) 
                                                !!}
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
                                                <label>COD CLIENTE</label>
                            				      {!! 
                                                    Form::text(
                                                        'cliente_id', 
                                                        $cliente->id,
                                                        array(
                                                            'class'=>'form-control', 'readonly' => 'readonly'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>

                                    
                                    </div>

                                    <div class="row">
                                         <div class="col-md-6">
                                             <label>FECHA ELABORACION</label>
                                                {!! 
                                                    Form::text(
                                                        'fecha_elaboracion', 
                                                         $fecha,
                                                        array(
                                                            'class'=>'form-control',
                                                            'readonly' => 'readonly'
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
          <p><b>CLIENTE: {{$cliente->nombre}}</b></p>
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
                @foreach($factura as $data)
                   <!--{{$producto = App\Producto::find($data->producto_id)}}-->
                      <tr>
                        <td>{{$producto->cod}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td><center>{{$data->cantidad}}</center></td>
                        <td>${{number_format($data->total)}}</td>
                         <td>
                          {!! Form::open(['route' => ['ventas.destroy', $data->id]]) !!}
                            <input type="hidden" name="_method" value="DELETE">
                             <center> <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger" style="font-size: 35px; padding: 2px; background: none; color:#F25959; ">
                             <i class="nc-icon nc-basket"></i>
                            </button></center>
                          {!! Form::close() !!}
                        </td>
                       
                     </tr>
               
                   
               @endforeach
                 </tbody>
                </table>

                <a href="{{url('factura_venta',$consecutivo)}}" class="btn btn-info">FACTURAR</a>
            
            </div>


            <hr>
            <p>
            

            
            </p>
         </div>
         
          </div>
    </div>
</div>
@endsection