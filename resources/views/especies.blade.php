@extends('layouts.master') 
@section('titulo', 'CRUD ESPECIES') 
@section('contenido')
	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD DE ESPECIES</title>

</head>
<body>
<!-- INICIO DE VUE -->
<div id="apiEspecie">
	<div class="card card-danger">
		<div class="card-header">
			<h4 class="m-0">CRUD DE ESPECIES </h4>
		</div>
	<table class="table table-bolderd">
		<thead>
			<th>CLAVE</th>
			<th>ESPECIES</th>
			<th>OPERACIONES</th>
		</thead>
			<tbody>
				<tr v-for="especie in especies">
					<td>@{{especie.id_especie}}</td>
					<td>@{{especie.especie}}</td>
					<td>
						<button class="btn btn-primary" @click="mostrarModal()"><i class="far fa-plus-square"></i></button>
						<button class="btn btn-warning"><i class="far fa-edit"></i></button>
						<button class="btn btn-danger" @click="deleteEspecie(especie.id_especie)"><i class="fas fa-trash-alt"></i></button>
					</td>
				</tr>
			</tbody>
		</table> <!--Fin del Table -->
	</div> <!-- Fin del div.card-body-->

	<!-- Modal para el formulario del registro de los moovimientos -->
<div class="modal fade" id="modalEspecies" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Especies</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">
          	<div class="col">
          		<input type="text" class="form-control" placeholder="clave">
          	</div>

          	<div class="col">
          		<input type="text" class="form-control" placeholder="nombre de la especie">
          	</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->
</div>
<!-- FIN DE VUE -->

<!-- ESPACIO PARA OBJETOS -->
<script type="text/javascript" src="{{asset('js/apis/especies.js')}}"></script>
<script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
</body>
</html>
@endsection