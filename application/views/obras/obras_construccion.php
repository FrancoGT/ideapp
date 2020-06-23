<div id="obras_construccion">
  <br>
    <div  align="center">
        <h1>PROYECTOS DE OBRA</h1>
    </div>
	<div class="container">
    <div class="row">
        <div class="col-md-12">
           <table class="table bg-dark my-3">
               <tr>
                   <td> <button class="btn btn-default btn-block" @click="addModal= true">Nuevo Registro</button></td>
                   <td> <input type="search" placeholder="Buscar" class="form-control" name="search" v-model="search.text"></td>
               </tr>
           </table>
            <table class="table is-bordered is-hoverable">
               <thead class="text-white bg-dark" >
                <th class="text-white">Nombre</th>
                <th class="text-white">Inicio</th>
                <th class="text-white">Fin</th>
                <th class="text-white">Estado</th>
                <th class="text-center text-white"></th>
                </thead>
                <div align="center" v-if="cargando_obras">
				    <h1>Cargando registros... </h1>
			    </div>
                <tbody class="table-light">
                    <tr v-for="item in proyecto_construccion" class="table-default">
                        <td>{{item.nombre_proyecto}}</td>
                        <td>{{item.fecha_inicio}}</td>
                        <td>{{item.fecha_fin}}</td>
                        <td>{{item.estado_proyecto}}</td>
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
<?php include 'modal.php';?>