@extends('template')
@section('content')

 <div class="col-md-12">
                        <div class="card" style="padding: 20px">
                            <div class="header">
                                <h4 class="title">CREAR CATEGORIA </h4>
                        </div>
                          
                             @if (count($errors) > 0)
                                @include('pages.partials.errors')
                             @endif
                            
                            <div class="content">
                          {!! Form::open(['route'=>'categoria.store']) !!}
                                    
                                     <div class="row">
                                        <div class="col-md-6">
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
                                             <label></label>
                                             <div class="form-group">
                                                {!! Form::submit('CREAR', array('class'=>'btn btn-primary')) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                        
                       
                                           
                    {!! Form::close() !!}
                            </div>
                        </div>
  </div>
@endsection