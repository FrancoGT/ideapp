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
		el: '#obras_construccion',
		data: 
		{
			url: 'http://localhost/ideapp/',
			cargando_obras: true,
			proyecto_construccion: [],
			emptyResult: false, //indica si el contenido del array de los registros está vacío
			addModal: false,
			editModal:false,
			newProyecto_construccion:{
				nombre_proyecto:'',
				fecha_inicio:'',
				fecha_fin:'',
				estado_binario:'',
				estado_proyecto:''
			},
			formValidate:[],
			search: {text: ''},
			chooseProyecto_construccion:{}
		},
		methods: 
		{
			recuperarProyectoConstrucccion: function()
			{
				this.$http.get('recuperar_proyecto_construccion').then(function(respuesta)
				{
					this.cargando_obras = false;
					this.emptyResult = false;
					this.proyecto_construccion = respuesta.body;
				}, 
				function()
				{
					//alert('No se han podido recuperar los estados.');
				});
			},
			insertarProyecto_construccion()
			{
				this.$http.post('insertar_proyecto_construccion', this.newProyecto_construccion).then(function()
				{
					this.ClearAll();
				}, 
				function()
				{
					alert('No se ha podido crear el nuevo registro.');
				});
			},
			actualizarProyecto_construccion()
			{
				this.$http.post('actualizar_proyecto_construccion', this.chooseProyecto_construccion).then(function()
				{
					this.ClearAll();
				}, 
				function()
				{
					alert('No se ha podido actualizar el registro.');
				});
			},
			selectProyecto_construccion(proy_construccion)
			{
				this.chooseProyecto_construccion = proy_construccion; 
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
				this.newProyecto_construccion = {
					nombre_proyecto:'',
					fecha_inicio:'',
					fecha_fin:'',
					estado_binario:'',
					estado_proyecto:''
				};
				this.formValidate = false;
				this.addModal = false;
				this.editModal = false;
				this.recuperarProyectoConstrucccion();
			},
			//para un nuevo registro
			pickEstado(estado)
			{
				return this.newProyecto_construccion.estado_proyecto = estado;
			},
			//para actualizar un registro
			changeEstado(estado)
			{
				return this.chooseProyecto_construccion.estado_binario = estado;
			},
			refresh()
			{
				this.search.text ? this.searchProyecto_construccion() : this.recuperarProyectoConstrucccion(); //por precaución
		    }
		},
		created: function()
		{
			this.recuperarProyectoConstrucccion();
		}
	});
}