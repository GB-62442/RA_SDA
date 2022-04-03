 		<!-- table -->
 
 				  	<?php 
				  	if(isset($res) && !is_null($res)){
					  	foreach ($res as $r) { ?>
					    <tr>
 					      <td><?php echo($r->nombre) ?></td>
					      <td><?php echo($r->rol) ?></td>
					      <td><?php echo $r->resultado ? 'Exitoso' : 'Fallido'; ?></td>
					      <td><?php echo($r->fecha) ?></td>
					    </tr> 
					  	<?php
					  	}
				  	}

				  	?>

  
 		<!-- ./table -->