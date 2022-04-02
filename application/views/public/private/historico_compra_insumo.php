 
<div class="container-fluid mt-4 pt-2 col-12">

	<div class="page-header" id="banner">

		<h1>Historial compra insumo</h1>
	</div>
	

	<div class="pt-2">
		<div class="row m-2">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item active" aria-current="page" onclick="window.history.back();"><i class="fa-solid fa-angle-left"></i> Volver atras</li>
				</ol>
			</nav>
		</div>
		<div class="row m-2">
			<div class="row">
				<div class="col-4">
					<div class="input-group">
						<!--<input type="text" class="form-control form-control-sm">
						 <div class="input-group-prepend">
							<button class="btn btn-outline-primary btn-sm" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
						</div> -->
						
					</div>
				</div>
				<div class="col">
					<!-- <button class="form-control btn btn-primary btn-sm" type="button">CREAR PRODUCTO <i class="fa-solid fa-plus"></i></button> -->
				</div>
				<div class="col">
<!-- 					<button class="form-control btn btn-primary btn-sm" type="button">HISTORIAL <i class="fa-solid fa-chart-simple"></i></button>
 -->				</div>
				<div class="col">
					<div class="row mt-2"></div>
					<!-- <button class="form-control btn btn-outline-primary btn-sm" type="button">EXPORTAR A EXCEL <i class="fa-solid fa-file-export"></i></button> -->
				</div>
			</div>
		</div>



		<?php if(isset($editable) && $editable != false){ ?>
			<div class="row m-2">
				<div class="form-group col-md-2">
					<label for="id_registro" class="form-label mt-4">ID</label>
					<input type="text" class="form-control" id="id_registro" aria-describedby="emailHelp" placeholder="ID del insumo" value="<?php if(isset($id)) echo($id); ?>" readonly>
				</div>

				<div class="form-group col-md-10">
					<label for="nombre" class="form-label mt-4">Nombre</label>
					<input type="text" class="form-control" id="nombre" aria-describedby="emailHelp" placeholder="Nombre del insumo" readonly>
							<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->					    
				</div>
			</div>

			<div class="row m-2">
				<div class="table-responsive">
					<div id="tabla-compra"></div>			
	 			</div>
			</div>
		<?php }else{ ?>

			<h4>No se encontraron registros</h4>
		<?php } ?>


		</div>

<!-- 	<div class="d-flex justify-content-around m-2">
		<a href="http://localhost/inventario/">Login</a>
		<a href="http://localhost/inventario/controlador/puntosVenta">Puntos de venta</a>
		<a href="http://localhost/inventario/controlador/insumos">Insumos</a>
		<a href="http://localhost/inventario/controlador/recetas">Recetas</a>
		<a href="http://localhost/inventario/controlador/productos">productos</a>
		<a href="http://localhost/inventario/controlador/reportes">Reportes</a>
	</div> -->
	

</div>
