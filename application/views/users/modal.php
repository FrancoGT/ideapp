<!--add modal-->
<modal v-if="addModal" @close="clearAll()">

<h3 slot="head" >Agregar Nuevo Usuario</h3>
<div slot="body" class="row">
    <div class="col-md-6">
          <div class="form-group">
    <label>Nombres</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.firstname}" name="firstname" v-model="newUser.firstname">
            
             <div class="has-text-danger" v-html="formValidate.firstname"> </div>
            </div>
         <div class="form-group"> 
    <label>Apellidos</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.lastname}" name="lastname" v-model="newUser.lastname">
            
             <div class="has-text-danger" v-html="formValidate.lastname"> </div>
</div>
            <div class="form-group">
     <label for="">G&eacute;nero</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-mars" :class="{'active':(newUser.gender == 'boy')}" @click.prevent="pickGender('boy')"> Male</button>
  <button class="btn btn-outline-dark fa fa-venus" :class="{'active': (newUser.gender == 'girl')}" @click.prevent="pickGender('girl')"> Female</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.gender"></div>
    </div>
    <div class="form-group">
       <label>Fecha de nacimiento</label>
        <input type="date" class="form-control" :class="{'is-invalid': formValidate.birthday}" name="birthday" v-model="newUser.birthday">
        <div class="has-text-danger" v-html="formValidate.birthday"> </div>
    </div>
    </div>
    <div class="col-md-6">
  <div class="form-group">
           <label>Correo Electr&oacute;nico</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.email}" name="email" v-model="newUser.email">
                <div class="has-text-danger" v-html="formValidate.email"></div>
        </div>
        <div class="form-group">
           <label>Tel&eacute;fono</label>
            <input type="text" class="form-control":class="{'is-invalid': formValidate.contact}" name="contact" v-model="newUser.contact">
             <div class="has-text-danger" v-html="formValidate.contact"> </div>
        </div>
        <div class="form-group">
            <label>Direcci&oacute;n</label>
            <textarea cols="35" rows="5" :class="{'is-invalid': formValidate.address}" name="address" v-model="newUser.address" class="form-control"></textarea>
            <div class="has-text-danger" v-html="formValidate.address"> </div>
        </div>
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="addUser">Agregar</button>
</div>

</modal>



<!--update modal-->

<modal v-if="editModal" @close="clearAll()">
<h3 slot="head" >Edit User</h3>
<div slot="body" class="row">
    <div class="col-md-6">
          <div class="form-group">
       
    <label>Nombres</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.firstname}" name="firstname" v-model="chooseUser.firstname">
            
             <div class="has-text-danger" v-html="formValidate.firstname"> </div>
</div>
         <div class="form-group">
       
    <label>Apellidos</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.lastname}" name="lastname" v-model="chooseUser.lastname">
            
             <div class="has-text-danger" v-html="formValidate.lastname"> </div>
</div>
     
            <div class="form-group">
     <label for="">G&eacute;nero</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-mars" :class="{'active':(chooseUser.gender == 'boy')}" @click="changeGender('boy')"> Male</button>
  <button class="btn btn-outline-dark fa fa-venus" :class="{'active': (chooseUser.gender == 'girl')}" @click="changeGender('girl')"> Female</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.gender"></div>
    </div>
    <div class="form-group">
       <label>Fecha de nacimiento</label>
        <input type="date" class="form-control" :class="{'is-invalid': formValidate.birthday}" name="birthday" v-model="chooseUser.birthday">
        <div class="has-text-danger" v-html="formValidate.birthday"> </div>
    </div>
    </div>
    <div class="col-md-6">
  <div class="form-group">
           <label>Correo Electr&oacute;nico</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.email}" name="email" v-model="chooseUser.email">
                <div class="has-text-danger" v-html="formValidate.email"></div>
        </div>
        <div class="form-group">
           <label>Tel&eacute;fono</label>
            <input type="text" class="form-control":class="{'is-invalid': formValidate.contact}" name="contact" v-model="chooseUser.contact">
             <div class="has-text-danger" v-html="formValidate.contact"> </div>
        </div>
        <div class="form-group">
            <label>Direcci&oacute;n</label>
            <textarea cols="35" rows="5" :class="{'is-invalid': formValidate.address}" name="address" v-model="chooseUser.address" class="form-control"></textarea>
            <div class="has-text-danger" v-html="formValidate.address"> </div>
        </div>
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="updateUser">Actualizar Datos</button>
</div>
</modal>


<!--delete modal-->
<modal v-if="deleteModal" @close="clearAll()">
    <h3 slot="head">Eliminar</h3>
    <div slot="body" class="text-center">¿Seguro que quieres eliminar este registro?</div>
    <div slot="foot">
        <button class="btn btn-dark" @click="deleteModal = false; deleteUser()" >Eliminar</button>
        <button class="btn" @click="deleteModal = false">Cancelar</button>
    </div>
</modal>