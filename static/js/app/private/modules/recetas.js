recetaDatos();
function recetaDatos(){
	$.ajax({
		"url"     : base_url() + "Recetas/getAll",
		"type"    : "post",
		"dataType"     : "json",
		"success"      : function( json ) {
			console.log(json.respuesta);
			
		},
		error: function (ts) {
			console.log(ts.responseText);
			alert('Ocurrió un error, por favor vuelva a intentarlo');
					
		}
	});
}
//hola perros jajaj saludos
