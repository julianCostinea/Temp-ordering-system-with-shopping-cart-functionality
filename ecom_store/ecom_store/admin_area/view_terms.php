<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Boxes</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<?php 
						$get_terms="select * from terms";
						$run_terms=mysqli_query($con,$get_terms);
						while ($row_terms=mysqli_fetch_array($run_terms)) {
							$term_id=$row_terms['term_id'];
							$term_title=$row_terms['term_title'];
							$term_desc=substr($row_terms['term_desc'],0,400);
					 ?>
					 	<div class="col-md-4 mb-3">
					 		<div class="card bg-info" style="min-height: 23rem;">
					 			<div class="card-header">
					 				<h3 class="card-title" style="min-height: 3rem;"><?php echo $term_title; ?> </h3>
					 			</div>
					 			<div class="card-body bg-light">
					 				<p><?php echo $term_desc; ?></p>
					 			</div>
					 			<div class="card-footer ">
					 				<a class="float-left text-white" href="index.php?delete_term=<?php echo $term_id; ?>"><i class="far fa-trash-alt"></i>Delete</a>
					 				<a class="float-right text-white" href="index.php?edit_term=<?php echo $term_id; ?>"><i class="far fa-edit"></i>Edit</a>
					 			</div>
					 		</div>
					 	</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>