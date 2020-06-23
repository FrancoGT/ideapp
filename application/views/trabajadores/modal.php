<!-- Modal del Módulo: Trabajadores -->
<!--add modal-->
<modal v-if="addModal" @close="ClearAll()">

<h3 slot="head" >Nuevo Trabajador</h3>
<div slot="body" class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Código</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.cod_trabajador}" name="cod_trabajador" v-model="newTrabajador.cod_trabajador">
            
             <div class="has-text-danger" v-html="formValidate.cod_trabajador"> </div>
    </div>
    <div class="form-group">
    <label>Nombres</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.nombres}" name="nombres" v-model="newTrabajador.nombres">
            
             <div class="has-text-danger" v-html="formValidate.nombres"> </div>
    </div>
    <div class="form-group">
    <label>Apellidos</label>
            <input type="text" class="form-control" :class="{'is-invalid': formValidate.apellidos}" name="apellidos" v-model="newTrabajador.apellidos">
            
             <div class="has-text-danger" v-html="formValidate.apellidos"> </div>
    </div>
    <div class="form-group">
    <label>Área/Cargo</label>
    
    <select name="id_area_cargo" id="id_area_cargo" value=""></select>

    </div>
    </ul>
    <div class="form-group">
     <label for="">Estado</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-mars" :class="{'active':(newTrabajador.estado_trabajador == '1')}" @click.prevent="pickEstado('1')"> Activo</button>
  		<button class="btn btn-outline-dark fa fa-venus" :class="{'active': (newTrabajador.estado_trabajador == '0')}" @click.prevent="pickEstado('0')"> Inactivo</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_trabajador"></div>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_trabajador"></div>
    </div>
</div>
<div slot="foot">
    <button id="guardar" name="guardar" class="btn btn-dark" @click="insertarTrabajador">Guardar</button>
</div>
</modal>


<!--update modal-->

<modal v-if="editModal" @close="ClearAll()">
<h3 slot="head" >Actualizar Trabajador</h3>
<div slot="body" class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label>Códigos</label>
            <input type="text" class="form-control" name="cod_trabajador" v-model="chooseTrabajador.cod_trabajador">
            
             <div class="has-text-danger" v-html="formValidate.cod_trabajador"> </div>
    </div>
    <div class="form-group">
    <label>Nombres</label>
            <input type="text" class="form-control" name="nombres" v-model="chooseTrabajador.nombres">
            
             <div class="has-text-danger" v-html="formValidate.nombres"> </div>
    </div>
    <div class="form-group">
    <label>Apellidos</label>
            <input type="text" class="form-control" name="apellidos" v-model="chooseTrabajador.apellidos">
            
             <div class="has-text-danger" v-html="formValidate.apellidos"> </div>
    </div>
    <!-- Pendiente: Jalar id_area_cargo -->
    <div class="form-group">
    <label>Área/Cargo</label>
            <input type="text" id="id_area_cargo" class="form-control" :class="{'is-invalid': formValidate.id_area_cargo}" name="area_cargo" v-model="chooseTrabajador.id_area_cargo">
            
             <div class="has-text-danger" v-html="formValidate.area_cargo"> </div>
    </div>
    <input type="hidden" id="id_area_cargo2" name="id_area_cargo2" value=''/>
    <div class="form-group">
     <label for="">Estado</label><br>
    <div class="btn-group">
        <button class="btn btn-outline-dark fa fa-check" :class="{'active':(chooseTrabajador.estado_binario == '1')}" @click.prevent="changeEstado('1')"> Activo</button>
  		<button class="btn btn-outline-dark fa fa-ban" :class="{'active': (chooseTrabajador.estado_binario == '0')}" @click.prevent="changeEstado('0')"> Inactivo</button>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_trabajador"></div>
    </div>
   <div  class="has-text-danger"v-html="formValidate.estado_trabajador"></div>
    </div>
</div>
<div slot="foot">
    <button class="btn btn-dark" @click="actualizarTrabajador">Guardar</button>
</div>
</modal>
<script type="application/javascript">
    $(document).ready(function() 
    {
        const temp = $.ajax({
            url: "<?php echo base_url();?>index.php/recurso_humano/get_data_area_cargo",
            type: "POST",
            dataType: "json",
            async: false
        }).responseJSON; 
        var $select = $('#id_area_cargo');
        $.each(temp, function(i, item) 
        {
            $select.append('<option value =' + temp[i].id_area_cargo + '>' +  temp[i].area + '/' + temp[i].cargo + '</option>');
        });
    }); 
    
</script>
