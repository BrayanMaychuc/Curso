@extends('layouts.master') 
@section('titulo', 'VENTAS') 
@section('contenido')
<!-- INICIO DE VUE -->
<div id="apiVenta">
	
	<div class="container"><!-- INICIO DEL CONTAINER -->
		<div class="row"><!-- INICIO DEL ROW -->
			<div class="col-md-6">
				<div class="input-group mb-3">
  					<input type="text" class="form-control" placeholder="Inserte codigo del producto" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="sku" v-on:keyup.enter="findProduct()">
  					<div class="input-group-append">
						<button class="btn btn-outline-secondary" @click="findProduct()" type="button">Buscar</button>
					</div>
					<div class="input-group-append">
						<button class="btn btn-success" @click="showModal()">Cobrar</button>
					</div>
					<div class="input-group-append">
						<button class="btn-warning" @click="showModalinventario()">Inventario</button>
					</div>
				</div>
			</div>
		</div><!-- FIN DEL ROW -->

		<!-- INICIO DEL CARD -->
	<div class="card">
	<!-- INICIO DEL CARD-BODY -->
		<h4>Folio: @{{folio}}</h4>
	<div class="card-body">
		<div class="row">
			<table class="table">
  			<thead>
    			<tr>
      			<th style="background: #ffff66">SKU</th>
      			<th style="background: #ffff66">NOMBRE</th>
      			<th style="background: #ffff66">PRECIO</th>
      			<th style="background: #ffff66">CANTIDAD</th>
      			<th style="background: #ffff66">TOTAL</th>
      			<th style="background: #ffff66">OPERACIONES</th>
    			</tr>
  			</thead>
  				<tbody>
    				<tr v-for="(venta,index) in ventas">
      				<th scope="row">@{{venta.sku}}</th>
      				<td>@{{venta.nombre}}
      					<img v-bind:src=venta.foto width="80" height="70"></td>
      				<td>@{{venta.precio_venta}}</td>
      				<td><input type="number" v-model.number="cantidades[index]"></td>
      				<td>@{{totalProducto(index)}}</td>
      				<td>
      					<button class="btn btn-default" @click="removeProduct(index)"><i class="fas fa-trash"></i></button>
      				</td>
   	 				</tr>
     	 		</tbody>
				</table>	
			</div>
			@{{ventas}}
				@{{cantidades}}
		</div>
	<!-- FIN DEL CARD BODY-->
	</div>
	<!-- FIN DEL CARD-->

	</div> 
	<!-- FIN DEL CONTAINER -->
	
	<!-- INICIO DEL ROW -->
	<div class="row">
		<div class="col-md-8"></div>
			<div class="col-md-4">
				<!-- INICIO DEL CARD -->
				<div class="card">
				 <!-- INCIO DEL CARD-BODY -->
					<div class="card-body">							
						
							<table class="table table-bordered table-condensed">
								<tr>
								<th style="background: #ffff66">subtotal</th>
								<td>$ @{{subtotal}}</td>
								</tr>
								<tr>
								<th style="background: #ffff66">iva</th>
								<td>$ @{{iva}}</td>
								</tr>
								<tr>
								<th style="background: #ffff66">total</th>
								<td>$ @{{granTotal}}</td>
								</tr>
																	<tr>
								<th style="background: #ffff66">articulos</th>
								<td>@{{noArticulos}}</td>
								</tr>
							</table>
						</div>
					<!-- FIN DEL CARD-BODY -->
				</div>
				<!-- FIN DEL CARD -->
			</div>
		</div>
		<!-- FIN DEL ROW -->

		<!-- INICIO DE VENTANA MODAL -->
	<!-- Modal para el formulario del registro de los moovimientos -->
	<div class="modal fade" id="modalCobro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel">Aqui Titulo</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      		<div class="modal-body">
        	<form>
          		<div class="form-row">
            		<div class="col-md-2">
              			<label>A pagar</label>
            		</div>
            		<div class="col-md-6">
            			<input type="number" class="form-control" disabled :value="granTotal">
            		</div> 
            	</div><br>
            	<div class="form-row">
            		<div class="col-md-2">
              			<label>Paga Con</label>
            		</div>
            		<div class="col-md-6">
            			<input type="number" class="form-control" v-model="pagara_con">
            		</div>
            	</div> <br>
            	<div class="form-row">
            		<div class="col-md-2">
              			<label> Su cambio es </label>
            		</div>
            		<div class="col-md-6">
            			<input type="number" class="form-control" disabled :value="cambio">
            		</div>
            	</div>
          		
        	</form>
     	</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        		<button type="button" class="btn btn-primary" @click="Vender()">vender</button>
      		</div>
    	</div>
  	</div>
	</div>
	<!-- aqui termina el modal-->

	<!-- INICIO DE MODAL PARA BUSCAR PRODUCTOS EN INVENTARIO -->
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal">
  			<div class="modal-dialog modal-lg">
    			<div class="modal-content">
      				<div class="modal-header">
        				<h5 class="modal-title" id="exampleModalLabel">Almacen</h5>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        				</button>
      				</div>
      			<div class="modal-body">
        		<form>
          			<input type="text" placeholder="Inserta nombre del Producto" class="col-md-6" v-model="find" v-on:keyup.enter="findProduct()">
          			<button class="btn btn-primary">
          			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  					<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
					</svg>
				</button><br><br>

	      		</form>

	      		<table class="table table-hover">
  					<thead>
    					<tr>
      					<th scope="col">Codigo</th>
      					<th scope="col">Nombre</th>
      					<th scope="col">Precio</th>
      					<th scope="col">Cantidades</th>
    					</tr>
  					</thead>
  					<tbody>
    					<tr v-for="producto in findPro">
      						<th scope="row">@{{producto.sku}}</th>
      						<td>@{{producto.nombre}}</td>
      						<td>@{{producto.precio}}</td>
      						<td>@{{producto.cantidad}}</td>
    					</tr>
  					</tbody>
</table>
     		</div>
      		
    		</div>
  		</div>
	</div>
	<!-- FIN DE MODAL PARA BUSCAR PRODUCTOS EN INVENTARIO -->

</div> <!-- FIN DE VUE -->
@endsection

@push('scripts')
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="js/apis/ventas.js"></script>
<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
@endpush