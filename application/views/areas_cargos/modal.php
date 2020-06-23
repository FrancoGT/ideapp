<!-- Modal del Módulo: Areas y cargos -->
<!--add modal-->
<modal v-if="addModal" @close="ClearAll()">

<h3 slot="head" >Nuevo Área/Cargo</h3>
<div slot="body" class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Código</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.cod_area_cargo}" name="cod_area_cargo" v-model="newArea_cargo.cod_area_cargo">
            
             <div class="has-text-danger" v-html="formValidate.cod_area_cargo"> </div>
    </div>
    <div class="form-group">
    <label>Área</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.area}" name="area" v-model="newArea_cargo.area">
            
             <div class="has-text-danger" v-html="formValidate.area"> </div>
    </div>
    <div class="form-group">
    <label>Cargo</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.cargo}" name="cargo" v-model="newArea_cargo.cargo">
            
             <div class="has-text-danger" v-html="formValidate.cargo"> </div>
    </div>
    <div class="form-group">
     <label for="">Estado</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-mars" :class="{'active':(newArea_cargo.estado_area_cargo == '1')}" @click.prevent="pickEstado('1')"> Activo</button>
  		<button class="btn btn-outline-dark fa fa-venus" :class="{'active': (newArea_cargo.estado_area_cargo == '0')}" @click.prevent="pickEstado('0')"> Inactivo</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_area_cargo"></div>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_area_cargo"></div>
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="insertarArea_cargo">Guardar</button>
</div>

</modal>



<!--update modal-->

<modal v-if="editModal" @close="ClearAll()">
<h3 slot="head" >Actualizar Área/Cargo</h3>
<div slot="body" class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Código</label>
            <input type="text" class="form-control" name="cod_area_cargo" v-model="chooseArea_cargo.cod_area_cargo">
            
             <div class="has-text-danger" v-html="formValidate.cod_area_cargo"> </div>
    </div>
    <div class="form-group">
    <label>Área</label>
            <input type="text" class="form-control" name="area" v-model="chooseArea_cargo.area">
            
             <div class="has-text-danger" v-html="formValidate.area"> </div>
    </div>
    <div class="form-group">
    <label>Cargo</label>
            <input type="text" class="form-control" name="cargo" v-model="chooseArea_cargo.cargo">
            
             <div class="has-text-danger" v-html="formValidate.cargo"> </div>
    </div>
    <div class="form-group">
     <label for="">Estado</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-check" :class="{'active':(chooseArea_cargo.estado_binario == '1')}" @click.prevent="changeEstado('1')"> Activo</button>
  		<button class="btn btn-outline-dark fa fa-ban" :class="{'active': (chooseArea_cargo.estado_binario == '0')}" @click.prevent="changeEstado('0')"> Inactivo</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_area_cargo"></div>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_area_cargo"></div>
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="actualizarArea_cargo">Guardar</button>
</div>
</modal>