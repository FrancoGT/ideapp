            <table class="table is-bordered is-hoverable" v-if="">    
                <thead class="text-white bg-dark" >
					<tr>
						<th class="text-white"> Nombre </th>
						<th class="text-white"> Unidad </th>
						<th class="text-white"> Estado </th>
						<th class="text-white">  </th>
					</tr>
				</thead>
				<tbody>                    
                    <tr>
						<td>
							<input type="text" v-model="material_nuevo.nombre_material" />
						</td>
						<td>
							<input type="text" v-model="material_nuevo.unidad" />
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
		</form>