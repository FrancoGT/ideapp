<div id="usuario">
  <br>
    <div  align="center">
        <h1>PERFIL USUARIO</h1> <br><br>
    </div>
	<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table is-bordered is-hoverable">
               <thead class="text-white bg-dark" >
               <th class="text-white">Nombres</th>
                <th class="text-white">Apellidos</th>
                <th class="text-white">Nick</th>
                <th class="text-center text-white"></th>
                </thead>
                <div align="center" v-if="cargando_perfil">
				    <h1>Cargando registros... </h1>
			    </div>
                <tbody class="table-light">
                    <tr v-for="item in perfil" class="table-default">
                        <td>{{item.nombres}}</td>
                        <td>{{item.apellidos}}</td>
                        <td>{{item.username}}</td>
                        <td><button class="btn btn-info fa fa-edit" @click="editModal = true; selectPerfil(item)"></button></td>
                    </tr>
                    <tr v-if="emptyResult">
                      <td colspan="9" rowspan="4" class="text-center h1">No hay registros</td>
                  </tr>
                </tbody>
                
            </table>
        </div>
  
    </div>
</div>
<?php include 'modal.php'; ?>