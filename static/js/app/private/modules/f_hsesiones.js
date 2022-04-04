jQuery(document).ready(function ($) {
	console.log('en -  f_hsesion.js');

 
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
						console.log(json);
						$('#nombre').val(json.respuesta.nombre).change();
					} else {
						alert(json.respuesta);
					}
				},
				error: function (ts) {
					console.log(ts.responseText);
					alert('Ocurrió un error, por favor vuelva a intentarlo, k');
					clear_form();
				},
			});  


 		 }
	$(document).on('click', '.btn-search', function (event) {
		event.preventDefault();
		 $('#tabla-datos').load(base_url() + 'usuario/tablasesiones?id=' 
		 	+ $('#id_registro').val() 
		 	+ '&inicio='+ $('#inicio').val() 
		 	+ '&fin=' +$('#final').val());

	});



});

function clear_form() {
	$('#form-usuarios').trigger('reset');
	$('#id_usuario').val('').change();
}

