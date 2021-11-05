function init(){

var apiEspecie='http://localhost/Curso/public/apiEspecie';

new Vue({

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
		getEspecies:function() {
			// estructura de vueResource
			// this.$http.metodo(rutaApi).then(function(json){})
			this.$http.get(apiEspecie).then(function(json){
				this.especies=json.data;
			})
		}
	},
	// FIN DE METHODS

	computed:{

	},
})

} window.onload = init;