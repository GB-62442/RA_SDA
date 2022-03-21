jQuery(document).ready(function ($) {
	console.log('en -  f_usuario.js');

	// cargar los proveedores
	$(document).ready(function () {
		console.log('ready!');

 			if($('#id_registro').val() !== ''){
 			//Cargar datos
 		 	$.ajax({
				url: base_url() + 'usuario/get',
				type: 'post',
				data: {id: $('#id_registro').val()},
 				cache: false,
				dataType: 'json',
				success: function (json) {
					if (json.resultado == 'true') {
 						$('#nombre').val(json.respuesta.nombre).change(); 				
						$('#select_rol').val(json.respuesta.rol).change();
					} else {
						alert(json.mensaje);
						console.log()
					}
				},
				error: function (ts) {
					console.log(ts.responseText);
					alert('Ocurrió un error, por favor vuelva a intentarlo, k');
 				},
			}); 
 		 }

/**/
	});

	/**/

	$(document).on('click', '.btn-add', function (event) {
		event.preventDefault();

		$.ajax({
			url: base_url() + 'usuario/insert',
			type: 'post',
			data: { 
				nombre: 		$('#nombre').val(),
				rol: 			$('#select_rol').val(),
				pass: 			$('#pwd').val(),
				pass_r: 		$('#pwd_r').val(),
			},
			cache: false,
			dataType: 'json',
			success: function (json) {

				if (json.resultado == 'true') {
					alert(json.mensaje); 
					window.location = base_url() + 'controlador/usuarios';
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

	$(document).on('click', '.btn-update', function (event) {
		event.preventDefault();

		$.ajax({
			url: base_url() + 'usuario/edit',
			type: 'post',
			data: { 
				idUsuario: 		$('#id_registro').val(),
				nombre: 		$('#nombre').val(),
				rol: 			$('#select_rol').val(),
				pass: 			$('#pwd').val(),
				pass_r: 		$('#pwd_r').val(),
			},
			cache: false,
			dataType: 'json',
			success: function (json) {


				if (json.resultado == 'true') {
					alert(json.mensaje); 
					window.location = base_url() + 'controlador/usuarios';
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

function unblock_btn_submit() {}
