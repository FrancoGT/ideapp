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
		<div class="modal-ca65rd-foot" >
		  <slot name="foot"></slot>
		</div>
	  </div>
	</div>
	</transition>
		`
	})
	new Vue({
		el: '#usuario',
		data: 
		{
			url: 'http://localhost/ideapp/',
			cargando_perfil: true,
			perfil: [],
			emptyResult: false, //indica si el contenido del array de los registros está vacío 767
			editModal:false,
			formValidate:[],
			choosePerfil:{}
		},
		methods: 
		{
			recuperarPerfil: function()
			{
				this.$http.get('recuperar_perfil').then(function(respuesta)
				{
					this.cargando_perfil = false;
					this.emptyResult = false;
					this.perfil = respuesta.body;
				}, 
				function()
				{
					
				});
			},
			actualizarPerfil()
			{
				this.$http.post('actualizar_perfil', this.choosePerfil).then(function()
				{
					this.clearAll();
				}, 
				function()
				{
					alert('No se ha podido actualizar el registro.');
				});
			},
			selectPerfil(perfil)
			{
				this.choosePerfil = perfil; 
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
			clearAll()
			{
				this.formValidate = false;
				this.editModal = false;
				this.recuperarPerfil();
			}
		},
		created: function()
		{
			this.recuperarPerfil();
		}
	});
}