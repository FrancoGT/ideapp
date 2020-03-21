var v = new Vue({
	el: '#modulo_trabajadores',
	data: 
	{
		url: 'http://localhost/ideapp/',
		cargando_trabajadores: true,
		trabajador_nuevo: 
		{
			nombres: '',
			apellidos: '',
			sueldo_semanal: ''
		},
		obreros: []
	},
  methods: 
  {
	recuperarObreros: function()
	{
		this.$http.get('recuperar_obreros').then(function(respuesta)
		{
			this.cargando_trabajadores = false;
			this.obreros = respuesta.body;
		}, 
		function()
		{
			//alert('No se han podido recuperar los estados.');
		});
	},
  	created: function()
  	{
		this.recuperarObreros();
		
	}
  }
});
