jQuery(document).ready(function ($) {
	console.log('en -  acceso.js');

	/**/

	$(document).on('click', '.btn-login', function (event) {
		event.preventDefault();

		$.ajax({
			url: base_url() + 'acceso/login',
			type: 'post',
			data: { 
				email: 		$('#email').val(),
				password: 	$('#password').val(),
			},
			cache: false,
			dataType: 'json',
			success: function (json) {
 				console.log(json.message);
				console.log(json.data);

				if (json.resultado == 'true') {
					alert(json.mensaje);
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

	$(document).on('click', '.btn-update', function (event) {
		event.preventDefault();

		$.ajax({
			url: base_url() + 'insumo/edit',
			type: 'post',
			data: { 
				idInsumo: 	$('#id_registro').val(),
				nombre: 		$('#nombre').val(),
				unidadMedida: 	$('#select_unidad').val(),
				idProveedor: 	$('#select_prov').val(),
			},
			cache: false,
			dataType: 'json',
			success: function (json) {
console.log(json);
				if (json.resultado == 'true') {
					alert('Registro completo');
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
