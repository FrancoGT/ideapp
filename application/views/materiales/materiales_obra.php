<div id="materiales_obra">
  <br>
    <div  align="center">
        <h1>MATERIALES DE OBRA</h1>
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
                <th class="text-white"> Nombre </th>
                <th class="text-white"> Unidad </th>
                <th class="text-white"> Estado </th>
                <th class="text-center text-white"></th> <!---  colspan="2"   -->
                </thead>
                <tbody class="table-light">
                <div align="center" v-if="cargando_materiales">
				    <h1>Cargando registros... </h1>
			    </div>
                    <tr v-for="item in materiales" class="table-default">
                        <td>{{item.nombre_material}}</td>
                        <td>{{item.unidad}}</td>
                        <td>{{item.estado_material}}</td>
                        <td><button class="btn btn-info fa fa-edit" @click="editModal = true; selectMaterial(item)"></button></td>
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
