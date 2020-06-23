<div id="presupuestos">
    <div class="container">
    <div class="row">
        <div class="col-md-15">
        
           <table class="table bg-dark my-3" >
               <tr>
                   <td> <button class="btn btn-default btn-block" @click="addModal= true">Nuevo Registro</button></td>
                   <td><input placeholder="Buscar" type="search" class="form-control" ></td>
               </tr>
           </table>
           <!-- 
                <div align="center" v-if="cargando_presupuestos" >
                    <h1>Cargando registros...</h1>
                </div> 
                Pendiente: Separar proyectos de obra 
                <ul v-for="item in presupuestos">
                    <h1>{{item.nombre_proyecto_construccion}}</h1>
                    <h1>{{item.inversion_total}}</h1>
                </ul> ---->
                
            <table class="table is-bordered is-hoverable">
               <thead class="text-white bg-dark" >
				<th class="text-white" > Material </th>
				<th class="text-white" > Tipo </th>
				<th class="text-white" > Precio Unitario </th>
				<th class="text-white" > Cantidad </th>
				<th class="text-white" > Costo Adicional </th>
				<th class="text-white" > Subtotal </th>
				<th class="text-white" > Fecha </th>
				<th class="text-white" > Estado</th>
                <th class="text-white" ></th>
                </thead>
                <tbody class="table-light">
                <div align="center" v-if="cargando_presupuestos" >
				    <h1>Cargando registros...</h1>
			    </div>
                    <tr class="table-default" v-for="item in presupuestos">
                        <td>{{item.nombre_material}}</td>
						<td>{{item.tipo_obra}}</td>
						<td>{{item.precio_unitario}}</td>
						<td>{{item.cantidad}}</td>
						<td>{{item.costo_adicional}}</td>
						<td>{{item.subtotal}}</td>
						<td>{{item.fecha_costo}}</td>
						<td>{{item.estado_material_obra_costo}}</td>
                        <td><button class="btn btn-info fa fa-edit" @click="editModal = true; selectProyecto_construccion(item)"></button></td>
                    </tr>
                    <tr v-if="emptyResult">
                      <td colspan="9" rowspan="4" class="text-center h1">No hay registros</td>
                    </tr>
                </tbody>
                
            </table>
        </div>
    </div>
</div>
<?php //include 'modal_obras_construccion.php';?>