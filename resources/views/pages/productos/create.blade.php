@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px">
                            <div class="header">
                                <h4 class="title">CREAR PRODUCTO </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                       {!! Form::open(['route'=>'productos.store']) !!}
                                    

                                    <div class="row">


                                         <div class="col-md-2">
                                            <div class="form-group">

                                                <label>COD</label>
                                                {!! 
                                                    Form::text(
                                                        'cod', 
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

                                                <label>CATEGORÍA</label>
                                                {!! Form::select('categoria_id', $categoria, null, ['class' => 'form-control buscador',
                                                'data-live-search'=>'true']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label>NOMBRE PRODUCTO</label>
                                                {!!
                                                Form::text(
                                                'nombre',
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

                                                <label>IMPUESTO</label>
                                                {!!
                                                    Form::number(
                                                    'impuesto',
                                                    null,
                                                    array(
                                                    'class'=>'form-control'))
                                                !!}
                                            </div>
                                        </div>

                                    </div>
                                     <div class="row">
                                      

                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>PRECIO UTILIDAD</label>
                                                {!! 
                                                    Form::number(
                                                        'precio_utilidad', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control',
                                                            'step' => 'any'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>

                                    

                                        <div class="col-md-3">
                                            <div class="form-group">
                                 
                                                <label>
                                                {!! 
                                                    Form::checkbox(
                                                        'ganancia_activada', 
                                                        null, 
                                                        array(
                                                            'class'=>'form-check-input',
                                                        )
                                                    ) 
                                                !!} PORCENTAJE GANANCIA    

                                            </label>
                                                {!! 
                                                    Form::number(
                                                        'porcentaje_ganancia', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control',
                                                            'step' => 'any'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>
                                                {!! 
                                                    Form::checkbox(
                                                        'descuento_activado', 
                                                        null, 
                                                        array(
                                                            'class'=>'form-check-input',
                                                        )
                                                    ) 
                                                !!} DESCUENTO

                                                 </label>
                                                {!! 
                                                    Form::number(
                                                        'descuento', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control',
                                                            'step' => 'any'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>
                                                {!! 
                                                    Form::checkbox(
                                                        'promocion_activada', 
                                                        null, 
                                                        array(
                                                            'class'=>'form-check-input',
                                                        )
                                                    ) 
                                                !!} PROMOCIÓN
                                                </label>
                                                {!! 
                                                    Form::number(
                                                        'promocion', 
                                                         null,
                                                        array(
                                                            'class'=>'form-control',
                                                            'step' => 'any'
                                                        )
                                                    ) 
                                                !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label>DESCRIPCION</label>
                                                {!! 
                                                    Form::textarea(
                                                        'descripcion', 
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