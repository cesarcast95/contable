<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    TI CONTABLE
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->

  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />

  <link href="{{asset('css/main.css')}}" rel="stylesheet" />

  <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />


  
  <link href="{{asset('assets/css/paper-dashboard.css?v=2.0.0')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet" />
  <link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
  {{-- Notificaciones --}}
  <link rel="stylesheet" href="{{asset('css/toastr/toastr.min.css')}}">
</head>


<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
        {{$empresa = App\Empresas::find(Auth::user()->empresa_id_temp)}}
    -->
      <div class="logo">
     
        <a href="#" class="simple-text logo-normal">
          TI CONTABLE
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="{{url('empresa-show', Auth::user()->empresa_id_temp)}}">
              <i class="nc-icon nc-bank"></i>
              <p>EMPRESA</p>
            </a>
          </li>

          @if($empresa->tipo_empresa != 45)

           <li>
            <a href="{{route('ventas.create')}}">
              <i class="nc-icon nc-money-coins"></i>
              <p>VENTAS</p>
            </a>
          </li>

          <li>
            <a href="{{route('categoria.index')}}">
              <i class="nc-icon nc-layout-11"></i>
              <p>CATEGORÍA</p>
            </a>
          </li>

           <li>
            <a href="{{route('productos.index')}}">
              <i class="nc-icon nc-diamond"></i>
              <p>PRODUCTOS</p>
            </a>
          </li>

          <li>
            <a href="{{route('inventario.index')}}">
              <i class="nc-icon nc-box-2"></i>
              <p>INVENTARIO</p>
            </a>
          </li>

          <li>
            <a href="{{route('ingreso_producto.index')}}">
              <i class="nc-icon nc-app"></i>
              <p>INGRESO PRODUCTO</p>
            </a>
          </li>

          @endif

          <li>
            <a href="{{route('comprobante.index')}}">
              <i class="nc-icon nc-globe-2"></i>
              <p>COMPROBANTES</p>
            </a>
          </li>
  

          
         
     
          <li>
            <a href="{{route('clientes.index')}}">
              <i class="nc-icon nc-bell-55"></i>
              <p>CLIENTES</p>
            </a>
          </li>
          <li>
            <a href="{{route('trabajadores.index')}}">
              <i class="nc-icon nc-single-02"></i>
              <p>TRABAJADORES</p>
            </a>
          </li>

           <li>
            <a href="{{route('terceros.index')}}">
              <i class="nc-icon nc-world-2"></i>
              <p>TERCEROS</p>
            </a>
          </li>

          <li>
            <a href="{{route('proveedor.index')}}">
              <i class="nc-icon nc-shop"></i>
              <p>PROVEEDOR</p>
            </a>
          </li>

      
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#">{{$empresa->nombre}}</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           <!-- <ul class="navbar-nav">
              
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link btn-rotate" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  EGRESO
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{route('compras_gastos.index')}}">PAGOS</a>
                  <a class="dropdown-item" href="{{route('pagos.index')}}">TRABAJADOR</a>
                  <a class="dropdown-item" href="{{route('cobros.index')}}">PRESTAMOS</a>
                 
                </div>
              </li>
           
            </ul>-->

           <!--  <ul class="navbar-nav">
            
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link btn-rotate" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  INGRESO
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  @if($empresa->tipo_empresa != 45)
                  <a class="dropdown-item" href="{{route('ventas.index')}}">VENTAS</a>
                  @endif
                  <a class="dropdown-item" href="{{url('cobros-show')}}">CUENTAS POR COBRAR</a>
               
                </div>
              </li>
           
            </ul> -->

            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bullet-list-67"></i> CUENTAS
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{route('cuentas_pagar.index')}}">
                   CUENTAS POR PAGAR
                  </a>
                  <a class="dropdown-item" href="{{route('cobros.index')}}">CUENTAS DE PRESTAMOS</a>
                  <a class="dropdown-item" href="{{url('cobros-show')}}">CUENTAS POR COBRAR</a>
                  <a class="dropdown-item" href="{{route('pagos.index')}}">CUENTAS TRABAJADORES</a>
                </div>
              </li>
            </ul>
             <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="nc-icon nc-paper"></i> INFORMES
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{url('informe-estado')}}">ESTADO DE EMPRESA</a>
                    <a class="dropdown-item" href="{{url('ventas_rango')}}">SEGUIMIENTO DE VENTAS</a>
                    <a class="dropdown-item" href="{{url('show_resultado')}}">ESTADO RESULTADO</a>
                    <a class="dropdown-item" href="{{url('recaudo_cartera')}}">RECAUDO DE CARTERA</a>
                    <a class="dropdown-item" href="{{url('presupuesto_gastos')}}">BALANCE GENERAL</a>
                   
                  </div>
                </li>
            </ul>

              <ul class="navbar-nav">
            
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link btn-rotate" href="{{ url('/') }}" aria-expanded="false">
                  SALIR
                </a>
            </ul>
          </div>
        </div>
      </nav>

      <div class="content">
        <div class="row">
          @yield('content')
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
          
            <div class="credits ml-auto">
              <span class="copyright">
                DEUR
                <script>
                  document.write(new Date().getFullYear())
                </script><i class="fa fa-heart heart"></i> 
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>

  <!-- Chart JS -->
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/paper-dashboard.min.js?v=2.0.0')}}" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{asset('assets/demo/demo.js')}}"></script>
  <script src="{{asset('js/moment.min.js')}}"></script>
  <script src="{{asset('js/daterangepicker.js')}}"></script>
   <script src="{{asset('js/script.js')}}"></script>
   <script src="{{asset('js/bootstrap-select.min.js')}}"></script>

      {{-- Librerías para las notificaciones, para el delete y mostrar mensaje superior derecho verde --}}
      <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
      <script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
      
      {{-- Funciones de notificacionees y de más --}}
      <script src="{{asset('assets/js/scripts.js')}}"></script>
      <script type="text/javascript" src="{{asset('assets/js/funciones.js')}}"></script>


  @yield("scripts")

</body>

</html>