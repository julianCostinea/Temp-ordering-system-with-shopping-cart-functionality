<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>
 <?php
 	$file="../styles/style.css";
 	$data=file_get_contents($file);
 ?>
<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-warning text-white">
			<div class="card-header">
				<h1 class="card-title">Edit CSS File</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post">
				    <div class="form-group row">
					    <div class="col-md-12">
					      <textarea name="newdata" rows="25" class="form-control" style="resize: none;"><?php echo $data; ?></textarea>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="" class="col-md-3 col-form-label"></label>
					    <div class="col-md-6">
					      <input type="submit" value="Submit" name="update" class="btn btn-light form-control">
					    </div>
				    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	if (isset($_POST['update'])) {
		$newdata=$_POST['newdata'];
		$handle=fopen($file, "w");
		fwrite($handle, $newdata);
		fclose($handle);

		echo "<script>alert('CSS has been updated')</script>";
 		echo "<script>window.open('index.php?edit_css','_self')</script>";
	}
?>