window.onload = function () 
{
	new Vue({
		el: '#presupuestos',
		data: 
		{
			url: 'http://localhost/ideapp/',
			cargando_presupuestos: true,
			presupuestos: [],
			emptyResult:false
		},
		methods: 
		{
			recuperarPresupuestos: function()
			{
				this.$http.get('recuperar_presupuestos').then(function(respuesta)
				{
					this.cargando_presupuestos = false;
					this.emptyResult = false;
					this.presupuestos = respuesta.body;
				}, 
				function()
				{
					//alert('No se han podido recuperar los estados.');
				});
			},
		},
		created: function()
		{
			this.recuperarPresupuestos();
		}
	});
}