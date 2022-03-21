jQuery(document).ready(function ($) {
	console.log('en -  f_mermaproducto.js');

	// cargar los proveedores
	$(document).ready(function () {
		console.log('ready!');

 			$.ajax({
				url: base_url() + 'ptventa/getall',
				type: 'post',
 				cache: false,
				dataType: 'json',
				success: function (json) {
					if (json.resultado == 'true') {
						$.each( json.respuesta, function( k, v ) {
            				$('#select_pv').append(`<option value="${v.	idPuntoVenta}">
                            	${v.nombre}
                            </option>`);

						});
					} else {
						alert('Ocurrió un error, por favor vuelva a intentarlo, primero ingrese puntos de venta');
					}
				},
				error: function (ts) {
					console.log(ts.responseText);
					alert('Ocurrió un error, por favor vuelva a intentarlo');
					
				},
			}); 		

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
						alert('Ocurrió un error, por favor vuelva a intentarlo,45');
					}
				},
				error: function (ts) {
					console.log(ts.responseText);
					alert('Ocurrió un error, por favor vuelva a intentarlo, k');
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
			url: base_url() + 'compraproducto/insert',
			type: 'post',
			data: { 
				idProducto: 	$('#id_registro').val(),
				cantidad: 		$('#cantidad').val(),
				idPuntoVenta: 	$('#select_pv').val(),
				precio: 		$('#precio').val(),
			},
			cache: false,
			dataType: 'json',
			success: function (json) {

				if (json.resultado == 'true') {
					alert(json.mensaje); 
					window.location = base_url() + 'controlador/productos';
				} else {
					alert(json.mensaje);
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

function unblock_btn_submit() {}
