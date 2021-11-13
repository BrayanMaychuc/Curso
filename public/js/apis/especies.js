function init(){

var apiEspecie='http://localhost/Curso/public/apiEspecie';

new Vue({
	//ASIGNAMOS EL TOKEN
	http: {
            headers:{
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

	el:'#apiEspecie',

	data:{
		mensaje:'HOLA MUNDO cruel',
		especies:[],

	},
// SE EJECUTA DE MANERA AUTOMATICA CUANDO LA PAGINA SE CREA
	created:function(){
		this.getEspecies();

	},

// INICIO DEL METODS
	methods:{
		//PARA TRAER TODO EL LISTADO DE ESPECIES
		getEspecies:function() {
			// estructura de vueResource
			// this.$http.metodo(rutaApi).then(function(json){})
			this.$http.get(apiEspecie).then(function(j){
				this.especies=j.data;
			})
		},

		deleteEspecie:function(id){

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
		},

		mostrarModal:function(){
		$('#modalEspecies').modal('show');
		},

	},
	// FIN DE METHODS

	computed:{

	},
})

} window.onload = init;