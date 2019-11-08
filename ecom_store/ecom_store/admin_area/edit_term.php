<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <?php
 	if (isset($_GET['edit_term'])) {
 	 	$edit_id=$_GET['edit_term'];
 	 	$get_term="select * from terms where term_id='$edit_id'";
 	 	$run_term=mysqli_query($con,$get_term);
 	 	$row_term=mysqli_fetch_array($run_term);

 	 	$term_id=$edit_id;
 	 	$term_title=$row_term['term_title'];
 	 	$term_link=$row_term['term_link'];
 	 	$term_desc=$row_term['term_desc'];

 	 } 
  ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Edit Term</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="term_title" class="col-md-2 col-form-label"></label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="term_title" required value="<?php echo $term_title; ?>">
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="term_desc" class="col-md-2 col-form-label">Term Description</label>
					    <div class="col-md-6">
					      <textarea name="term_desc" class="form-control" style="resize: none;">
					      	<?php echo $term_desc; ?>
					      </textarea>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="term_Link" class="col-md-2 col-form-label">Term Link</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="term_link" required value="<?php echo $term_link; ?>">
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="" class="col-md-2 col-form-label"></label>
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
		$term_title=$_POST['term_title'];
		$term_desc=$_POST['term_desc'];
		$term_link=$_POST['term_link'];

		$update_term="update terms set term_title='$term_title', term_link='$term_link', term_desc='$term_desc' where term_id='$term_id'";
		$run_term=mysqli_query($con,$update_term);

	if ($run_term) {
 		echo "<script>alert('Term has been updated')</script>";
 		echo "<script>window.open('index.php?view_terms','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>