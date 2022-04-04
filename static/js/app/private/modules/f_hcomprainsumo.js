jQuery(document).ready(function ($) {
	console.log("en -  f_hcomprainsumo.js");

	console.log("ready!");

	if ($("#id_registro").val() !== "") {
		//Cargar datos
		$.ajax({
			url: base_url() + "insumo/get",
			type: "post",
			data: { id: $("#id_registro").val() },
			cache: false,
			dataType: "json",
			success: function (json) {
				if (json.resultado == "true") {
					console.log(json);
					$("#nombre").val(json.respuesta.nombre).change();
				} else {
					alert(json.respuesta);
				}
			},
			error: function (ts) {
				console.log(ts.responseText);
				alert("Ocurrió un error, por favor vuelva a intentarlo, k");
				clear_form();
			},
		});

		$("#tabla-compra").load(
			base_url() + "comprainsumo/tabla?id=" + $("#id_registro").val()
		);
		/*			console.log(base_url() + 'mermaproducto/tabla?id=' + $('#id_registro').val());*/
	}

	$(document).on("click", ".btn-search", function (event) {
		event.preventDefault();

		$("#tabla-compra").load(
			base_url() +
				"comprainsumo/tabla?id=" +
				$("#id_registro").val() +
				"&inicio=" +
				$("#inicio").val() +
				"&fin=" +
				$("#final").val()
		);
	});

	$(document).on("click", ".btn-export", function (event) {
		event.preventDefault();
		window.open(
			base_url() +
				"comprainsumo/exportCSV?id=" +
				$("#id_registro").val() +
				"&inicio=" +
				$("#inicio").val() +
				"&fin=" +
				$("#final").val()
		);
	});
});

function clear_form() {
	$("#form-usuarios").trigger("reset");
	$("#id_usuario").val("").change();
}
