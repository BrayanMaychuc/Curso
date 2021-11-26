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

		<div class="row">
			<table class="table">
  <thead>
    <tr>
      <th scope="col">SKU</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">PRECIO</th>
      <th scope="col">CANTIDAD</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="venta in ventas">
      <th scope="row">@{{venta.sku}}</th>
      <td>@{{venta.nombre}}</td>
      <td>@{{venta.precio_venta}}</td>
      <td>@{{venta.cantidad}}</td>
      <td>@{{venta.total}}</td>
    </tr>
      </tbody>
</table>
		</div>
	</div> <!-- FIN DEL CONTAINER -->

		


</div>
<!-- FIN DE VUE -->
@endsection

@push('scripts')
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="js/apis/ventas.js"></script>
@endpush