var v = new Vue({
	el: '#modulo_proyecto_construccion',
	data: 
	{
		url: 'http://localhost/ideapp/',
		cargando_proyecto_construccion: true,
		proyecto_construccion_nuevo: 
		{
			nombre: '',
			fecha_inicio: '',
			fecha_fin: '',
			estado: ''
		},
		proyecto_construccion: []
	},
  methods: 
  {
	recuperarProyecto_construccion: function()
	{
		this.$http.get('recuperar_proyecto_construccion').then(function(respuesta)
		{
			this.cargando_proyecto_construccion = false;
			this.proyecto_construccion = respuesta.body;
		}, 
		function()
		{
			//alert('No se han podido recuperar los estados.');
		});
	},
    agregarProyecto_construccion: function()
    {
			this.$http.post('agregar_proyecto_construccion', this.proyecto_construccion_nuevo).then(function()
			{
				this.proyecto_construccion_nuevo.titulo = '';
				this.proyecto_construccion_nuevo.descripcion = '';
				this.recuperarproyecto_construccion();
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
	nombreEstado: function(dato)
	{
		var nombre;
		switch(dato)
		{
			case '0':
				this.estado = 'Inactivo';
				break;
			case '1':
				this.estado = 'Activo';
				break;
		}
	},
  	created: function()
  	{
		this.recuperarProyecto_construccion();
	}
});