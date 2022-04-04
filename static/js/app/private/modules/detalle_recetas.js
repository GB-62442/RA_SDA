function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

//  VARIABLES GLOBALES
var punto_venta = getParameterByName('punto_venta');
var id_receta = getParameterByName('id_receta');
var arreglo_insumo_pintar=[];
var arreglo_cantidad_pintar = [];
var insumosFormatos = 0;
var opcion;

//comprobamos si vamos a editar o registrar datos
if (isNaN(parseFloat(id_receta))) {
	console.log('hola desde registrar receta');
    insumosFormatos = 1;


    pintarInsumos(insumosFormatos);
    opcion = 0;

}else{

    obtenerReceta();
    
    opcion = 1;

    

}

function agregarIngrediente(){
    arreglo_insumo_pintar=[];
    arreglo_cantidad_pintar = [];
    for (var i = 1; i <= insumosFormatos; i++) {
        var id_insumo_pintar = `select_insumo${i}`;
        var id_cantidad_pintar = `cantidad_insumo${i}`;
        var x = parseInt(document.getElementById(id_insumo_pintar).value);
        var y = parseFloat(document.getElementById(id_cantidad_pintar).value);

        arreglo_insumo_pintar.push(x);
        arreglo_cantidad_pintar.push(y);    
    }

    insumosFormatos ++;
    pintarInsumos(insumosFormatos);

}

function eliminarIngrediente(){
    if(insumosFormatos <= 1){
    }else{
        insumosFormatos --;
        pintarInsumos(insumosFormatos);
    }
}

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
                    <input type="number" step="0.1" class="form-control" value="${arreglo_cantidad_pintar[i - 1]}" id="cantidad_insumo${i}" aria-describedby="emailHelp" placeholder="Cantidad">
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


function obtenerInsumos(insumosFormatos){

    $.ajax({
        "url"     : base_url() + "Recetas/getInsumos",
        "type"    : "post",
        "dataType"     : "json",
        "success"      : function( json ) {
            var datos = json.respuesta;
            dibujarSelectReceta();
            function dibujarSelectReceta(){
                for (var i = 1; i <= insumosFormatos; i++) {
                    var id_select_insumo = "select_insumo"+i;
                    datos.map((dato,index)=>{
                        if(dato.idInsumo == arreglo_insumo_pintar[i - 1]){
                            document.getElementById(id_select_insumo).innerHTML += `<option selected value="${dato.idInsumo}">${dato.nombre} ${dato.unidadMedida}</option>`;
                        }else{
                            document.getElementById(id_select_insumo).innerHTML += `<option value="${dato.idInsumo}">${dato.nombre} ${dato.unidadMedida}</option>`;
                        }
                    });
                }
            }
        },
        error: function (ts) {
            console.log(ts.responseText);
            alert('Ocurrió un error, por favor vuelva a intentarlo');       
        }
    });
}

function obtenerReceta(){
    $.ajax({
        "url"     : base_url() + "Recetas/obtenerReceta",
        "type"    : "post",
        "data": { 
            id_receta: id_receta,
            },
        "dataType"     : "json",
        "success"      : function( json ) {
            var datos = json.respuesta;
            insumosFormatos = datos.length;

            document.getElementById('nombre_receta').value = datos[0].nombre;
            document.getElementById('select_presentacion').value = datos[0].presentacion;
            document.getElementById('precio_venta').value = datos[0].precioVenta;

            arreglo_insumo_pintar=[];
            arreglo_cantidad_pintar = [];
            for (var i = 1; i <= datos.length; i++) {
                var id_insumo_pintar = `select_insumo${i}`;
                var id_cantidad_pintar = `cantidad_insumo${i}`;
                var x = parseInt(datos[i - 1].idInsumo);
                var y = parseFloat(datos[i - 1].cantidad);
        
                arreglo_insumo_pintar.push(x);
                arreglo_cantidad_pintar.push(y);    
                }
                pintarInsumos(insumosFormatos);


        },
        error: function (ts) {
            console.log(ts.responseText);
            alert('Ocurrió un error, por favor vuelva a intentarlo');       
        }
    });
}

function actualizarRegistrarReceta(){

    var url = "";

    var nombre_receta = document.getElementById('nombre_receta').value;
    var precio_venta = parseFloat(document.getElementById('precio_venta').value);

    //console.log( parseFloat(document.getElementById('precio_venta').value));
    //console.log(insumosFormatos);
    var arreglo_insumo = [];
    var arreglo_cantidad_insumo = [];
    for (var i = 1; i <= insumosFormatos; i++) {
        let id_select_insumo_arreglo = `select_insumo${i}`;
        let id_cantidad_insumo = `cantidad_insumo${i}`;

        arreglo_insumo.push( parseInt(document.getElementById(id_select_insumo_arreglo).value));
        arreglo_cantidad_insumo.push( parseFloat(document.getElementById(id_cantidad_insumo).value));
            
        console.log(nombre_receta );
        console.log(precio_venta);
        console.log(document.getElementById('select_presentacion').value);
        console.log(arreglo_insumo);
        console.log(arreglo_cantidad_insumo);
            
    }

    if(opcion == 0){
        url = "Recetas/insertReceta";
        console.log("DAtos ingresados");
    }else{
        url = "Recetas/actualizarReceta";
        console.log("Datos actualziados");
    }
        
    $.ajax({
            "url"     : base_url() + url,
            "type"    : "post",
            "data": { 
                id_receta :     id_receta,
                nombre:         nombre_receta ,
                precio_venta:   precio_venta,
                arreglo_insumo: arreglo_insumo,
                arreglo_cantidad: arreglo_cantidad_insumo,
                presentacion: document.getElementById('select_presentacion').value,
                },
            "dataType"     : "json",
            "success"      : function( json ) {
            alert('Registro exitoso jaja saludos');
        },
        error: function (ts) {
            console.log(ts.responseText);
            alert('mm que interesante');       
        }
    });
    
}
