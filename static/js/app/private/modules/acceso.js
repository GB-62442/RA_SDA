jQuery(document).ready(function ($) {
	console.log('en -  acceso.js');

	/**/

	$(document).on('click', '.btn-login', function (event) {
		event.preventDefault();

		$.ajax({
			url: base_url() + 'acceso/login',
			type: 'post',
			async: false,
			data: { 
				email: 		$('#email').val(),
				password: 	$('#password').val(),
			},
			cache: false,
			dataType: 'json',
			success: function (json) {

				if (json.resultado == 'true') {


					//Agregar historial de sesión
					$.ajax({
						url: base_url() + 'usuario/insertsesion',
						type: 'post',
						async: false,
						data: { 
							idUsuario: 	json.usuario.idUsuario,
							resultado: 	1
						},
						cache: false,
						dataType: 'json',
						success: function (json2) {

							if (json2.resultado == 'true') {
								
							} else {
								alert(json2.mensaje);
							}
						},
						error: function (ts) {
							console.log(ts.responseText);
							alert('Ocurrió un error, por favor vuelva a intentarlo');
						},
					});


					//Rol 1 = admin
					if(json.usuario.rol == 1){
						window.location.href="http://localhost/inventario/controlador/usuarios";
					}
					else{
						window.location.href="http://localhost/inventario/controlador/puntosVenta";
					}
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

	$(document).on('click', '.btn-recovery', function (event) {
		event.preventDefault();

		$.ajax({
			url: base_url() + 'acceso/recovery',
			type: 'post',
			data: { 
				email: 		$('#email').val()
			},
			cache: false,
			dataType: 'json',
			success: function (json) {

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
