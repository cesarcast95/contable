@extends('layouts.app')

@section('content')
 <div class="container text-center">
        <div class="page-header">
            <h1><i class="fa fa-rocket"></i> Panel De Administración</h1>
        </div>
        
        <h2>IT CONTABLE</h2><hr>
        
        <div class="row">
            
            <div class="col-md-6">
                <div class="panel">
                    <i class="fa fa-list-alt icon-home"></i>
                    <a href="#" class="btn btn-warning btn-block btn-home-admin">ESTANTERÍAS</a>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="panel">
                    <i class="fa fa-shopping-cart  icon-home"></i>
                    <a href="#" class="btn btn-warning btn-block btn-home-admin">SECCIÓN DE DEPENDENCIAS</a>
                </div>
            </div>
                    
        </div>
        
        <div class="row">
            
            <div class="col-md-6">
                <div class="panel">
                    <i class="fa fa-cc-paypal  icon-home"></i>
                    <a href="#" class="btn btn-warning btn-block btn-home-admin">PRESTAMOS</a>
                </div>
            </div> 
            
            <div class="col-md-6">
                <div class="panel">
                    <i class="fa fa-users  icon-home"></i>
                    <a href="#" class="btn btn-warning btn-block btn-home-admin">TRANSFERENCIAS</a>
                </div>
            </div>

             <div class="col-md-6">
                <div class="panel">
                    <i class="fa fa-users  icon-home"></i>
                    <a href="#" class="btn btn-warning btn-block btn-home-admin">TRANSFERENCIAS DE DOCUMENTOS</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel">
                    <i class="fa fa-users  icon-home"></i>
                    <a href="#" class="btn btn-warning btn-block btn-home-admin">USUARIOS</a>
                </div>
            </div>
                    
        </div>
        
    </div>
    <hr>
@endsection
