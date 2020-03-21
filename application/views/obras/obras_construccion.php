<div id="modulo_proyecto_construccion">
  <br>
    <div  align="center">
        <h1>OBRAS EN CONSTRUCCI&Oacute;N</h1>
    </div>
	<br>
	<div align="center" class="col-md-8">
    <div align="center" >
    <form action="javascript:void(0);" id="modulo_proyecto_construccion">
			<div align="center" v-if="cargando_proyecto_construccion">
				<h1>Cargando registros... </h1>
			</div>
			<div align="center" class="col-md-8">
			<table align="center" class="table is-bordered is-hoverable" v-if="!cargando_proyecto_construccion">
				<thead class="text-white bg-dark" >
					<tr>
						<th class="text-white"> Nombre </th>
						<th class="text-white"> Fecha de Inicio </th>
                        <th class="text-white"> Fecha de Fin </th>
						<th class="text-white"> Estado </th>
						<th class="text-white">  </th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="item in proyecto_construccion">
						<td with="50">
							<input type="text" size="50" v-model="item.nombre_proyecto" />
						</td>
                        <td>
							<input type="date" v-model="item.fecha_inicio" />
						</td>
                        <td>
							<input type="date" v-model="item.fecha_fin" />
						</td>
						<td>
							<select id="estado" name="estado">
								<option value="1"> Activo </option>
								<option value="0"> Inactivo </option>
							</select>
						</td>
						<td>
							<button class="btn btn-success" v-on:click="modificarProyecto_construccion(item)"> Guardar </button>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
    </div>
</div>
</div>