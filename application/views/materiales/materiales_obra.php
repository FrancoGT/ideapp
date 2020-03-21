<div id="modulo_materiales">
  <br>
    <div align="center">
        <h1>MATERIALES REGISTRADOS</h1>
		<br>
    </div>
   <div align="center" class="col-md-12">
    <div align="center">
    <form action="javascript:void(0);" id="modulo_materiales">
			<div align="center" v-if="cargando_materiales">
				<h1>Cargando registros... </h1>
			</div>
			<div align="center" class="col-md-8">
			<table align="center" class="table is-bordered is-hoverable" v-if="!cargando_materiales">
				<thead class="text-white bg-dark" >
					<tr>
						<th class="text-white"> Nombre </th>
						<th class="text-white"> Unidad </th>
						<th class="text-white"> Estado </th>
						<th class="text-white">  </th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="item in materiales">
						<td width="50">
							<input type="text" size="50" v-model="item.nombre_material" />
						</td>
                        <td width="11">
							<input type="text" size="11" v-model="item.unidad" />
						</td>
						<td>
							<select id="estado" name="estado">
								<option value="1"> Activo </option>
								<option value="0"> Inactivo </option>
							</select>
						</td>
						<td>
							<button class="btn btn-success" v-on:click="modificarMaterial(item)"> Guardar </button>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		</div>
    </div>
</div>
</div>