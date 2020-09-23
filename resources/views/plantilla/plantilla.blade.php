<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>@yield('titulo')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Tienda online template">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	
	<link href="{{ asset('css/all.css') }}" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="{{ asset('asset/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">

@yield('estilos')



</head>
<body>

<div id="app">
 
<!-- Menu -->

<div class="menu">

	<!-- Search -->
	<div class="menu_search">
		<form action="#" id="menu_search_form" class="menu_search_form">
			<input type="text" class="search_input" placeholder="Buscar Producto" required="required">
			<button class="menu_search_button"><img src="{{ asset('asset/images/search.png')}}" alt=""></button>
		</form>
	</div>
	<!-- Navigation -->
	<div class="menu_nav">
		<ul>
			<li><a href="{{route('tienda.index')}}">Nuestros Productos</a></li>
		</ul>
	</div>
	<!-- Contact Info -->
	<div class="menu_contact">
		<div class="menu_phone d-flex flex-row align-items-center justify-content-start">
			<div><div><img src="{{ asset('asset/images/phone.svg')}}" alt="https://www.flaticon.com/authors/freepik"></div></div>
			<div>+1 912-252-7350</div>
		</div>
		<div class="menu_social">
			<ul class="menu_social_list d-flex flex-row align-items-start justify-content-start">
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</div>
</div>
@yield('contenido')
		<div class="super_container">

			<!-- Header -->

			<header class="header">
				<div class="header_overlay"></div>
				<div class="header_content d-flex flex-row align-items-center justify-content-start">
					<div class="logo">
						<a href="/">
							<div class="d-flex flex-row align-items-center justify-content-start">
								<div><img src="{{ asset('asset/images/logo_1.png')}}" alt=""></div>
								<div>NHL-</div>
							</div>
						</a>	
					</div>
					<div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
					<nav class="main_nav">
						<ul class="d-flex flex-row align-items-start justify-content-start">
							<li class="active"><a href="#">Women</a></li>
							<li><a href="#">Men</a></li>
							<li><a href="#">Kids</a></li>					
						</ul>
					</nav>
					<div class="header_right d-flex flex-row align-items-center justify-content-start ml-auto">
						<!-- Search -->
						<div class="header_search">
							<form action="#" id="header_search_form">
								<input type="text" class="search_input" placeholder="Buscar Produto" required="required">
								<button class="header_search_button"><img src="{{ asset('asset/images/search.png')}}" alt=""></button>
							</form>
						</div>
						
						<!-- Cart -->
						<div class="cart"><a href="{{route('tienda.carro')}}"><div><img class="svg" src="{{ asset('asset/images/cart.svg')}}" alt="https://www.flaticon.com/authors/freepik"><div>{{Session::has('cart') ? Session::get('cart')->totalCantidad : '0'}}</div></div></a></div>
						<!-- Phone -->
						
						
							<div><a href="{{ route('login')}}" class="btn btn-default add-to-cart">Ingresar como administrador</a></div>
						
					</div>
				</div>
			</header>
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
		</div>
		
</div>

<script src="{{ asset('asset/js/jquery-3.2.1.min.js')}}"></script>
{{-- dellogin --}}
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/all.js') }}" defer></script>

{{-- dellogin --}}


</body>
</html>