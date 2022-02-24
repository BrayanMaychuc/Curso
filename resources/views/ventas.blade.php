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
				</div>
			</div>
		</div><!-- FIN DEL ROW -->
		<p v-bind:align=alineacion>@{{frase}}</p>
		<!-- INICIO DEL CARD -->
<div class="card">
	<!-- INICIO DEL CARD-BODY -->
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


</div>
<!-- FIN DE VUE -->
@endsection

@push('scripts')
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="js/apis/ventas.js"></script>
@endpush