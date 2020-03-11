<!--add modal-->
<modal v-if="addModal" @close="clearAllProyecto_construccion()">

<h3 slot="head" >Agregar Nuevo Proyecto de Construcci&oacute;n</h3>
<div slot="body" class="row">
<div class="col-md-6">
<div class="form-group"><label>Nombre</label> <input class="form-control" name="nombre" type="text" />
<div class="has-text-danger">&nbsp;</div>
</div>
<div class="form-group"><label>Inicio de la obra</label>&nbsp;<input class="form-control" name="inicio_obra" type="date" /></div>
<div class="form-group">&nbsp;</div>
<div class="form-group">Fin de la obra&nbsp;<input class="form-control" name="fin_obra" type="date" /></div>
</div>
<div class="col-md-6">
<div class="form-group">
     <label for="">Estado</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-mars" :class="{'active':(newProyecto_construccion.estado == '1')}" @click.prevent="pickEstado('1')"> Activo</button>
        <button class="btn btn-outline-dark fa fa-venus" :class="{'active': (newProyecto_construccion.estado == '0')}" @click.prevent="pickEstado('0')"> Inactivo</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado"></div>
    </div>
</div>
</div>
</div>
<div><button class="btn btn-dark">Agregar</button></div>

</modal>



<!--update modal-->

<modal v-if="editModal" @close="clearAllProyecto_construccion()">
<h3 slot="head" >Actualizar Proyecto Construccion</h3>
<div slot="body" class="row">
<div class="col-md-6">
<div class="form-group"><label>Nombre</label>&nbsp;<input class="form-control" name="nombre" type="text" />
<div class="has-text-danger">&nbsp;</div>
</div>
<label for="">Estado</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-mars" :class="{'active':(chooseProyecto_construccion.estado == '1')}" @click="changeEstado('1')"> Activo</button>
  <button class="btn btn-outline-dark fa fa-venus" :class="{'active': (chooseProyecto_construccion.estado == '0')}" @click="changeEstado('0')"> Inactivo</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado"></div>
    </div>
</div>
<div class="form-group"><label>Inicio de obra</label> <input class="form-control" name="inicio_obra" type="date" />
<div class="has-text-danger">&nbsp;</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group"><label>Fin de obra</label> <input class="form-control" name="fin_obra" type="date" /><br />
<div class="has-text-danger">&nbsp;</div>
</div>
<div class="form-group">
<div class="has-text-danger">&nbsp;</div>
</div>
</div>
<div><button class="btn btn-dark">Actualizar Datos</button></div>
<!--delete modal-->
<h3>Eliminar</h3>
<div class="text-center">&iquest;Seguro que quieres eliminar este registro?</div>
<div><button class="btn btn-dark">Eliminar</button> <button class="btn">Cancelar</button></div>