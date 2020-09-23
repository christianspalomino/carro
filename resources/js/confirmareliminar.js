const confirmareliminar = new Vue({//Vuejs variable apicategory va ser instancia de vuejs
	el:'#confirmareliminar',//q recargue el id que viene de apicategory
	data: {//propiedad data y pasamos el primer objeto q es el nommbre
		urlaeliminar: ''
	},
	
	//metodo category
	methods:{
		deseas_eliminar(id) {
			// alert(id);
			//va ser igual a urlbase del span del index
			this.urlaeliminar =document.getElementById('urlbase').innerHTML+'/'+id;
			// alert(this.urleliminar);
			// jquery
			$('#modal_eliminar').modal('show');
		}
	},
}); 
