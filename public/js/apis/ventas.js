function init(){ //FORZAMOS EL INICIO DEL OBJETO VUE

	var apiProducto = 'http://localhost/Curso/public/apiProducto';

new Vue({ //INICIO DE VUE
	http: {
            headers:{
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

	el:'#apiVenta',

	data:{ //INICIO DEL DATA
		sku:'',
		ventas:[],
	}, //FIN DEL DATA

	//INICIO DEL METHODS
	methods:{
		findProduct:function(){ //INICIO DEL FIND
			var product = {}

			this.$http.get(apiProducto + '/' + this.sku).then(function(j){
				product = {
					sku:j.data.sku,
					nombre:j.data.nombre,
					precio_venta:j.data.precio_venta,
					cantidad:1,
					total:j.data.precio_venta
				};
				this.ventas.push(product);
			});
		}, //FIN DEL FIND

	},
	//FIN DEL METHODS


}) //FIN DE VUE
}window.onload = init;