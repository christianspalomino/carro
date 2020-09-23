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
						<br>
						<div class="section_title text-center">Confirmar Compra</div>
						<br>
					</div>
				</div>
				
				<div class="row">
					<div class="container">
			
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h5>Pago mediante Yape</h5>
				</div>
				<div class="panel-body">
					<p>Número de Yape: <strong>1234567</strong></p>
				</div>
			</div>
			
			
			
		</div>
<!--Section: Contact v.2-->
<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Información del cliente</h2>
    <!--Section description-->
    <div class="row">
<div class="col-sm-12">
                @include('partials.notificaciones')
            </div>
        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form action="{{ route('tienda.postcomprar') }}" method="POST">
       
@csrf
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                        	<label for="name" class="">Nombres</label>
                            <input type="text"name="nombres" class="form-control" value="Christians">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="md-form mb-0">
                        	<label for="name" class="">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" value="Palomino">
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                        	<label for="email" class="">Correo</label>
                            <input type="text" name="email" class="form-control" value="christians@gmail.com">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="md-form mb-0">
                        	<label for="name" class="">Dirección</label>
                            <input type="text" name="direccion" class="form-control" value="olof palme, chilca--cañete">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="">Telefono</label>
                            <input type="text" name="telefono" class="form-control" value="987654321">
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
              
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                        	<label for="message">Comentario</label>
                            <textarea type="text" name="comentario" rows="2" class="form-control md-textarea" placeholder="Acerca de su orden o algun dato adicional" value="saj" ></textarea>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

            

            <div class="text-center text-md-left">
            	<br>
             <button class="btn btn-md btn-block btn-primary" type="submit">Comprar</button>
            </div>
        </div>

        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fa fa-map"></i>
                    <p>Jr. Paruro 1389, Oficina 101 Lima- Peru</p>
                </li>

                <li><i class="fa fa-phone"></i>
                    <p>936910425 - 994078320</p>
                </li>

                <li><i class="fa fa-envelope"></i>
                    <p>ventasneonhouse@gmail.com</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->
			
    </div></form>
<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<br>
					<h2 class="h1-responsive font-weight-bold text-center my-4">Productos en el carro</h2>
					<br>
				</div>
			</div>
				

			@include('partials.tablacarrocompras')
</section>
<!--Section: Contact v.2-->


		
     			</div>
 			</div>
				
		</div> 

</div>





@endsection