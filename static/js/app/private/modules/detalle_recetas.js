function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
var punto_venta = getParameterByName('punto_venta');
var id_receta = getParameterByName('id_receta');

if (isNaN(parseFloat(id_receta))) {
	console.log('hola desde registrar receta');
	
}