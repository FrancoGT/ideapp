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
		el: '#trabajadores',
		data: 
		{
			url: 'http://localhost/ideapp/',
			cargando_trabajadores: true,
			areas_cargos: [], //para el select del modal
			trabajadores: [],
			emptyResult:false,
			addModal: false,
			editModal:false,
			newTrabajador:{
				cod_trabajador:'',
				nombres:'',
				apellidos:'',
				area_cargo:'',
				estado_binario:'',
				estado_trabajador:''
			},
			formValidate:[],
			search: {text: ''},
			chooseTrabajador:{}
		},
		methods: 
		{
			recuperarTrabajadores: function()
			{
				this.$http.get('recuperar_trabajadores').then(function(respuesta)
				{
					this.cargando_trabajadores = false;
					this.emptyResult = false;
					this.trabajadores = respuesta.body;
				}, 
				function()
				{
					//alert('No se han podido recuperar los estados.');
				});
			},
			insertarTrabajador()
			{
				this.$http.post('insertar_trabajador', this.newTrabajador).then(function()
				{
					this.ClearAll();
				}, 
				function()
				{
					alert('No se ha podido crear el nuevo registro.');
				});
			},
			actualizarTrabajador()
			{
				this.$http.post('actualizar_trabajador', this.chooseTrabajador).then(function()
				{
					this.ClearAll();
				}, 
				function()
				{
					alert('No se ha podido actualizar el registro.');
				});
			},
			selectTrabajador(trabajador)
			{
				this.chooseTrabajador = trabajador;
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
				this.newTrabajador = {
					cod_trabajador:'',
					nombres:'',
					apellidos:'',
					area_cargo:'',
					estado_binario:'',
					estado_trabajador:''
				};
				this.formValidate = false;
				this.addModal = false;
				this.editModal = false;
				this.recuperarTrabajadores();
			},
			//para un nuevo registro
			pickEstado(estado)
			{
				return this.newTrabajador.estado_trabajador = estado;
			},
			//para actualizar un registro
			changeEstado(estado)
			{
				return this.chooseTrabajador.estado_binario = estado;
			},

			refresh()
			{
				this.search.text ? this.searchTrabajador() : this.recuperarTrabajadores(); //por precaución
		    }
		},
		created: function()
		{
			this.recuperarTrabajadores();
		}
	});
}