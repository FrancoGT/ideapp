var v = new Vue({
	el: '#modulo_materiales',
	data: 
	{
		url: 'http://localhost/ideapp/',
		cargando_materiales: true,
		material_nuevo: 
		{
			nombre: '',
			unidad: '',
			estado: ''
		},
		materiales: []
	},
  methods: 
  {
	recuperarMateriales: function()
	{
		this.$http.get('recuperar_materiales').then(function(respuesta)
		{
			this.cargando_materiales = false;
			this.materiales = respuesta.body;
		}, 
		function()
		{
			//alert('No se han podido recuperar los estados.');
		});
	},
    agregarMaterial: function()
    {
			this.$http.post('agregar_proyecto_construccion', this.proyecto_construccion_nuevo).then(function()
			{
				this.material_nuevo.titulo = '';
				this.material.descripcion = '';
				this.recuperarMateriales();
      }, 
      function()
      {
				alert('No se ha podido agregar.');
			});
		},
    modificarProyecto_construccion: function(p_proyecto_construccion)
    {
			this.$http.post('modificar_proyecto_construccion', p_proyecto_construccion).then(function(){
				this.recuperarproyecto_construccion();
      }, 
      function()
      {
				alert('No se ha podido modificar el registro.');
			});
		},
	},
  	created: function()
  	{
		this.recuperarMateriales();
	}
});