jQuery(document).ready(function ($) {
	console.log('en -  f_mermaproducto.js');

	// cargar los datos del producto
	$(document).ready(function () {
		console.log('ready!');

 			if($('#id_registro').val() !== ''){
 			//Cargar datos
 		 	$.ajax({
				url: base_url() + 'producto/get',
				type: 'post',
				data: {id: $('#id_registro').val()},
 				cache: false,
				dataType: 'json',
				success: function (json) {
					if (json.resultado == 'true') {
						console.log(json);
						$('#nombre').val(json.respuesta.nombre).change();
					} else {
						alert('Ocurrió un error, por favor vuelva a intentarlo, ');
					}
				},
				error: function (ts) {
					console.log(ts.responseText);
					alert('Ocurrió un error, por favor vuelva a intentarlo');
					clear_form();
				},
			}); 
 		 }
/**/
	});

	/**/

	$(document).on('click', '.btn-add', function (event) {
		event.preventDefault();

		$.ajax({
			url: base_url() + 'mermaproducto/insert',
			type: 'post',
			data: { 
				idProducto: 	$('#id_registro').val(),
				cantidad: 		$('#cantidad').val(),
			},
			cache: false,
			dataType: 'json',
			success: function (json) {

				if (json.resultado == 'true') {
					alert(json.mensaje); 
					window.location = base_url() + 'controlador/productos';
				} else {
					alert(json.mensaje);
					console.log(json);
				}
			},
			error: function (ts) {
				console.log(ts.responseText);
				alert('Ocurrió un error, por favor vuelva a intentarlo');
			},
		});
	});

});

function clear_form() {
	$('#form-usuarios').trigger('reset');
	$('#id_usuario').val('').change();
}