 
<div class="container-fluid mt-4 pt-2 col-12">

	<div class="page-header" id="banner">

		<h1>Detalle usuario</h1>
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
			<div class="card p-2">
				<div class="row">
					<div class="col-12">

						<?php if(isset($editable) && $editable != false){ ?>
					    <div class="form-group">
					      <label for="id_registro" class="form-label mt-4">ID</label>
					      <input type="text" class="form-control" id="id_registro" aria-describedby="emailHelp" placeholder="ID del usuario" value="<?php if(isset($id)) echo($id); ?>" readonly>
						</div>

						<?php }else{ ?>

						    <div class="form-group">
 						      <input type="hidden" class="form-control" id="id_registro" aria-describedby="emailHelp" placeholder="ID del usuario" value="<?php if(isset($id)) echo($id); ?>" readonly>
							</div>
						<?php } ?>
						    <div class="form-group">
						      <label for="nombre" class="form-label mt-4">Nombre</label>
						      <input type="text" class="form-control" id="nombre" aria-describedby="emailHelp" placeholder="Nombre del usuario">
								<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->					    
							</div>


						    <div class="form-group">
						      <label for="email" class="form-label mt-4">Correo</label>
						      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Correo del usuario">
								<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->					    
							</div>

						    <div class="form-group">
						      <label for="pwd" class="form-label mt-4">Contrasena</label>
						      <input type="password" minlength="8" class="form-control" id="pwd" aria-describedby="emailHelp" placeholder="Contrasena">
								<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->					    
							</div>

						    <div class="form-group">
						      <label for="pwd_r" class="form-label mt-4">Repetir contrasena</label>
						      <input type="password" class="form-control" id="pwd_r" aria-describedby="emailHelp" placeholder="Repetir contrasena">
								<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->					    
							</div>

						    <div class="form-group">
						      <label for="select_unidad" class="form-label mt-4">Rol</label>
						      <select class="form-select" id="select_rol">
						      	<option>Selecciona una opcion</option>
						        <option value="1">Rol 1</option>
						        <option value="2">Rol 2</option>
						      </select>
						    </div>					



					</div>
					<div class="row m-4"></div>


					<div class="col">
					</div>
					<div class="col">
						<?php if(isset($editable) && $editable != false){ ?>
							<button class="form-control btn btn-outline-primary btn-sm btn-update" type="button">GUARDAR <i class="fa-solid fa-floppy-disk"></i></button>
						<?php }else{ ?>
							<button class="form-control btn btn-outline-primary btn-sm btn-add" type="button">GUARDAR <i class="fa-solid fa-floppy-disk"></i></button>
						<?php } ?>
						<div class="row mt-2"></div>
						<!-- <button class="form-control btn btn-outline-primary btn-sm" type="button">EXPORTAR A EXCEL <i class="fa-solid fa-file-export"></i></button> -->
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="row m-3"></div>

<!-- 	<div class="d-flex justify-content-around m-2">
		<a href="http://localhost/inventario/">Login</a>
		<a href="http://localhost/inventario/controlador/puntosVenta">Puntos de venta</a>
		<a href="http://localhost/inventario/controlador/insumos">Insumos</a>
		<a href="http://localhost/inventario/controlador/recetas">Recetas</a>
		<a href="http://localhost/inventario/controlador/productos">productos</a>
		<a href="http://localhost/inventario/controlador/reportes">Reportes</a>
	</div> -->
 


</div>