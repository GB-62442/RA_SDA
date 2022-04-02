 		<!-- table -->
				<table class="table table-hover table-sm table-bordered">
				  <thead class="table-dark">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">NOMBRE</th>
				      <th scope="col">PROVEEDOR</th>
				      <th scope="col">CANTIDAD</th>
				      <th scope="col">FECHA</th>
				    </tr>
				  </thead>
				  <tbody id="tabla-datosinsu">
				  	<?php 
				  	if(isset($res) && !is_null($res)){
					  	foreach ($res as $r) { ?>
					    <tr>
					      <th scope="row"><?php echo($r->idInsumo) ?></th>
					      <td><?php echo($r->nombreinsumo) ?></td>
					      <td><?php echo($r->nombreproveedor) ?></td> 
					      <td><?php echo($r->cantidad) ?></td> 
					      <td><?php echo($r->fecha) ?></td> 
					    </tr> 
					  	<?php
					  	}
				  	}

				  	?>

				  </tbody>
				</table>
 		<!-- ./table -->
