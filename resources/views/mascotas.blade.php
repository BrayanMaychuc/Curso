@extends('layouts.master') 
@section('titulo', 'CRUD MASCOTAS') 
@section('contenido')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD MASCOTAS</title>
</head>
<body>
	<!-- INICIO DE VUE -->
<div id="apiMascotas"> <!-- Establecemos el valor del el que declaramos en el js como id -->
	<div class="row">
	<div class="col-md-12">
		<div class="card card-danger"> <!-- inicio de card -->
			<div class="card-header"> <!-- inicio de card-header -->
				<h4 class="m-0">MASCOTAS</h4><br>
				<button class="btn btn-primary" @click="showModal()"><i class="far fa-plus-square" ></i></button> <br><br>
				<div class="col-md-6">
					<input type="text" placeholder="Escribe el nombre de la Mascota" class="form-control" v-model="find">
				</div>
			</div> <!-- fin de card -->
		<table class="table table-bolderd">
			<thead>
				<th hidden="">ID_MASCOTA</th>
				<th>NOMBRE</th>
				<th>PESO</th>
				<th>GENERO</th>
				<th>ESPECIE</th>
				<th>BOTONES</th>
			</thead>
			<tbody>
				<tr v-for="mascota in findMascotas">
					<td hidden="">@{{mascota.id_mascota}}</td>
					<td>@{{mascota.nombre}}</td>
					<td>@{{mascota.peso}}</td>
					<td>@{{mascota.genero}}</td>
					<td>@{{mascota.especie.especie}}</td>
					<td>
					<button class="btn btn-warning" @click="editMascota(mascota.id_mascota)"><i class="far fa-edit" ></i></button>
					<button class="btn btn-danger"  @click="deleteMascotas(mascota.id_mascota)"><i class="fas fa-trash-alt" ></i></button>
					</td>
				</tr>
			</tbody>
		</table> <!--Fin del Table -->
		</div>		<!-- FIN de card -->
	</div>
	</div> <!-- Fin del div.card-body-->

	<div class="modal fade" id="modalMascota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" V-if="agregando==true">Agregando Mascotas</h5>
        <h5 class="modal-title" id="exampleModalLabel"v-if="agregando==false">Editando Mascotas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">  
          	<div class="col">
          		<input type="text" class="form-control" placeholder="id_mascota" v-model="id_mascota"><br>
          	</div>
          	<div class="col">
          		<input type="text" class="form-control" placeholder="nombre de la Mascota" v-model="nombre"><br>
          	</div> 
          </div>
          	<div class="form-row">
          	<div class="col">
          		<input type="number" class="form-control" placeholder="peso" v-model="peso"><br>
          	</div> 
          	<div class="col">
          		<select class="form-control" v-model="genero">
          			<option disabled="">Elije un Genero</option>
          			<option value="M">MACHO</option>
          			<option value="H">HEMBRA</option>
          		</select><br>

          		<select class="form-control" v-model="id_especie" @change="getRazas">
          			 <option v-for="especie in especies" v-bind:value="especie.id_especie">@{{especie.especie}}</option>
          		</select> <br>

          		<select class="form-control">
          			<option value="" disabled="">Selecciona una Raza</option>
          		</select>
          	</div> 
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="saveMascota()" v-if="agregando==true">Guardar</button>
        <button type="button" class="btn btn-secondary" @click="updateMascota()" v-if="agregando==false">Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->

</div>
<!-- FIN DE VUE -->
</body>
</html>


<!-- OBJETO VUE -->
<script type="text/javascript" src="js/apis/mascotas.js"></script>
<script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
@endsection

@push('scripts')
<script type="text/javascript" src="js/vue-resource.js"></script>
@endpush

<input type="hidden" name="ruta" value="{{url('/')}}"> 
<!-- Declaramos el valor del input -->