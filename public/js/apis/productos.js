function init(){
	 
		var apiProducto = 'http://localhost/Curso/public/apiProducto';

	 new Vue ({ //INICIO DE VUE

		http: {
            headers:{
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

		el:'#apiProducto',
		data: {
			productos:[],
			sku:'',
			nombre:'',
			precio:'',
			cantidad:'',
			agregando:true,
		},

		// SE EJECUTA DE MANERA AUTOMATICA CUANDO LA PAGINA SE CREA
		created:function(){
			this.getProductos();

		},
		// INICIO DEL METHODS
		methods:{
			getProductos:function(){
				this.$http.get(apiProducto).then(function(j){
					this.productos=j.data;
				})
			},
			// MOSTRAR VENTANA MODAL
			mostrarModal:function(){
				this.agregando=true;
				$('#modalProducto').modal('show');
			}, //FIN DEL MOSTRAR MDOAL

			// Funcion para agregar producto
			addProducto:function(){
				var pro={sku:this.sku,
					nombre:this.nombre,
					precio:this.precio,
					cantidad:this.cantidad
				};
				// enviar datos en un archivo
				this.$http.post(apiProducto,producto).then(function(j){
					this.getProductos();
					this.sku="",
					this.nombre="",
					this.precio="",
					this.cantidad="",

					$('#modalProducto').modal('hide');
				})
			},
				// INICIO DEL METODO EDITAR
			editProducto:function(id){
				this.agregando=false;
				this.sku=id;

				this.$http.get(apiProducto + '/' + id).then(function(j){
					this.sku=j.data.sku;
					this.nombre=j.data.nombre;
					this.precio=j.data.precio;
					this.cantidad=j.data.cantidad;
				});
				$('#modalProducto').modal('show');
			},

			// INICIO DEL METODO ELIMINAR
			deleteProducto:function(id){
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

   					this.$http.delete(apiProducto + '/' + id).then(function(j){ // Then = SI EL SERVIDOR RESPONDE
		 				this.getProductos();
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
			// FIN DEL METODO ELIMINAR

			// INICIO DEL METODO UPDATE
			updateProducto:function(){
				var jpro={sku:this.sku,
					nombre:this.nombre,
					precio:this.precio,
					cantidad:this.cantidad
				};
				this.$http.patch(apiProducto + '/' + this.jpro.sku).then(function(j){
					this.getProductos();
				});
				$('#modalProducto').modal('hide');
			}
			// FIN DEL METODO UPDATE
		},
		// FIN DEL METHOODS
	}) //FIN DE VUE
}window.onload = init;