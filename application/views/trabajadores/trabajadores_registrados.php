<div id="modulo_trabajadores">
  <br>
    <div  align="center">
        <h1>TRABAJADORES REGISTRADOS</h1> <br><br>
        <h1>OBREROS</h1>
    </div>
	<br>
	<div align="center" class="col-md-8">
    <div align="center" >
    <form action="javascript:void(0);" id="modulo_trabajadores">
			<div align="center" v-if="cargando_trabajadores">
				<h1>Cargando registros... </h1>
			</div>
			<div align="center" class="col-md-8">
			<table align="center" class="table is-bordered is-hoverable" v-if="!cargando_trabajadores">
				<thead class="text-white bg-dark" >
					<tr>
						<th class="text-white"> Nombres </th>
						<th class="text-white"> Apellidos </th>
                        <th class="text-white"> Sueldo Semanal </th>
                        <th class="text-white"> Categoria </th>
						<th class="text-white"> Estado </th>
						<th class="text-white">  </th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="item in obreros">
						<td with="50">
							<input type="text" size="50" v-model="item.nombres" />
						</td>
                        <td>
							<input type="text" v-model="item.apellidos" />
						</td>
                        <td>
							<input type="date" v-model="item.monto_sueldo_semanal" />
						</td>
                        <td>
                        <select id="categoria" name="categoria">
								<option value="1"> Obrero </option>
								<option value="2"> Arquitecto </option>
							</select>
						</td>
						<td>
							<select id="estado" name="estado">
								<option value="1"> Activo </option>
								<option value="0"> Inactivo </option>
							</select>
						</td>
						<td>
							<button class="btn btn-success" v-on:click=""> Guardar </button>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
    </div>
</div>
</div>