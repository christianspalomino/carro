@extends('plantilla.plantilla')

@section('titulo', 'NHL-PRUEBA')
@section('estilos')
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css')}}">
@endsection
<style type="text/css">

	img#img{
    width: 250px;
    height: 250px;
    margin-bottom: 20px;
}
</style>
@section('contenido')

<div class="super_container_inner">
	
		<div class="products">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3">
						<div class="section_title text-center">Productos de NHL</div>
						<br>
					</div>
				</div>
				
				<div class="row">
					@foreach($productos as $producto)
				        <div class="col-md-3 text-center">
				        	
				         @if ($producto->images->count()<=0)
				                            <img id="img" src="/imagenes/avatar.png" >
				                          @else
				                            <img id="img" src="{{ $producto->images->random()->url}}">
				                         @endif
				        <button type="button" class="btn btn-info "><a href="{{route('tienda.anadiralcarro',['id' => $producto->id])}}" class="btn btn-default add-to-cart">Añadir al carrito</a></button>
				        </div>

				      

			        @endforeach
     			</div>
 			</div>
				
		</div> 

</div>





