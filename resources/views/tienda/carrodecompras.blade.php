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
{{-- <script type="text/javascript">
	
	if(parseInt(stock)>=parseInt(cantidad))
</script> --}}
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
				@include('partials.tablacarrocompras')
			</div>
			<div class="row">

  				<div class="col-md-4 col-md-offset-4">
  					
						<h3>Datos de la compra</h3>
						<p>En este apartado se agrega el IGV.</p>
				
				</div>

				<div class="col-md-4 col-md-offset-4">
				</div>
  				<div class="col-md-4 col-md-offset-4">
  					{{-- <table class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col">Sub total</th>
					      <th scope="col">IGV</th>
					      <th scope="col">Total</th>
					    </tr>
					  </thead>
					  <tbody>
					 	<td><span>18%</span></td>
					    <td><span>S/. </span>{{ !empty($totalPrecio) ? $totalPrecio : '0'}}</td>
					    <td><span>S/. </span>{{ !empty($totalPrecio) ? $totalPrecio * 1.18 : '0' }}</td>
					   
					    </tr>
					  
					  </tbody>
					</table> --}}
  					<ul>
						<li>Sub total <span>S/. {{ !empty($totalPrecio) ? $totalPrecio : '0'}}</span></li>
						<li>IGV <span>18%</span></li>
					{{-- 	<li>Gastos de envio <span>$0</span></li> --}}
						<li>Total <span>S/. {{ !empty($totalPrecio) ? $totalPrecio * 1.18 : '0' }}</span></li>
					</ul>
					@if(!empty($totalPrecio))
	             		<button type="button" class="btn btn-sm btn-info"><a class="btn btn-default btn-block check_out" href="{{route('tienda.comprar')}}">Confirmar Compra</a></button>
					@endif
  				</div>
			</div>
					
					
		</div>

	</div>
 </div>

@endsection