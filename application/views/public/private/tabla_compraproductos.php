 		<!-- table -->
				<table class="table table-hover table-sm table-bordered">
				  <thead class="table-dark">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">NOMBRE</th>
				      <th scope="col">UNIDAD DE MEDIDA</th>
				      <th scope="col">PROVEEDOR</th>
				      <th scope="col">PRECIO DE VENTA</th>
				      <th scope="col">COSTO DE COMPRA</th>
				      <th scope="col">CANTIDAD</th>
				      <th scope="col">FECHA</th>
				    </tr>
				  </thead>
				  <tbody id="tabla-datos">
				  	<?php 
				  	if(isset($res) && !is_null($res)){
					  	foreach ($res as $r) { ?>
					    <tr>
					      <th scope="row"><?php echo($r->idProducto) ?></th>
					      <td><?php echo($r->nombreproducto) ?></td>
					      <td><?php echo($r->unidadMedida) ?></td>
					      <td><?php echo($r->nombreproveedor) ?></td> 
					      <td><?php echo('$'.number_format($r->precioVenta,2)) ?></td>
					      <td><?php echo('$'.number_format($r->costo,2)) ?></td>
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
 