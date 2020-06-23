<div id="pagos">
  <br>
    <div  align="center">
        <h1>CONTROL DE PAGOS</h1>
    </div>
	<div class="container">
    <div class="row">
        <div class="col-md-12">
           <table class="table bg-dark my-3">
               <tr>
                   <td> <button class="btn btn-default btn-block" @click="addModal= true">Nuevo Registro</button></td>
                   <td><input placeholder="Buscar" type="search" class="form-control" ></td>
               </tr>
           </table>
            <table class="table is-bordered is-hoverable">
               <thead class="text-white bg-dark" >
               <th class="text-white">Código de trabajador</th>
                <th class="text-white">TRABAJADOR</th>
				<th class="text-white" >Sueldo Semanal</th>
				<th class="text-white" >T/C</th>
				<th class="text-white" > Lunes </th>
				<th class="text-white" > Martes </th>
				<th class="text-white" > Miércoles </th>
				<th class="text-white" > Jueves </th>
				<th class="text-white" > Viernes </th>
				<th class="text-white" > Sábado</th>
                <th class="text-white" >SUELDO A COBRAR</th>
                <th colspan="2" class="text-center text-white">Editar/Pagar</th>
                </thead>
                <tbody class="table-light">
				<div align="center" v-if="cargando_pagos">
					<h1>Cargando registros... </h1>
				</div>
                    <tr v-for="item in pagos" class="table-default">
                        <td>{{item.codigo_trabajador}}</td>
                        <td>{{item.nombres_apellidos_trabajador}}</td>
                        <td>{{item.sueldo_semanal_trabajador}}</td>
						<td>{{item.TC}}</td>
						<td>{{item.horas_lunes}}</td>
						<td>{{item.horas_martes}}</td>
						<td>{{item.horas_miercoles}}</td>
						<td>{{item.horas_jueves}}</td>
						<td>{{item.horas_viernes}}</td>
						<td>{{item.horas_sabado}}</td>
						<td>{{item.sueldo_cobrar}}</td>
                        <td><button class="btn btn-info fa fa-edit" @click="editModal = true; selectPago(item)"></button></td>
                        <td><button class="btn btn-success fa fa-money" @click="pagoModal = true; selectPago(item)"></button></td>
                    </tr>
                    <tr v-if="emptyResult">
                      <td colspan="9" rowspan="4" class="text-center h1">No hay registros</td>
                    </tr>
                </tbody>
                
            </table>
            
        </div>
  
    </div>
</div>
<?php include 'modal.php';?>