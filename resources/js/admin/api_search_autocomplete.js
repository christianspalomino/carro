const api_search_autocomplete = new Vue({//Vuejs variable api_search_autocomplete va ser instancia de vuejs
	el:'#api_search_autocomplete',//q recargue el id que viene de api_search_autocomplete
	data: {
		palabra_a_buscar: '', //variable dinamica palabra_a_buscar: 'Christians Palomino',
		resultados:[]//crear variable resultados
		
	},
	methods:{ 
		autoComplete() { 
			 this.resultados=[];//array vacio para q se quite todo lo q esta ahi
	
	// si la palabra que tengo en palabra_a_buscar es > a 2 caracteres 
		if (this.palabra_a_buscar.length >2) {
			// ejecutas lo siguiente acceder a la url /api/autocomplete 
                axios.get('/api/autocomplete',
                	//y q enviemos por parametros palabraabuscar y sera = a this.palabra_a_buscar
                  {params:{ palabraabuscar:this.palabra_a_buscar }}
                 ).then(response => {
                    this.resultados = response.data;
                    console.log(response.data);
               });
            }
        },
        
    },
    mounted(){
        console.log('Datos cargados correctamente');        
        
    }

});