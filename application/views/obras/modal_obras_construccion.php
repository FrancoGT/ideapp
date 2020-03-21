            <table class="table is-bordered is-hoverable" v-if="!cargando_proyecto_construccion">
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
                    <tr>
						<td>
							<input type="text" v-model="proyecto_construccion_nuevo.nombre_proyecto" />
						</td>
						<td>
							<input type="date" v-model="proyecto_construccion_nuevo.fecha_inicio" />
						</td>
                        <td>
							<input type="date" v-model="proyecto_construccion_nuevo.fecha_fin" />
						</td>
						<td>
                            <p>
                            <input autocomplete="off" type="radio" required name="estado" value="1"/>
                            Activo
                            <input autocomplete="off" type="radio" required name="estado" value="0"/>
                            Inactivo </p>
						</td>
						<td>
							<button class="btn btn-success" v-on:click="agregarProyecto_construccion()"> Guardar </button>
						</td>
					</tr>
				</tbody>
			</table>