<!-- Modal del Módulo: Pagos  -->
<!--add modal-->
<modal v-if="addModal" @close="ClearAll()">
<!--
<h3 slot="head" >Nuevo Pago</h3>
<div slot="body" class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Nombre del Proyecto</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombre_proyecto}" name="nombre_proyecto" v-model="newProyecto_construccion.nombre_proyecto">
            
             <div class="has-text-danger" v-html="formValidate.nombre_proyecto"> </div>
    </div>
    <div class="form-group"> 
    <label>Inicio</label>
            <input type="date" class="form-control" :class="{'is-invalid': formValidate.fecha_inicio}" name="fecha_inicio" v-model="newProyecto_construccion.fecha_inicio">
            
             <div class="has-text-danger" v-html="formValidate.fecha_inicio"> </div>
	</div>
	<div class="form-group"> 
    <label>Fin</label>
            <input type="date" class="form-control" :class="{'is-invalid': formValidate.fecha_fin}" name="fecha_fin" v-model="newProyecto_construccion.fecha_fin">
            
             <div class="has-text-danger" v-html="formValidate.fecha_fin"> </div>
	</div>
    <div class="form-group">
     <label for="">Estado</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-mars" :class="{'active':(newProyecto_construccion.estado_proyecto == '1')}" @click.prevent="pickEstado('1')"> Activo</button>
  		<button class="btn btn-outline-dark fa fa-venus" :class="{'active': (newProyecto_construccion.estado_proyecto == '0')}" @click.prevent="pickEstado('0')"> Inactivo</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_proyecto"></div>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_proyecto"></div>
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="insertarProyecto_construccion">Guardar</button>
</div>
---->
</modal>



<!--update modal-->

<modal v-if="editModal" @close="ClearAll()">
<!--
<h3 slot="head" >Actualizar Pago</h3>
<div slot="body" class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Nombre del Proyecto</label>
            <input type="text" class="form-control" name="nombre" v-model="chooseProyecto_construccion.nombre_proyecto">
            
             <div class="has-text-danger" v-html="formValidate.nombre_proyecto"> </div>
    </div> -->
    <!-- Se pone las fechas con el formato original  
    <div class="form-group"> 
    <label>Inicio</label>
            <input type="date" class="form-control" :class="{'is-invalid': formValidate.fecha_inicio}" name="fecha_inicio" v-model="chooseProyecto_construccion.inicio">
            
             <div class="has-text-danger" v-html="formValidate.fecha_inicio"> </div>
	</div>
	<div class="form-group"> 
    <label>Fin</label>
            <input type="date" class="form-control" :class="{'is-invalid': formValidate.fecha_fin}" name="fecha_fin" v-model="chooseProyecto_construccion.fin">
            
             <div class="has-text-danger" v-html="formValidate.fecha_fin"> </div>
	</div>
    <div class="form-group">
     <label for="">Estado</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-check" :class="{'active':(chooseProyecto_construccion.estado_binario == '1')}" @click.prevent="changeEstado('1')"> Activo</button>
  		<button class="btn btn-outline-dark fa fa-ban" :class="{'active': (chooseProyecto_construccion.estado_binario == '0')}" @click.prevent="changeEstado('0')"> Inactivo</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_proyecto"></div>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_proyecto"></div>
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="actualizarProyecto_construccion">Guardar</button>
</div>  --> 
</modal>

<!--pago modal-->

<modal v-if="pagoModal" @close="ClearAll()">
<h3 slot="head" >Realizar Pago</h3>
<div slot="body" class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Monto a depositar</label>
            <input readonly type="text" class="form-control" :class="{'is-invalid': formValidate.sueldo_cobrar}" name="fecha_inicio" v-model="choosePago.sueldo_cobrar">
            
             <div class="has-text-danger" v-html="formValidate.sueldo_cobrar"> </div>
    </div>
    <!-- Se pone las fechas con el formato original  --> 
    <div class="form-group"> 
    <label>Trabajador</label>
            <input readonly type="text" class="form-control" :class="{'is-invalid': formValidate.nombres_apellidos_trabajador}" name="nombres_apellidos_trabajador" v-model="choosePago.nombres_apellidos_trabajador">
            
             <div class="has-text-danger" v-html="formValidate.nombres_apellidos_trabajador"> </div>
	</div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="realizarPago">Enviar</button>
</div>
</modal>