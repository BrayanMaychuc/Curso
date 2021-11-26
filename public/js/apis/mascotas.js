function init(){ //Es importante esta funcion para forzar la inicializacion del vue

 var apiMascota = 'http://localhost/Curso/public/apiMascota';
 var apiEspecie='http://localhost/Curso/public/apiEspecie';

new Vue({ //Creamos el objeto vue con nombre mascotas
	http: {
            headers:{
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

	el:'#apiMascotas',

	data:{ //Establecemos una variable de prueba
		mascotas: [],
		especies:[],

		nombre:'',
		peso:'',
		genero:'',
		agregando:true,
		id_mascota:'',
		id_especie:'',

		find:'',
	},
	//SE EJECUTA AUTOMAICAMENTE
	created:function(){
		this.getMascotas();
		this.getEspecies();
	},

	//INICIO DE METHODS
	methods:{
		//Metodo para traer a todas las mascotas
		getMascotas:function(){
			// estructura de vueResource
			// this.$http.metodo(rutaApi).then(function(json){})
			this.$http.get(apiMascota).then(function(j){ 
				this.mascotas=j.data;
			})
		},

		showModal:function(){ //Metodo para mostar Ventana Modal
			this.agregando=true;
		$('#modalMascota').modal('show');
		},

		saveMascota:function(){ //Metodo para Guardar los datos de una nueva mascota

			var mascota={id_mascota:this.id_mascota, 
					nombre:this.nombre, 
					peso:this.peso, 
					genero:this.genero,
					id_especie:this.id_especie
				};

			//Se envian los datos en un archivo json
			this.$http.post(apiMascota,mascota).then(function(j){
				this.getMascotas();
				this.nombre="";
				this.peso="";
				this.genero="";
				this.id_especie="";

			$('#modalMascota').modal('hide'); 
			//esta funcion para  la ventana modal se cierre cuando se guarden los datos
			}
		)},

		 deleteMascotas:function(id){ //Metodo para elimminar la mascota

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

   				this.$http.delete(apiMascota+ '/' + id).then(function(j){ // Then = SI EL SERVIDOR RESPONDE
		 			this.getMascotas();
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
		
		editMascota:function(id){ //Metodo para editar una mascota
		 	this.agregando=false;
		 	this.id_mascota=id;

		 	this.$http.get(apiMascota + '/' + id).then(function(json){
		 		//console.log(json.data);
		 		this.id_mascota=json.data.id_mascota;
		 		this.nombre=json.data.nombre;
				this.peso=json.data.peso;
				this.genero=json.data.genero;
				this.id_especie=json.data.id_especie;
		 	});
		 	$('#modalMascota').modal('show'); 
		}, //FIN DEL METODO EDITAR

		updateMascota:function(){ //INICIO DE Metodo UPDATE

			var jsonMascota = {id_mascota:this.id_mascota, 
					nombre:this.nombre, 
					peso:this.peso, 
					genero:this.genero,
					id_especie:this.id_especie
				};
			this.$http.patch(apiMascota + '/' + this.id_mascota.jsonMascota).then(function(j){
				this.getMascotas();
			});
			$('#modalMascota').modal('hide');
		}, //FIN DEL METODO UPDATE

		//PARA TRAER TODO EL LISTADO DE ESPECIES
		getEspecies:function() { //INICIO DEL METODO TRAER
			// estructura de vueResource
			// this.$http.metodo(rutaApi).then(function(json){})
			this.$http.get(apiEspecie).then(function(j){
				this.especies=j.data;
			})
		}, //FIN DEL METODO TRAER

		//INICIO DEL METODO GETRAZAS
		getRazas(e){
				var id_especie=e.target.value;
				this.$http.get(apiEspecie + '/getRazas/' + id_especie).then(function(j){
					console.log(j.data);
				});
		},

	}, //FIN DEL METHODS

	computed:{ //INICIO DEL COMPUTED
		
		findMascotas:function(){ //INICIO DEL FILTRO
			return this.mascotas.filter((mascota)=>{
				return mascota.nombre.toLowerCase().match(this.find.toLowerCase().trim())
			});
		}, //FIN DEL FILTRO

	} //FIN DEL COMPUTED
})

}window.onload = init;