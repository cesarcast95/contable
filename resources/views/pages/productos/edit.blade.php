@extends('template')
@section('content')

<<<<<<< HEAD
<div class="col-md-12">
    <div class="card" style="padding: 20px">
        <div class="header">
            <h4 class="title">EDITAR TRABAJADOR </h4>
        </div>

        @if (count($errors) > 0)
        @include('pages.partials.errors')
        @endif

        <div class="content">
            {!! Form::model($productos, [
            'method' => 'PATCH',
            'route' => ['productos.update', $productos]
            ]) !!}

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
                            Form::text(
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
        
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="ganancia_activada" id="ganancia_id"
                                            {{ $productos->ganancia_activada ? 'checked' : '' }} class=""
                                            data-id={{$productos->id}}>
        
                                        PORCENTAJE GANANCIA
        
                                    </label>
                                </div>
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
                                
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="descuento_activado" id="descuento_id"
                                            {{ $productos->descuento_activado ? 'checked' : '' }} class=""
                                            data-id={{$productos->id}}>
        
                                            DESCUENTO
        
                                    </label>
      
                                </div>
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
        
        
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="promocion_activada" id="promocion_id"
                                            {{ $productos->promocion_activada ? 'checked' : '' }} class=""
                                            data-id={{$productos->id}}>
        
                                            PROMOCIÓN
        
                                    </label>
                                </div>
        
        
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
                {!! Form::submit('ACTULIZAR', array('class'=>'btn btn-primary')) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset("assets/pages/scripts/producto/completed.js") }}"> </script>
@endsection
