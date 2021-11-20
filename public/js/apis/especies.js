function init(){



new Vue({
	//ASIGNAMOS EL TOKEN
	http: {
            headers:{
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

	el:'#apiEspecie',

	data:{ //INICIO DEL DATA
		especies:[],

		id_especie:'',
		especie:'',
		editando:0,
	}, //FIN DEL DATA

// SE EJECUTA DE MANERA AUTOMATICA CUANDO LA PAGINA SE CREA
	created:function(){
		this.getEspecies();

	},

// INICIO DEL METODS
	methods:{
		//PARA TRAER TODO EL LISTADO DE ESPECIES
		getEspecies:function() { //INICIO DEL METODO TRAER
			// estructura de vueResource
			// this.$http.metodo(rutaApi).then(function(json){})
			this.$http.get(apiEspecie).then(function(j){
				this.especies=j.data;
			})
		}, //FIN DEL METODO TRAER

		deleteEspecie:function(id){ //INICIO DEL METODO ELIMINAR

			//Codigo de Sweet
			Swal.fire({
  				title: 'Estas Seguro de Eliminar?',
  				text: "No podras revertirlo!",
  				icon: 'warning',
 				showCancelButton: true,
  				confirmButtonColor: '#3085d6',
  				cancelButtonColor: '#d33',
  				confirmButtonText: 'Si, Eliminalo!'
				}).then((result) => {
  			if (result.isConfirmed) {

  				this.$http.delete(apiEspecie + '/' + id).then(function(j){ // Then = SI EL SERVIDOR RESPONDE
					this.getEspecies();

				}).catch(function(j){ //DE LO CONTRARIO USAMOS UN CATCH
					console.log(j);
				});

   				Swal.fire(
      			'Eliminado!',
      			'Se ha eliminado con Exito',
      			'success'
    				)
  				}
			}) //Fin del sweet
		}, //FIN DEL METODO ELIMINAR

		mostrarModal:function(){ //INICIO DE MOSTRARMODAL
			this.editando=0;
		$('#modalEspecies').modal('show');
		}, //FIN DE MOSTRARMODAL


		saveEspecies:function(){ //INICIO DEL METODO GUARDAR
			var especie={id_especie:this.id_especie, especie:this.especie};

			//Se envian los datos en un archivo json
			this.$http.post(apiEspecie,especie).then(function(j){
				console.log(j);
			});
		}, //FIN DEL METODO GUARDAR

		editEspecie:function(id){ //Metodo para editar una especie
		 	
		 	this.id_especie=id;

		 	this.$http.get(apiEspecie + '/' + id).then(function(json){
		 		//console.log(json.data);

		 		this.nombre=json.data.especie;
		 	});
		 	$('#modalEspecies').modal('show'); 
		}, //FIN DEL METODO EDITAR

	},// FIN DE METHODS

}) //FIN DE new Vue

} window.onload = init;