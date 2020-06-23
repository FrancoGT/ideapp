<!-- Modal del Módulo: Perfil Usuario -->
<!--update modal -->

<modal v-if="editModal" @close="clearAll()">
<h3 slot="head" >Actualizar Perfil</h3>
<div slot="body" class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Nombres del Usuario</label>
            <input autocomplete="false" type="text" class="form-control" name="nombre" v-model="choosePerfil.nombres">
            
             <div class="has-text-danger" v-html="formValidate.nombres"> </div>
    </div>
    <div class="form-group">
    <label>Apellidos del Usuario</label>
            <input autocomplete="false" type="text" class="form-control" name="apellidos" v-model="choosePerfil.apellidos">
            
             <div class="has-text-danger" v-html="formValidate.apellidos"> </div>
    </div>
    <div class="form-group">
    <label>Nick del Usuario</label>
            <input autocomplete="false" type="text" class="form-control" name="username" v-model="choosePerfil.username">
            
             <div class="has-text-danger" v-html="formValidate.username"> </div>
    </div>
    <div class="form-group">
    <label>Contraseña del Usuario</label>
            <input autocomplete="false" type="password" class="form-control" name="contra" v-model="choosePerfil.contra">
             <div class="has-text-danger" v-html="formValidate.contra"> </div>
             <p class="help-block">
                La contraseña solo se modificara si llenas este campo, en caso contrario no se modifica.
            </p>
    </div>
<div slot="foot">
    <button class="btn btn-dark" @click="actualizarPerfil">Guardar</button>
</div>
</modal>