@extends('plantilla.plantilla')

@section('titulo', 'NHL-PRUEBA')
@section('estilos')
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css')}}">
@endsection

@section('contenido')
@section('script')

<script src="/adminlte/ckeditor/ckeditor.js"></script>producto
	



@endsection
<script type="text/javascript">
$(function() {
    $('#descripcion').ckeditor({
        toolbar: 'Full',
        enterMode : CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P
    });
});
</script>
	<div class="super_container_inner">
		<div class="super_overlay"></div>


		<!-- Products -->

		<div class="products">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3">
						<div class="section_title text-center">Productos de NHL</div>
					</div>
				</div>
				

				<div class="row products_row">
					
					<!-- Product -->
					<div class="col-xl-8 col-md-8">
						<div class="product">
							<div class="product_image">
						@if ($producto->images->count()<=0)
                            <img src="/imagenes/avatar.png" >
                          @else
                            <img src="{{ $producto->images->random()->url}}">
                         @endif
                          </div>
							<div class="product_content">
								<div class="product_info d-flex flex-row align-items-start justify-content-start">
									<div>
										<div>
											<div class="product_name">{{$producto->nombre}}</a></div>
											
										</div>
									</div>
									<div class="ml-auto text-right">
										<div class="product_category"><a href="category.html">Categoria{{$producto->Categoria->nombre}}</a></div>
										<div class="product_price text-right">S/.{{$producto->precio}}<span></span></div>
									</div>
								</div>
							
								<hr/>
										
										<div class="col-xl-8 col-md-8">
   
									        <p id="descripcion">Descripción:{!!$producto->descripcion!!} </p>
									    </div>

                      					
               

								
							</div>
							
						</div>
					</div>

				
				</div>
				
			</div>
		</div>




