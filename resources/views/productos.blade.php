@extends('layouts.master') 
@section('titulo', 'VENTAS') 
@section('contenido')
<!-- INICIO DE VUE -->
<div id="apiProducto">
	<div class="card">
		<div class="card-header" class="col-md-6" style="background: #07639F">
			<h5 class="m-0">LISTA DE PRODUCTOS </h5> <br>
				<button class="btn btn-primary" @click="mostrarModal()" style="background: #05FBE2" class="right"><i class="far fa-plus-square"></i></button>
		</div>
	<div class="container"> <!-- INICIO DEL Container-->

		<div class="card-body"> <!-- INICIO DEL CARD BODY-->
			<div class="row">
				<table class="table">
  			<thead>
    			<tr>
     	 			<th scope="col" style="background: #1A9CAF">SKU</th>
      				<th scope="col" style="background: #1A9CAF">NOMBRE</th>
      				<th scope="col" style="background: #1A9CAF">PRECIO</th>
      				<th scope="col" style="background: #1A9CAF">CANTIDAD</th>
      				<th scope="col" style="background: #1A9CAF">ACCIONES</th>
    			</tr>
  			</thead>
  			<tbody>
   				<tr v-for="producto in productos">
      				<td>@{{producto.sku}}</td>
      				<td>@{{producto.nombre}}</td>
      				<td>@{{producto.precio}}</td>
      				<td>@{{producto.cantidad}}</td>
      				<td>
      					<div>
      					<button class="btn" style="background: #DCBDF0" @click="editProducto(producto.sku)"><i class="far fa-edit"></i></button>
      					<button class="btn btn-danger" @click="deleteProducto(producto.sku)"><i class="fas fa-trash-alt"></i></button>
      					</div>
      				</td>
    			</tr>
  				</tbody>
				</table>
			</div>
		</div> <!-- FIN DEL CARD BODY-->
	</div> <!-- FIN DEL CONTAINER-->

	<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">Agregando Mascotas</h5>
         <h5 class="modal-title" id="exampleModalLabel" >Editando Mascotas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">  
          	<div class="col">
          		<input type="text" class="form-control" placeholder="sku" v-model="sku"><br>
          	</div>
          	<div class="col">
          		<input type="text" class="form-control" placeholder="nombre del producto" v-model="nombre"><br>
          	</div> 
          </div>
          	<div class="form-row">
          	<div class="col">
          		<input type="number" class="form-control" placeholder="precio" v-model="precio"><br>
          	</div> 
          	<div class="col">
          		<input type="number" class="form-control" placeholder="cantidad" v-model="cantidad">
          	</div> 
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" v-if="agregando==true" @click="addProducto()">Guardar</button>
        <button type="button" class="btn btn-secondary" @click="updateProducto()"> Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->
</div> 
<!-- FIN DE VUE -->
@endsection
@push('scripts')
<script type="text/javascript" src="js/apis/productos.js"></script>
@endpush
