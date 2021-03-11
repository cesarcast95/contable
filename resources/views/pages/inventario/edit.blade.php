@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px;">
                            <div class="header">
                                <h4 class="title">EDITAR INVENTARIO </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                        {!! Form::model($inventario, [
                                    'method' => 'PATCH',
                                    'route' => ['inventario.update', $inventario]
                                ]) !!}
                                     <div class="row">

                                        <div class="col-md-2">
                                            <div class="form-group">

                                                <label>CODIGO</label>
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

                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>PRODUCTO</label>
                                                {!! Form::select('producto_id', $productos, null, ['class' => 'form-control  buscador', 'data-live-search'=>'true']) !!}
                                          </div>
                                        </div>

                                       

                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>MINIMO</label>
                                                {!! 
                                                    Form::number(
                                                        'minimo', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>MAXIMO</label>
                                                {!! 
                                                    Form::number(
                                                        'maximo', 
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

                                                <label>CANTIDAD ALMACEN</label>
                                                {!! 
                                                    Form::number(
                                                        'almacen', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>CANTIDAD BODEGA</label>
                                                {!! 
                                                    Form::number(
                                                        'bodega', 
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