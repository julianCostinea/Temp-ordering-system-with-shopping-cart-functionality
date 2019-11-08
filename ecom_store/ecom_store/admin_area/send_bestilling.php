<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11 mt-2">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Send Bestilling</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post" enctype="multipart/form-data" id="registration_form">
					<div class="form-group row">
					    <label for="eksamen_uddanelse" class="col-md-2 col-form-label">Uddanelse</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="eksamen_uddanelse" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_dato" class="col-md-2 col-form-label">Dato</label>
					    <div class="col-md-2">
					     <input type="text" class="form-control" name="eksamen_dato" id="eksamen_dato" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_uge" class="col-md-2 col-form-label">Ugenummer </label>
					    <div class="col-md-2">
					     <input type="number" class="form-control " name="eksamen_uge" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_bygning" class="col-md-2 col-form-label">Bygnings-nummer (hvis relevant)</label>
					    <div class="col-md-6">
					     <input type="text" class="form-control" name="eksamen_bygning" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_sted" class="col-md-2 col-form-label">Mødested (f. eks. lokalenummer, kantine osv.)</label>
					    <div class="col-md-6">
					     <input type="text" class="form-control" name="eksamen_sted" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_start" class="col-md-2 col-form-label">Eksamensvagt mødetid kl. (Her skal du oplyse vikarens mødetid, ikke eksamen starttidspunkt)</label>
					    <div class="col-md-6">
					     <input type="text" class="form-control" name="eksamen_start" id="eksamen_start" placeholder="hh:mm" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_slut" class="col-md-2 col-form-label">Eksamensvagt sluttid kl.</label>
					    <div class="col-md-6">
					     <input type="text" class="form-control" name="eksamen_slut" placeholder="hh:mm" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_fag" class="col-md-2 col-form-label">Fag.</label>
					    <div class="col-md-6">
					     <input type="text" class="form-control" name="eksamen_fag" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_kontakt" class="col-md-2 col-form-label">Kontaktperson (koordinator, sekretær, lærer)+ telefonnummer (hvis relevant) </label>
					    <div class="col-md-6">
					     <input type="text" class="form-control" name="eksamen_kontakt" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_antal" class="col-md-2 col-form-label">Antal tilsyn </label>
					    <div class="col-md-2">
					     <input type="number" class="form-control" name="eksamen_antal" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_form" class="col-md-2 col-form-label">Eksamen form.</label>
					    <div class="col-md-6">
					     <select name="eksamen_form" required>
					     	<option value="">Eksamen form</option>
					     	<option value="Skriftlig">Skriftlig</option>
					     	<option value="Mundtlig">Mundtlig</option>
					     </select>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_notes" class="col-md-2 col-form-label">Bemærkninger</label>
					    <div class="col-md-6">
					      <textarea style="resize: none;" name="eksamen_notes" class="form-control" rows="6" cols="50"></textarea>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="eksamen_dok" class="col-md-2 col-form-label">Relevante dokumenter (regler, info til vikar osv.)</label>
					    <div class="col-md-3">
					     <input type="file" class="form-control-file" name="eksamen_dok">
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="" class="col-md-2 col-form-label"></label>
					    <div class="col-md-6">
					      <input type="submit" value="Send bestilling" name="submit" class="btn btn-light form-control">
					    </div>
				    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
	if (isset($_POST['submit'])) {
		$eksamen_uddanelse=$_POST['eksamen_uddanelse'];
		$eksamen_dato=$_POST['eksamen_dato'];
		$eksamen_uge=$_POST['eksamen_uge'];
		$eksamen_bygning=$_POST['eksamen_bygning'];
		$eksamen_sted=$_POST['eksamen_sted'];
		$eksamen_start=$_POST['eksamen_start'];
		$eksamen_slut=$_POST['eksamen_slut'];
		$eksamen_fag=$_POST['eksamen_fag'];
		$eksamen_kontakt=$_POST['eksamen_kontakt'];
		$eksamen_antal=$_POST['eksamen_antal'];
		$eksamen_form=$_POST['eksamen_form'];
		$eksamen_notes=$_POST['eksamen_notes'];

		$eksamen_dok=$_FILES['eksamen_dok']['name'];
		$temp_name=$_FILES['eksamen_dok']['tmp_name'];

	 	move_uploaded_file($temp_name, "bestillinger/$eksamen_dok");
	 	

		 $insert_bestilling="insert into bestillinger (eksamen_uddanelse,eksamen_dato, eksamen_uge, eksamen_bygning,eksamen_sted, eksamen_start, eksamen_slut, eksamen_fag, eksamen_kontakt, eksamen_antal, eksamen_form, eksamen_notes, eksamen_dok) values ('$eksamen_uddanelse','$eksamen_dato',$eksamen_uge,'$eksamen_bygning', '$eksamen_sted', '$eksamen_start','$eksamen_slut','$eksamen_fag', '$eksamen_kontakt', '$eksamen_antal' ,'$eksamen_form', '$eksamen_notes', '$eksamen_dok')";

		 $run_bestilling=mysqli_query($con, $insert_bestilling);

		if ($run_bestilling) {
 		echo "<script>alert('Bestilling er blevet sendt.')</script>";
 		echo "<script>window.open('index.php?alle_bestillinger','_self')</script>";
	 	}
	 	else{
	 		echo "<script>alert('Bestilling kunne ikke sendes. Prøv igen!)</script>";
	 	}
 	}
 ?>