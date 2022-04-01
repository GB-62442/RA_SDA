function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
var punto_venta = getParameterByName('punto_venta');
var id_receta = getParameterByName('id_receta');

//comprobamos si vamos a editar o registrar datos
if (isNaN(parseFloat(id_receta))) {
	console.log('hola desde registrar receta');
    var insumosFormatos = 1;

    function agregarIngrediente(){
        insumosFormatos ++;
        pintarInsumos(insumosFormatos);
    }

    function eliminarIngrediente(){
        insumosFormatos --;
        pintarInsumos(insumosFormatos);
    }

    pintarInsumos(insumosFormatos);

    function pintarInsumos(insumosFormatos){
        document.getElementById('insumo_formato').innerHTML = '';
        for (var i = 1; i <= insumosFormatos; i++) {
            document.getElementById('insumo_formato').innerHTML += `
            <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                    <label for="exampleSelect2" class="form-label mt-4">Ingrediente</label>
                    <select class="form-select" id="select_insumo${i}">
                    </select>
                </div>

                <div class="row col-md-6 col-sm-12">
                    <div class="form-group col-md-8">
                        <label for="exampleInputEmail1" class="form-label mt-4">Cantidad</label>
                        <input type="number" step="0.1" class="form-control" value="0" id="cantidad_insumo${i}" aria-describedby="emailHelp" placeholder="Cantidad">
                    </div>  
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1" class="form-label mt-4">Eliminar ingrediente</label>
                        <button onclick="eliminarIngrediente()" class="form-control btn btn-dark btn-sm" type="button"><i class="fa-solid fa-xmark fa-2x"></i></button>
                    </div>  
                </div>
            </div>
        `;
        }
        obtenerInsumos(insumosFormatos);
    }

     function registrarReceta(){
        var nombre_receta = document.getElementById('nombre_receta').value;
        var precio_venta = parseFloat(document.getElementById('precio_venta').value);

        //console.log( parseFloat(document.getElementById('precio_venta').value));
        //console.log(insumosFormatos);
        var arreglo_insumo = [];
        var arreglo_precio_cantidad_insumo = [];
        for (var i = 1; i <= insumosFormatos; i++) {
            let id_select_insumo_arreglo = `select_insumo${i}`;
            let id_cantidad_insumo = `cantidad_insumo${i}`;

            arreglo_insumo.push( parseInt(document.getElementById(id_select_insumo_arreglo).value));
            arreglo_precio_cantidad_insumo.push( parseFloat(document.getElementById(id_cantidad_insumo).value));
            
            console.log(nombre_receta );
            console.log(precio_venta);
            console.log(document.getElementById('select_presentacion').value);
            console.log(arreglo_insumo);
            console.log(arreglo_precio_cantidad_insumo);
            
        }
        
        $.ajax({
                "url"     : base_url() + "Recetas/insertReceta",
                "type"    : "post",
                "data": { 
                    nombre:         nombre_receta ,
                    precio_venta:   precio_venta,
                    arreglo_insumo: arreglo_insumo,
                    arreglo_precio: arreglo_precio_cantidad_insumo,
                    presentacion: document.getElementById('select_presentacion').value,
                    },
                "dataType"     : "json",
                "success"      : function( json ) {
                alert('Registro exitoso jaja saludos');
            },
            error: function (ts) {
                console.log(ts.responseText);
                alert('Ocurrió un error, por favor vuelva a intentarlo');       
            }
        });

    }



}


function obtenerInsumos(insumosFormatos){
    $.ajax({
        "url"     : base_url() + "Recetas/getInsumos",
        "type"    : "post",
        "dataType"     : "json",
        "success"      : function( json ) {
            var datos = json.respuesta;
            //console.log(datos);
            dibujarSelectReceta();
            function dibujarSelectReceta(){
                for (var i = 1; i <= insumosFormatos; i++) {
                    var id_select_insumo = "select_insumo"+i;
                    datos.map((dato,index)=>{
                        document.getElementById(id_select_insumo).innerHTML += `<option value="${dato.idInsumo}">${dato.nombre} ${dato.unidadMedida}</option>`;
                    });
                }
            }
            return datos;
        },
        error: function (ts) {
            console.log(ts.responseText);
            alert('Ocurrió un error, por favor vuelva a intentarlo');       
        }
    });
}
