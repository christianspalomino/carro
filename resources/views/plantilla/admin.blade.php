<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('titulo')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->

  @yield('estilos')
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <div id="api_search_autocomplete"> 
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="  $editar= 'si';" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search"
        name="nombre"
        v-model="palabra_a_buscar"
        v-on:keyup="autoComplete"
        
        >
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      <a href="{{route('tienda.index')}}">Tienda</a>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa fa-power-off"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
           <a href="{{ route('logout')}}" class="dropdown-item dropdown-footer">
           Salir
          </a>
      </li>
   

    </ul>
  </nav>
  <!-- /.navbar -->

  {{-- v-if="resultados" si tenemos en la variable resultados auq sea un caracter se mostrara el div --}}

     {{--  v-for="" por la variable resultados en resultados es la variable resultados de api_search_autocomplete y si hay registros aparecera las etiqueta li --}}

   {{--   v-on:click.prevent="" ejecutar.. la variable palabra_a_buscar va ser igual a resultado.nombre --}}

      {{-- vhtml="resultado.name_negrita" mostar lo q tengamos en resultados pero en negrita --}}
   <div class="panel-footer" v-if="resultados.length">
    <ul class="list-group" style="align-items:center;  justify-content:center;">
      <li class="list-group-item" v-for="resultado in resultados">
         <a href="#" class="dropdown-item" v-on:click.prevent="palabra_a_buscar=resultado.nombre"> 
           <span v-html="resultado.name_negrita">

           </span>
         </a>
      </li>

    </ul>

    </div>
</div>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">NHL-PRUEBA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">

          <a href="#" class="d-block">Bienvenido: {{ Auth::user()->name}}</a>
          <li role="separator" class="divider"></li>
                   
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          {{-- Categorías --}}
          <li class="nav-item has-treeview">
            <a href="{{route('admin.categoria.index')}}" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Categorías
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.categoria.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de Categorías</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.categoria.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear Categorías</p>
                </a>
              </li>
            </ul>
          </li>
            
          {{-- PRODUCTOS --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.producto.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.producto.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear Productos</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Pedidos --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Pedidos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.pedido.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de Pedidos</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('titulo')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>

              @yield('breadcrumb')
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      
     {{--  si en la variable seccion y en la variable datos hay informacion mostrara el div  --}}
      @if(session('datos'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" >
          {{ session('datos')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times</span>
          </button>
        </div>
      @endif

      {{-- ALERTA CANCELADO --}}
      @if(session('cancelar'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" >
          {{ session('cancelar')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times</span>
          </button>
        </div>
      @endif

      {{-- mensaje error --}}
      @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @yield('contenido')
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.2-pre
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>

 <!--SWEETALERT2-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!--SWEETALERT2-->
  
<!-- configuraciones de vuejs -->
<script src="{{ asset('js/app_admin.js') }}" defer></script>
@yield('script')
</body>
</html>
