<?php 
	 if (!isset($_SESSION['admin_email'])) {
   		 echo "<script>window.open('login.php','_self')</script>";
   		}
 ?>

 <div class="row">
 	<div class="col-lg-11">
		<div class="card bg-light">
			<div class="card-header">
				<h1 class="card-title">View Slides</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<?php
						$get_slides="select * from slider"; 
						$run_slides=mysqli_query($con,$get_slides);
						while ($row_slides=mysqli_fetch_array($run_slides)) {
							$slide_id=$row_slides['slide_id'];
							$slide_name=$row_slides['slide_name'];
							$slide_image=$row_slides['slide_image'];
					 ?>
					 <div class="col-md-4">
					 	<div class="card text-white bg-primary">
					 		<div class="card-header">
					 			<h3 class="card-title"><?php echo $slide_name; ?></h3>
					 		</div>
					 		<div class="card-body bg-light">
					 			<img class="img-fluid" src="slides_images/<?php echo $slide_image; ?>">
					 		</div>
					 		<div class="card-footer bg-light">
					 			<a class="float-left" href="index.php?delete_slide=<?php echo $slide_id; ?>"> 
					 				<i class="far fa-trash-alt"></i> Delete Slide</a>
					 			<a class="float-right" href="index.php?edit_slide=<?php echo $slide_id; ?>"> 
					 				<i class="far fa-edit"></i> Edit Slide</a>
					 		</div>
					 	</div>
					 </div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>