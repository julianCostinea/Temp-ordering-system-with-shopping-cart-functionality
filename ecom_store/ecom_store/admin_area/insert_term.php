<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

<div class="row">
 	<div class="col-lg-11">
		<div class="card bg-primary text-white">
			<div class="card-header">
				<h1 class="card-title">Insert Term</h1>
			</div>
			<!-- start here !-->
			
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
					    <label for="term_title" class="col-md-2 col-form-label">Term Title</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="term_title" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="term_desc" class="col-md-2 col-form-label">Term Description</label>
					    <div class="col-md-6">
					      <textarea name="term_desc" class="form-control" style="resize: none;"></textarea>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="term_Link" class="col-md-2 col-form-label">Term Link</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="term_link" required>
					    </div>
				    </div>
				    <div class="form-group row">
					    <label for="" class="col-md-2 col-form-label"></label>
					    <div class="col-md-6">
					      <input type="submit" value="Submit" name="submit" class="btn btn-light form-control">
					    </div>
				    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
	if (isset($_POST['submit'])) {
		$term_title=$_POST['term_title'];
		$term_desc=$_POST['term_desc'];
		$term_link=$_POST['term_link'];

		$insert_term="insert into terms (term_title, term_link, term_desc) values ('$term_title', '$term_link',  '$term_desc') ";
		$run_term=mysqli_query($con,$insert_term);

	if ($run_term) {
 		echo "<script>alert('Term has been inserted')</script>";
 		echo "<script>window.open('index.php?view_terms','_self')</script>";
 	}
 	else{
 		echo "<script>alert('ERROR')</script>";
 	}
 	}
 ?>