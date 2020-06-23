<div id="trabajadores">
  <br>
    <div  align="center">
        <h1>TRABAJADORES</h1>
    </div>
	<div class="container">
    <div class="row">
        <div class="col-md-12">
           <table class="table bg-dark my-3">
               <tr>
                   <td> <button class="btn btn-default btn-block" @click="addModal= true">Nuevo Registro</button></td>
                   <td><input placeholder="Buscar" type="search" class="form-control" ></td>
               </tr>
           </table>
            <table class="table is-bordered is-hoverable">
               <thead class="text-white bg-dark" >
               <th class="text-white"> Código </th>
                <th class="text-white"> Trabajador </th>
                <th class="text-white"> &Aacute;rea</th>
                <th class="text-white"> Cargo </th>
				<th class="text-white"> Estado </th>
                <th class="text-center text-white"></th>
                </thead>
                <tbody class="table-light">
                <div align="center" v-if="cargando_trabajadores">
				    <h1>Cargando registros... </h1>
			    </div>
                    <tr v-for="item in trabajadores" class="table-default">
                        <td>{{item.cod_trabajador}}</td>
                        <td>{{item.trabajador}}</td>
                        <td>{{item.area}}</td>
                        <td>{{item.cargo}}</td>
						<td>{{item.estado_trabajador}}</td>
                        <td><button class="btn btn-info fa fa-edit" @click="editModal = true; selectTrabajador(item)"></button></td>
                    </tr>
                    <tr v-if="emptyResult">
                      <td colspan="9" rowspan="4" class="text-center h1">No hay registros</td>
                    </tr>
                </tbody>
                
            </table>
            
        </div>
  
    </div>
</div>
<?php include 'modal.php';?>