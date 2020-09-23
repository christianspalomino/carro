<div class="table-responsive cart_info">
					<table class="table table-condensed">
							<thead>
								<tr class="cart_menu">
									<td class="image">Producto</td>
									<td class="description"></td>
									<td class="price">Precio</td>
									<td class="quantity">Cantidad</td>
									<td class="total">Total</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
		                    @if(Session::has('cart'))
		                        @forelse ($productos as $producto)
		                        <tr>
		              

									<td class="cart_product">
										@foreach($producto['item']->images->take(1) as $imagen)
											<a href=""><img src="{{ $imagen->url}}" alt="" style="height:110px;width:110px;"></a>
										@endforeach
										
									</td>
									<td class="cart_description">
										<h4><a href="#">{{$producto['item']['nombre']}}</a></h4>
										{{-- <p>Web ID: {{$producto['item']['id']}}</p> --}}
									</td>
									<td class="cart_price">
		                                <p>S/. {{$producto['item']['precio']}}</p>
									</td>

{{-- <script type="text/javascript">



 var cantidad = "@Html.Raw(Json.Encode(Carrito))";
 var stock_disponible = "@Html.Raw(Json.Encode(Producto))";

if(stock_disponible<=cantidad){
	
alert("errror");
} else {
 
alert("confirmado");

}

 	
  
</script> --}}
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<a class="cart_quantity_up" href="{{route('tienda.anadiralcarro', ['id' => $producto['item']['id']])}}"> + </a>
											<input class="cart_quantity_input" type="text" name="quantity" value="{{$producto['cantidad']}}" autocomplete="off" size="2" disabled>
											<a class="cart_quantity_down" href="{{route('tienda.removerunitemcarro', ['id' => $producto['item']['id']])}}"> - </a>
										</div>
									</td>
									<td class="cart_total">
										<p class="cart_total_price">S/. {{$producto['precio']}}</p>
									</td>
									<td class="cart_delete">
										<a class="cart_quantity_delete" href="{{route('tienda.removeritemcarro', ['id' => $producto['item']['id']])}}"><i class="fa fa-times" style="color:red"></i></a>
									</td>
								</tr>
		                        @empty
		                            <tr>
		                                <td>No hay productos en el carro de compras</td>
		                            </tr>
		                        @endforelse
		                    @else 
		                        <tr>
		                           <td>No hay productos en el carro de compras</td>
		                        </tr>
		                    @endif
							</tbody>
					</table>
				</div>