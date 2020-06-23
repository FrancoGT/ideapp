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
		el: '#materiales_obra',
		data: 
		{
			url: 'http://localhost/ideapp/',
			cargando_materiales: true,
			materiales: [],
			emptyResult: false, //indica si el contenido del array de los registros está vacío
			addModal: false,
			editModal:false,
			newMaterial: 
			{
				nombre_material: '',
				unidad: '',
				estado_material: '',
				estado_binario: ''
			},
			formValidate:[],
			search: {text: ''},
			chooseMaterial:{}
		},
		methods: 
		{
			recuperarMateriales: function()
			{
				this.$http.get('recuperar_materiales').then(function(respuesta)
				{
					this.cargando_materiales = false;
					this.emptyResult = false;
					this.materiales = respuesta.body;
				}, 
				function()
				{
					//alert('No se han podido recuperar los estados.');
				});
			},
			insertarMaterial()
			{
				this.$http.post('insertar_material', this.newMaterial).then(function()
				{
					this.ClearAll();
				},
				function()
				{
					alert('No se ha podido crear el nuevo registro.');
				});
			},
			actualizarMaterial()
			{
				this.$http.post('actualizar_material', this.chooseMaterial).then(function()
				{
					this.ClearAll();
				}, 
				function()
				{
					alert('No se ha podido actualizar el registro.');
				});
			},
			selectMaterial(material)
			{
				this.chooseMaterial = material; 
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
				this.newMaterial = {
					nombre_material:'',
					unidad:'',
					estado_material:'',
					estado_binario: ''
				};
				this.formValidate = false;
				this.addModal = false;
				this.editModal = false;
				this.recuperarMateriales();
			},
			//para un nuevo registro
			pickEstado(estado)
			{
				return this.newMaterial.estado_material = estado;
			},
			//para actualizar un registro
			changeEstado(estado)
			{
				return this.chooseMaterial.estado_binario = estado;
			},
			refresh()
			{
				this.search.text ? this.searchMaterial() : this.recuperarMateriales(); //por precaución
			}
			
		},
		created: function()
		{
			this.recuperarMateriales();
		}
	});
}