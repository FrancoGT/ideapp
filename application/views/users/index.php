<div id="app">
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
                   <td> <button class="btn btn-default btn-block" @click="addModal= true">Agregar Nuevo Usuario</button></td>
                   <td><input placeholder="Buscar"type="search" class="form-control" v-model="search.text" @keyup="searchUser" name="search"></td>
               </tr>
           </table>
            <table class="table is-bordered is-hoverable">
               <thead class="text-white bg-dark" >
                
                <th class="text-white">ID</th>
                <th class="text-white">Nombres</th>
                <th class="text-white">Apellidos</th>
                <th class="text-white">Correo Electr&oacute;nico</th>
                <th class="text-white">Tel&eacute;fono</th>
                <th class="text-white">Direcci&oacute;n</th>
                <th class="text-white">G&eacute;nero</th>
                <th colspan="2" class="text-center text-white">Acciones</th>
                </thead>
                <tbody class="table-light">
                    <tr v-for="user in users" class="table-default">
                        <td>{{user.id}}</td>
                        <td>{{user.firstname}}</td>
                        <td>{{user.lastname}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.contact}}</td>
                        <td>{{user.address}}</td>
                        <td>
                        <img :src="imgGender(user.gender)"  width='50' height="50">
                        </td>
                        <td><button class="btn btn-info fa fa-edit" @click="editModal = true; selectUser(user)"></button></td>
                        <td><button class="btn btn-danger fa fa-trash" @click="deleteModal = true; selectUser(user)"></button></td>
                    </tr>
                    <tr v-if="emptyResult">
                      <td colspan="9" rowspan="4" class="text-center h1">No hay registros</td>
                  </tr>
                </tbody>
                
            </table>
            
        </div>
  
    </div>
     <pagination
        :current_page="currentPage"
        :row_count_page="rowCountPage"
         @page-update="pageUpdate"
         :total_users="totalUsers"
         :page_range="pageRange"
         >
      </pagination>
</div>
<?php include 'modal.php';?>

</div>

