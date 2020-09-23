const apicategoria = new Vue({//Vuejs variable apicategoria va ser instancia de vuejs
	el:'#apicategoria',//q recargue el id que viene de apicategoria
	data: {//propiedad data y pasamos el primer objeto q es el nommbre
		nombre: '', //variable dinamica nombre: 'Christians Palomino',
		slug:'',//crear variable slug
		div_mensajeslug:'Slug Existe',
		div_clase_slug:'badge badge-danger',
		div_aparecer:false,
		deshabilitar_boton:1//habilitar boton 
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
	//metodo category
	methods:{
		getCategory() {//metodo category

//si existe informacion en el slug, entonces ejecuta todo eso
			if(this.slug) {
				let url='/api/categoria/'+this.slug;//crear variable url sera = a api/category
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
					//si existe este elementoBYID
					if (document.getElementById('editar')) {
						// comparamos  =  a lo q tengo en el nombre (this.nombre)
						if ( document.getElementById('nombretemp').innerHTML===this.nombre) {
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
					this.div_mensajeslug="Debes escribir una categoría";
					this.deshabilitar_boton=1;
					this.div_aparecer=true;
					}

		}
	},
	//propiedad mounted se ejecuta antes de todas
	// las propiedades que tenemos
	mounted(){
		//si este span q tiene editar tiene informacion 
		//entonces se ejecuta this.nombre q sera = a nombretemp
		if (document.getElementById('editar')) {
			this.nombre = document.getElementById('nombretemp').innerHTML;
		}
		//se desabilite
		this.deshabilitar_boton=0;

	}
}); 

//