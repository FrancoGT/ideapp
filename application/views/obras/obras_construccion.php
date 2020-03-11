<div id="app">
  <br>
    <div align="center">
        <h1>OBRAS EN CONSTRUCCI&Oacute;N</h1>
    </div>
   <div class="container">
    <div class="row">
        <transition
                enter-active-class="animated fadeInLeft"
                     leave-active-class="animated fadeOutRight">
                     <div class="notification is-success text-center px-5 top-middle" v-if="successMSG" @click="successMSG = false">{{successMSG}}</div>
            </transition>
        <div class="col-md-12">
           <table class="table bg-dark my-3">
               <tr>
                   <td> <button class="btn btn-default btn-block" @click="addModal= true">Agregar Nuevo Proyecto de Construccion</button></td>
                   <td><input placeholder="Buscar" type="search" class="form-control" v-model="search.text" @keyup="searchProyecto_construccion" name="search"></td>
               </tr>
           </table>
            <table class="table is-bordered is-hoverable">
               <thead class="text-white bg-dark" >
                
                <th class="text-white">Nombre de Proyecto</th>
                <th class="text-white">Fecha Inicio</th>
                <th class="text-white">Fecha Fin</th>
                <th class="text-white">Estado</th>
                <th colspan="2" class="text-center text-white">Acciones</th>
                </thead>
                <tbody class="table-light">
                    <tr v-for="proyecto_construccion in items_proyecto_construccion" class="table-default">
                        <td>{{proyecto_construccion.nombre_proyecto}}</td>
                        <td>{{proyecto_construccion.fecha_inicio}}</td>
                        <td>{{proyecto_construccion.fecha_fin}}</td>
                        <td>{{proyecto_construccion.estado_proyecto}}</td>
                        
                        <td><button class="btn btn-info fa fa-edit" @click="editModal = true; selectProyecto_construccion(proyecto_construccion)"></button></td>
                        <td><button class="btn btn-danger fa fa-trash" @click="deleteModal = true; selectProyecto_construccion(proyecto_construccion)"></button></td>
                    </tr>
                    <tr v-if="emptyResult">
                      <td colspan="9" rowspan="4" class="text-center h1">No hay registros</td>
                  </tr>
                </tbody>
                
            </table>
            
        </div>
  
    </div>
     <pagination_proyecto_construccion
        :current_page="currentPage"
        :row_count_page="rowCountPage"
         @page-update="pageUpdateProyecto_construccion"
         :totalItems_proyecto_construccion="totalItems_proyecto_construccion"
         :page_range="pageRange"
         >
      </pagination_proyecto_construccion>
</div>
<?php include 'modal_proyecto_construccion.php';?>

</div>