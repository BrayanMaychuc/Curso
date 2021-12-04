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
		cantidades:[1,1,1,1,1,1,1,1,1,1],
		auxSubtotal:0,
		auxTotal:0,

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
			})
		}, //FIN DEL FIND

		removeProduct:function(id){ //INICIO DE ELIMINAR
			this.ventas.splice(id,1);
		}, //FIN DE ELIMINAR

	},
	//FIN DEL METHODS

//INICIO DEL COMPUTED
	computed:{

		totalProducto(){ //INICIO DE TOTAL PRODUCTO
			return (id)=>{
				var total=1;
				// MARCA ERROR AL USAR CANTIDAD, PERO CUANDO USAMOS CANTIDADES NO HACE LA MULTIPLICACION
				total = this.ventas[id].precio_venta * this.cantidades[id];

				this.ventas[id].total=total; //ACTUALIZAS VENTAS
				this.ventas[id].cantidad=this.cantidades[id];  //ACTUALIZAMOS CANTIDADES
				return total.toFixed(1);
			}
		}, //FIN DE TOTAL PRODUCTO

		subtotal(){ //INICIO DE SUBTOTAL

			var total=0;
			for (var i = this.ventas.length - 1; i >= 0; i--) {
				total=total + this.ventas[i].total;
			}
			//SE MANDA UNA COPIA DE LA VARIABLE DEL DATA PARA 
			//USARLO EN OTROS CALCULOS
			this.auxSubtotal=total.toFixed(1);
			return total.toFixed(1);
		}, //FIN DE SUBTOTAL

		iva(){ //INICIO DE IVA
			var auxIva = 0;
				auxIva = this.auxSubtotal * 0.16;
				return auxIva.toFixed(1);
		}, //FIN DE IVA

		//INICIO DE TOTAL
		granTotal(){
			var auxTotal=0;
			auxTotal=this.auxSubtotal * 1.16;
			return auxTotal.toFixed(1);
		},
		//FIN DEL TOTAL

		//INCIO DE ARTICULOS
		noArticulos(){
			var acum=0;
			for (var i = this.ventas.length - 1; i >= 0; i--) {
				acum= acum + this.ventas[i].cantidad;
			}
			return acum;
		}
		//FIN DE ARTICULOS
	}
//FIN DEL COMPUTED

}) //FIN DE VUE
}window.onload = init;