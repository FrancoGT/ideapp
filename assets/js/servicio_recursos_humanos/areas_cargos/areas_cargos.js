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
		el: '#areas_cargos',
		data: 
		{
			url: 'http://localhost/ideapp/',
			cargando_areas_cargos: true,
			areas_cargos: [],
			emptyResult: false, //indica si el contenido del array de los registros está vacío
			addModal: false,
			editModal:false,
			newArea_cargo:{
				cod_area_cargo:'',
				area:'',
				cargo:'',
				estado_binario:'',
				estado_area_cargo:''
			},
			formValidate:[],
			search: {text: ''},
			chooseArea_cargo:{}
		},
		methods: 
		{
			recuperarAreas_cargos: function()
			{
				this.$http.get('recuperar_areas_cargos').then(function(respuesta)
				{
					this.cargando_areas_cargos = false;
					this.emptyResult = false;
					this.areas_cargos = respuesta.body;
				}, 
				function()
				{
					//alert('No se han podido recuperar los estados.'); Gri GG
				});
			},
			insertarArea_cargo()
			{
				this.$http.post('insertar_area_cargo', this.newArea_cargo).then(function()
				{
					this.ClearAll();
				}, 
				function()
				{
					alert('No se ha podido crear el nuevo registro.');
				});
			},
			actualizarArea_cargo()
			{
				this.$http.post('actualizar_area_cargo', this.chooseArea_cargo).then(function()
				{
					this.ClearAll();
				}, 
				function()
				{
					alert('No se ha podido actualizar el registro.');
				});
			},
			selectArea_cargo(area_cargo)
			{
				this.chooseArea_cargo = area_cargo; 
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
				this.newArea_cargo = {
					cod_area_cargo:'',
					area:'',
					cargo:'',
					estado_binario:'',
					estado_area_cargo:''
				};
				this.formValidate = false;
				this.addModal = false;
				this.editModal = false;
				this.recuperarAreas_cargos();
			},
			//para un nuevo registro
			pickEstado(estado)
			{
				return this.newArea_cargo.estado_area_cargo = estado;
			},
			//para actualizar un registro
			changeEstado(estado)
			{
				return this.chooseArea_cargo.estado_binario = estado;
			},
			refresh()
			{
				this.search.text ? this.searchArea_cargo() : this.recuperarAreas_cargos(); //por precaución
		    }
		},
		created: function()
		{
			this.recuperarAreas_cargos();
		}
	});
}