<!-- Modal del Módulo: Material -->
<!--add modal-->
<modal v-if="addModal" @close="ClearAll()">

<h3 slot="head" >Nuevo Material</h3>
<div slot="body" class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Nombre del Material</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombre_material}" name="nombre_material" v-model="newMaterial.nombre_material">
            
             <div class="has-text-danger" v-html="formValidate.nombre_material"> </div>
    </div>
    <div class="form-group">
    <label>Unidad</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.unidad}" name="unidad" v-model="newMaterial.unidad">
            
             <div class="has-text-danger" v-html="formValidate.unidad"> </div>
    </div>
    <div class="form-group">
     <label for="">Estado</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-mars" :class="{'active':(newMaterial.estado_material == '1')}" @click.prevent="pickEstado('1')"> Activo</button>
  		<button class="btn btn-outline-dark fa fa-venus" :class="{'active': (newMaterial.estado_material == '0')}" @click.prevent="pickEstado('0')"> Inactivo</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_material"></div>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_material"></div>
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="insertarMaterial">Guardar</button>
</div>

</modal>



<!--update modal-->

<modal v-if="editModal" @close="ClearAll()">
<h3 slot="head" >Actualizar Material</h3>
<div slot="body" class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Nombre del Material</label>
            <input type="text" class="form-control" name="nombre_material" v-model="chooseMaterial.nombre_material">
            
             <div class="has-text-danger" v-html="formValidate.nombre_material"> </div>
    </div>
    <div class="form-group">
    <label>Unidad</label>
            <input type="text" class="form-control" name="unidad" v-model="chooseMaterial.unidad">
            
             <div class="has-text-danger" v-html="formValidate.unidad"> </div>
    </div>
    <div class="form-group">
     <label for="">Estado</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-check" :class="{'active':(chooseMaterial.estado_binario == '1')}" @click.prevent="changeEstado('1')"> Activo</button>
  		<button class="btn btn-outline-dark fa fa-ban" :class="{'active': (chooseMaterial.estado_binario == '0')}" @click.prevent="changeEstado('0')"> Inactivo</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_material"></div>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_material"></div>
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="actualizarMaterial">Guardar</button>
</div>
</modal>