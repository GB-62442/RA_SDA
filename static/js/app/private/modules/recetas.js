recetaDatos();
function recetaDatos(){
	$.ajax({
		"url"     : base_url() + "Recetas/getAll",
		"type"    : "post",
		"dataType"     : "json",
		"success"      : function( json ) {
			var datos = json.respuesta;
			var id_receta = datos[0].idReceta;
			var nombre_receta = datos[0].nombre;
			var precio_venta = datos[0].precioVenta;
			var presentacion_unidad = datos[0].presentacion;
			var insumo_usados = 0;
			var presentacion_cantidad = 0;
			var punto_venta = datos[0].idPuntoVenta;

			document.getElementById('agregar_receta').innerHTML = `
			<a href="http://localhost/inventario/controlador/detallereceta?punto_venta=${punto_venta}" class="form-control btn btn-primary btn-sm" type="button">AGREGAR <i class="fa-solid fa-chart-simple"></i></a>
			`;

			datos.map((dato,index)=>{
				if (nombre_receta == dato.nombre) {
					presentacion_cantidad = presentacion_cantidad + parseFloat(dato.cantidad);
					insumo_usados = insumo_usados + 1;
					if (datos.length - 1 == index) {
						pintarReceta();
					}
				}else{
					pintarReceta();
					id_receta = dato.idReceta;
					nombre_receta = dato.nombre;
			 		precio_venta = dato.precioVenta;
			 		presentacion_unidad = dato.presentacion;
					insumo_usados = 0;
			 		presentacion_cantidad = 0;
			 		presentacion_cantidad = presentacion_cantidad + parseFloat(dato.cantidad);
					insumo_usados = insumo_usados + 1;
				}

			});

			function pintarReceta(){
				document.getElementById('tabla-recetas').innerHTML += `
				<tr>
				 
					<th>${id_receta}</th>
				    <td>${nombre_receta}</td>
				    <td>${insumo_usados}</td>
				    <td>${presentacion_unidad} ${presentacion_cantidad}</td>
				    <td>${precio_venta}</td>
				    <td>  	
						<a href="http://localhost/inventario/controlador/detallereceta?punto_venta=1&id_receta=${id_receta}"><button type="button" class="btn btn-outline-dark btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></a>
						<button type="button" class="btn btn-outline-dark btn-sm"><i class="fa-solid fa-trash"></i></button>
				    </td>
				</tr> 
				`;
			}

		},
		error: function (ts) {
			console.log(ts.responseText);
			alert('Ocurrió un error, por favor vuelva a intentarlo');		
		}
	});
}

