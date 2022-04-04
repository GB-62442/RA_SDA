jQuery(document).ready(function ($) {
	console.log('en -  f_hmermaproducto.js');
 
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
						alert(json.respuesta);
					}
				},
				error: function (ts) {
					console.log(ts.responseText);
					alert('Ocurrió un error, por favor vuelva a intentarlo, k');
					clear_form();
				},
			}); 

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
						alert(json.respuesta);
					}
				},
				error: function (ts) {
					console.log(ts.responseText);
					alert('Ocurrió un error, por favor vuelva a intentarlo');
					clear_form();
				},
			}); 

			$('#tabla-datos').load(base_url() + 'mermaproducto/tabla?id=' + $('#id_registro').val());
/*			console.log(base_url() + 'mermaproducto/tabla?id=' + $('#id_registro').val());*/
 		 }


	$(document).on('click', '.btn-search', function (event) {
		event.preventDefault();
/*  
 alert(base_url() + 'mermaproducto/tabla?id=' 
 	+ $('#id_registro').val() 
 	+ '&inicio='+ $('#inicio').val() 
 	+ '&fin=' +$('#final').val());
*/

 $('#tabla-datos').load(base_url() + 'mermaproducto/tabla?id=' 
 	+ $('#id_registro').val() 
 	+ '&inicio='+ $('#inicio').val() 
 	+ '&fin=' +$('#final').val());

	});


	$(document).on('click', '.btn-export', function (event) {
		event.preventDefault();
		window.open(base_url() + 'mermaproducto/exportCSV?id=' 
 	+ $('#id_registro').val() 
 	+ '&inicio='+ $('#inicio').val() 
 	+ '&fin=' +$('#final').val());
/*  
 
 $('#tabla-datos').load(base_url() + 'mermaproducto/tabla?id=' 
 	+ $('#id_registro').val() 
 	+ '&inicio='+ $('#inicio').val() 
 	+ '&fin=' +$('#final').val());*/

	});

});

function clear_form() {
	$('#form-usuarios').trigger('reset');
	$('#id_usuario').val('').change();
}

