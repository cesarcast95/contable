@extends('layouts.app')
@section('content')
<div style="background: #efef; height: 100%;">
 <div class="col-md-8" style="margin-left:20%;">
                        <div class="card" style="padding: 20px">
                            <div class="header">
                                <h4 class="title">EDITAR EMPRESA </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                      {!! Form::model($empresa, [
                                    'method' => 'PATCH',
                                    'route' => ['empresa.update', $empresa]
                                ]) !!}
                                    
                                     <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">

                                               <label>TIPO EMPRESA</label>
                                                
                                                {!! Form::select('tipo_empresa', $tipo_empresa, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <label>NOMBRE</label>
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

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>NIT</label>
                                                {!! 
                                                    Form::text(
                                                        'nit', 
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

                                                <label>CIUDAD</label>
                                                {!! 
                                                    Form::text(
                                                        'ciudad', 
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

                                                <label>DIRECCION</label>
                                                {!! 
                                                    Form::text(
                                                        'direccion', 
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

                                                <label>TELEFONO</label>
                                                {!! 
                                                    Form::text(
                                                        'telefono', 
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

                                                <label>TIPO REGIMEN</label>
                                                
                            					{!! Form::select('tipo_regimen_id', $tipo, null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>COD ACTIVIDAD ECONOMICA</label>
                                                {!! 
                                                    Form::text(
                                                        'actividad_economica', 
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
                                                <label>CAJA MAYOR</label>
                                                {!! 
                                                    Form::text(
                                                        'caja_mayor', 
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
                                                <label>CAJA MENOR</label>
                                                {!! 
                                                    Form::text(
                                                        'caja_menor', 
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
                                                <label>BANCO</label>
                                                {!! 
                                                    Form::text(
                                                        'banco', 
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
</div>

@endsection