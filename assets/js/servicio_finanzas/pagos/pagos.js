window.onload = function () 
{
	Vue.component('modal',{ //modal
		template:`
		  <transition
					enter-active-class="animated rollIn"
						 leave-active-class="animated rollOut">
		<div class="modal is-active" >
	  <div class="modal-card border border border-secondary">
		<div class="modal-card-head text-center bg-dark">
		<div class="modal-card-title text-white">
			  <slot name="head"></slot>
		</div>
	<button class="delete" @click="$emit('close')"></button>
		</div>
		<div class="modal-card-body">
			 <slot name="body"></slot>
		</div>
		<div class="modal-card-foot" >
		  <slot name="foot"></slot>
		</div>
	  </div>
	</div>
	</transition>
		`
	})
	new Vue({
		el: '#pagos',
		data: 
		{
			url: 'http://localhost/ideapp/',
			cargando_pagos: true,
			pagos: [],
			emptyResult:false,
			addModal: false,
			editModal:false,
			pagoModal:false,
			newPago:{
				codigo_trabajador:'',
				nombres_apellidos_trabajador:'',
				sueldo_semanal_trabajador:'',
				horas_lunes:'',
				horas_martes:'',
				horas_miercoles:'',
				horas_jueves:'',
				horas_viernes:'',
				horas_sabado:'',
				sueldo_cobrar:''
			},
			formValidate:[],
			search: {text: ''},
			choosePago:{}

		},
		methods: 
		{
			recuperarPagos: function()
			{
				this.$http.get('recuperar_pagos').then(function(respuesta)
				{
					this.cargando_pagos = false;
					this.emptyResult = false;
					this.pagos = respuesta.body;
				}, 
				function()
				{
					//alert('No se han podido recuperar los estados.');
				});
			},
			selectPago(pago)
			{
				this.choosePago = pago; 
			},
			formData(obj)
			{
				var formData = new FormData();
				for (var key in obj) 
				{
					formData.append(key, obj[key]);
				} 
				return formData;
			},
			noResult()
			{
			},
			ClearAll()
			{
				this.newPago = {
					codigo_trabajador:'',
					nombres_apellidos_trabajador:'',
					sueldo_semanal_trabajador:'',
					horas_lunes:'',
					horas_martes:'',
					horas_miercoles:'',
					horas_jueves:'',
					horas_viernes:'',
					horas_sabado:'',
					sueldo_cobrar:''
				};
				this.formValidate = false;
				this.addModal = false;
				this.editModal = false;
				this.pagoModal = false;
				this.recuperarPagos();
			},
			realizarPago()
			{
				const Tx = require('ethereumjs-tx');
				var myContract = new web3.eth.Contract([this.choosePago.codigo_trabajador, this.choosePago.sueldo_cobrar], '0xde0B295669a9FD93d5F28D9Ec85E40f4cb697BAe', 
				{
					from: '0x1234567890123456789012345678901234567891', // default from address
					gasPrice: '20000000000' // default gas price in wei, 20 gwei in this case
				});
				
				this.ClearAll();
			}
		},
		created: function()
		{
			this.recuperarPagos();
		}
	});
}