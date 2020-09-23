const apiproducto = new Vue({//Vuejs variable apiproducto va ser instancia de vuejs
	el:'#apiproducto',//q recargue el id que viene de apiproducto
	data: {//propiedad data y pasamos el primer objeto q es el nommbre
		nombre: '', //variable dinamica nombre: 'Christians Palomino',
		slug:'',//crear variable slug
		div_mensajeslug:'Slug Existe',
		div_clase_slug:'badge badge-danger',
		div_aparecer:false,
		deshabilitar_boton:1,//habilitar boton 

		
		precio:0,
		stock_disponible:0,
		
	},
	//crear funcion 
	computed: { //...cauando se ejecute esta funcion computed
		generarSlug : function(){
			var char= { //eliminar tildes
				"á":"a","é":"e","í":"i","ó":"o","ú":"u",
				"Á":"A","É":"E","Í":"I","Ó":"O","Ú":"U",
				"ñ":"n","Ñ":"N"," ":"-","_":"-"
				} 
				//crear var q sera igual a 
			//....quita todo
			var expr = /[áéíóúÁÉÍÓÚÑñ_ ]/g;
			this.slug= this.nombre.trim().replace(expr, function(e){
				return char[e]
			}).toLowerCase()
			//pasar un indice por la funcion (variable e) funtion(e)
			//this.nombre.trim().replace(/ /,'-').toLowerCase()//acceder a la variable nombre(this).... 
			// con trim de js se limpia espacios a tras y delante 
			//remplazar espacios en blanco con guiones (replace)
			//toLowerCase() convierte la mayuscula en minuscula

			return this.slug;//....retorna slug
		}
},
	//metodo product
	methods:{
		eliminarimagen(imagen) {
			// console.log(imagen);
//swall es de sweetarert2 -modal alerta
			Swal.fire({
                title: '¿Estas seguro de eliminar la imagen '+ imagen.id+ '?',//imagen->id pero en js es imagen.id
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Eliminar!',
                cancelButtonText: 'Cancelar'
			}).then((result) => {
			  if (result.value) {

			  	let url = '/api/eliminarimagen/'+imagen.id;//crear variable url sera = a api/product
        		//metodo get, consultar url q esta en la variable url... .then (si se ejecuto correctamente q haga lo siguienre..response=>)
                    axios.delete(url).then(response => {
                         console.log(response.data);
                    });

			  	//ELIMINAR EL ELEMENTO
			  	var elemento = document.getElementById('idimagen-'+imagen.id);//llamar idimagen imagen.id
			  	// console.log(elemento);
			  	 elemento.parentNode.removeChild(elemento); //en el elemento parentNode accede al elemento padre, y en el elemento padre quiero eliminar el elemento hijo removeChild
			    Swal.fire(
			      'Eliminado!',
			      'Su archivo ha sido eliminado.',
			      'success'
			    )
			  }
			})
		},
		getProduct() {//metodo product

//si existe informacion en el slug, entonces ejecuta todo eso
			if(this.slug) {
				let url='/api/producto/'+this.slug;//crear variable url sera = a api/product
				//metodo get, consultar url q esta en la variable url... .then (si se ejecuto correctamente q haga lo siguienre..response=>)
				axios.get(url).then(response => {
					//quiero q la variable div_mensajeslug sea = response.date
					this.div_mensajeslug = response.data;
					// console.log(response.data);

					//si 
					if (this.div_mensajeslug=="Slug Disponible"){
						//quiero llamar a div_clase_sulg y sera = a badge badge succes
						this.div_clase_slug='badge badge-success';
						this.deshabilitar_boton=0;

					} else{//de lo contrario llamar a badge badge danger
						this.div_clase_slug='badge badge-danger';
						this.deshabilitar_boton=1;
					}			

					this.div_aparecer=true;//this.aparecer sera true mostrar
				
					//nueva funcionalidad 
					//si existe informacion en data.datos.nombre
					if (data.datos.nombre) {
						// comparamos si esta variable data.datos.nombe es =  a lo q tengo en el nombre (this.nombre)
						if (data.datos.nombre===this.nombre) {
							//si es asi, habilita boton
							this.deshabilitar_boton=0;
							this.div_mensajeslug=''; //mensaje borralo
							this.div_clase_slug=''; //en blanco 
							this.div_aparecer=false; //desapaarce div

						}
					}
				})
			}
			//de lo contrario quiero que se muestre ko siguiente
				else{
					this.div_clase_slug='badge badge-danger';
					this.div_mensajeslug="Debes escribir un producto";
					this.deshabilitar_boton=1;
					this.div_aparecer=true;
					}

		},
		mounted(){
		//si een data.editar es = a si
		//entonces sera = a data.datos.nombre
		if (data.editar=='Si') {
			this.nombre = data.datos.nombre;
			this.stock_disponible = data.datos.stock_disponible;
			
			//se desabilite
			this.deshabilitar_boton=0;
		}
		
		console.log(data);
	}
	}
}); 

//