<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">Alle Bestillinger</h1>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped text-center black">
						<thead>
							<tr>
								<th>Bestilling no:</th>
								<th>Bestilling Uddanelse</th>
								<th>Eksamen Dato</th>
								<th>Ugenummer</th>
								<th>Bygning</th>
								<th>Mødested</th>
								<th>Eksamen start</th>
								<th>Eksamen slut</th>
								<th>Fag</th>
								<th>Kontaktperson</th>
								<th>Eksamen form</th>
								<th>Antal</th>
								<th>Delete</th>
								<th>Edit</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								$get_orders="select * from bestillinger";
								$run_orders=mysqli_query($con,$get_orders);
								while ($row_orders=mysqli_fetch_array($run_orders)) {
									$eksamen_id=$row_orders['eksamen_id'];
									$eksamen_uddanelse=$row_orders['eksamen_uddanelse'];
									$eksamen_dato=$row_orders['eksamen_dato'];
									$eksamen_uge=$row_orders['eksamen_uge'];
									$eksamen_bygning=$row_orders['eksamen_bygning'];
									$eksamen_sted=$row_orders['eksamen_sted'];
									$eksamen_start=$row_orders['eksamen_start'];
									$eksamen_slut=$row_orders['eksamen_slut'];
									$eksamen_fag=$row_orders['eksamen_fag'];
									$eksamen_kontakt=$row_orders['eksamen_kontakt'];
									$eksamen_form=$row_orders['eksamen_form'];
									$eksamen_antal=$row_orders['eksamen_antal'];
									$i++;
							 ?>
							 <tr>
							 	<td><?php echo $i; ?></td>
							 	<td><?php echo $eksamen_uddanelse; ?></td>
							 	<td><?php echo $eksamen_dato; ?></td>
							 	<td><?php echo $eksamen_uge; ?></td>
							 	<td><?php echo $eksamen_bygning; ?></td>
							 	<td><?php echo $eksamen_sted; ?></td>
							 	<td><?php echo $eksamen_start; ?></td>
							 	<td><?php echo $eksamen_slut; ?></td>
							 	<td><?php echo $eksamen_fag; ?></td>
							 	<td><?php echo $eksamen_kontakt; ?></td>
							 	<td><?php echo $eksamen_form; ?></td>
							 	<td><?php echo $eksamen_antal; ?></td>
							 	<td><a href="index.php?delete_bestilling=<?php echo $eksamen_id; ?>">
							 		<i class="far fa-trash-alt"></i> Delete
							 	</a></td>
							 	<td><a href="index.php?edit_bestilling=<?php echo $eksamen_id; ?>">
							 		<i class="far fa-edit"></i> Edit
							 	</a></td>
							 </tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>