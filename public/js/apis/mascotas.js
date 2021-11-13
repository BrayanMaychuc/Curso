function init(){ //Es importante esta funcion para forzar la inicializacion del vue

 var apiMascota = 'http://localhost/Curso/public/apiMascota';

new Vue({ //Creamos el objeto vue con nombre mascotas
	http: {
            headers:{
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

	el:'#apiMascotas',

	data:{
		mensaje: 'se ha establecido la conexion', //Establecemos una variable de prueba
		mascotas: [],

		nombre:'',
		peso:'',
		genero:'',
	},
	//SE EJECUTA AUTOMAICAMENTE
	created:function(){
		this.getMascotas();
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
		$('#modalMascota').modal('show');
		},

		saveMascota:function(){ //Metodo para Guardar los datos de una nueva mascota
			var mascota={nombre:this.nombre, peso:this.peso, genero:this.genero};

			//Se envian los datos en un archivo json
			this.$http.post(apiMascota,mascota).then(function(j){
				console.log('INSERCIÓN EXITOSA');
			}).catch(function(j){
				console.log(j);
			});

			$('#modalMascota').modal('hide'); 
			//esta funcion para  la ventana modal se cierre cuando se guarden los datos
		},
	},
})
}window.onload = init;