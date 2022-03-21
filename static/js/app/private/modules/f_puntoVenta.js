jQuery(document).ready(function ($) {
	console.log('en -  f_ptventa.js');

	// cargar los ptventaes
	$(document).ready(function () {
		console.log('ready!'); 

 			$.ajax({
				url: base_url() + 'usuario/getall',
				type: 'post',
 				cache: false,
				dataType: 'json',
				success: function (json) {
					if (json.resultado == 'true') {
						$.each( json.respuesta, function( k, v ) {
            				$('#select_us').append(`<option value="${v.idUsuario}">
                            	${v.nombre}
                            </option>`);

						});
					} else {
						alert('Ocurrió un error, por favor vuelva a intentarlo, primero ingrese usuarios');
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
				url: base_url() + 'ptventa/get',
				type: 'post',
				data: {id: $('#id_registro').val()},
 				cache: false,
				dataType: 'json',
				success: function (json) {
					console.log(json);
					if (json.resultado == 'true') {
						$('#nombre').val(json.respuesta.nombre).change();
						$('#select_us').val(json.respuesta.idUsuario).change();	
					} else {
						alert('Ocurrió un error, por favor vuelva a intentarlo');
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
			url: base_url() + 'ptventa/insert',
			type: 'post',
			data: { 
				nombre: 		$('#nombre').val(),
				idUsuario: 		$('#select_us').val(),
			},
			cache: false,
			dataType: 'json',
			success: function (json) {
 				console.log(json.mensaje);

				if (json.resultado == 'true') {
					alert(json.mensaje); 
					window.location = base_url() + 'controlador/puntosVenta';					
				} else {
					alert('Ocurrió un error, por favor vuelva a intentarlo');
				}
			},
			error: function (ts) {
				console.log(ts.responseText);
				alert('Ocurrió un error, por favor vuelva a intentarlo');
			},
		});
	});

	$(document).on('click', '.btn-update', function (event) {
		event.preventDefault();

		$.ajax({
			url: base_url() + 'ptventa/edit',
			type: 'post',
			data: { 
				idPtVenta: 	$('#id_registro').val(),
				nombre: 		$('#nombre').val(),
				idUsuario: 		$('#select_us').val(),
			},
			cache: false,
			dataType: 'json',
			success: function (json) {
 				console.log(json.mensaje);
				console.log(json);

				if (json.resultado == 'true') {
					alert(json.mensaje); 
					window.location = base_url() + 'controlador/puntosVenta';
				} else {
					alert('Ocurrió un error, por favor vuelva a intentarlo');
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
