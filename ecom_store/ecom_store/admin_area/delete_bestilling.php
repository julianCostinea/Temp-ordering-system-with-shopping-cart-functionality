<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
   	if (isset($_GET['delete_bestilling'])) {
   		$delete_id=$_GET['delete_bestilling'];

   		$get_orders="select * from bestillinger where eksamen_id='$delete_id'";
			$run_orders=mysqli_query($con,$get_orders);
			$row_orders=mysqli_fetch_array($run_orders);
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
			$eksamen_dok=$row_orders['eksamen_dok'];
			$eksamen_notes=$row_orders['eksamen_notes'];

			$insert_bestilling="insert into finished_orders(eksamen_id,eksamen_uddanelse,eksamen_dato, eksamen_uge, eksamen_bygning,eksamen_sted, eksamen_start, eksamen_slut, eksamen_fag, eksamen_kontakt, eksamen_antal, eksamen_form, eksamen_notes, eksamen_dok) values ('$delete_id', '$eksamen_uddanelse','$eksamen_dato',$eksamen_uge,'$eksamen_bygning', '$eksamen_sted', '$eksamen_start','$eksamen_slut','$eksamen_fag', '$eksamen_kontakt', '$eksamen_antal' ,'$eksamen_form', '$eksamen_notes', '$eksamen_dok')";

		 $run_bestilling=mysqli_query($con, $insert_bestilling);

   		$delete_bestilling="delete from bestillinger where eksamen_id='$delete_id'";
   		

   		if ($run_bestilling) {
			$run_delete=mysqli_query($con,$delete_bestilling);
			if ($run_delete) {
   			echo "<script>alert('Bestilling er blevet slettet.')</script>";
   			echo "<script>window.open('index.php?alle_bestillinger','_self')</script>";
   		}}
         else{
         	   echo "<script>alert('ERROR')</script>";
   		}

   }
 ?>
