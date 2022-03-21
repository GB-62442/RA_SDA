 		<!-- table -->
				<table class="table table-hover table-sm table-bordered">
				  <thead class="table-dark">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">NOMBRE</th>
				      <th scope="col">ROL</th>
				      <th scope="col">ACCIONES</th>
				    </tr>
				  </thead>
				  <tbody id="tabla-datos">
				  	<?php 
				  	if(isset($res) && !is_null($res)){
					  	foreach ($res as $r) { ?>
					    <tr>
					      <th scope="row"><?php echo($r->idUsuario) ?></th>
					      <td><?php echo($r->nombre) ?></td>
					      <td><?php echo($r->rol) ?></td>
					      <td>
					      	
							<a href="<?=base_url('/controlador/detalleusuario?id=')?><?php echo($r->idUsuario) ?>" type="button" class="btn btn-outline-dark btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
							<button type="button" class="btn btn-outline-dark btn-sm btn-delete" data-info="<?php echo($r->idUsuario) ?>"><i class="fa-solid fa-trash"></i></button>
							<a href="<?=base_url('/controlador/historialsesiones?id=')?><?php echo($r->idUsuario) ?>" type="button" class="btn btn-outline-dark btn-sm" data-info="<?php echo($r->idUsuario) ?>" >Historial de sesiones</a>

					      </td>
					    </tr> 
					  	<?php
					  	}
				  	}

				  	?>

				  </tbody>
				</table>
 		<!-- ./table -->