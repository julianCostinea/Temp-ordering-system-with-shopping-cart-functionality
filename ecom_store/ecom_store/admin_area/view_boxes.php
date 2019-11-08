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
						$get_boxes="select * from boxes_section";
						$run_boxes=mysqli_query($con,$get_boxes);
						while ($row_boxes=mysqli_fetch_array($run_boxes)) {
							$box_id=$row_boxes['box_id'];
							$box_title=$row_boxes['box_title'];
							$box_desc=$row_boxes['box_desc'];
					 ?>
					 	<div class="col-md-4 mb-3">
					 		<div class="card bg-primary" style="min-height: 15rem;">
					 			<div class="card-header">
					 				<h3 class="card-title" style="min-height: 4rem;"><?php echo $box_title; ?> </h3>
					 			</div>
					 			<div class="card-body bg-light">
					 				<p><?php echo $box_desc; ?></p>
					 			</div>
					 			<div class="card-footer ">
					 				<a class="float-left text-white" href="index.php?delete_box=<?php echo $box_id; ?>"><i class="far fa-trash-alt"></i>Delete</a>
					 				<a class="float-right text-white" href="index.php?edit_box=<?php echo $box_id; ?>"><i class="far fa-edit"></i>Edit</a>
					 			</div>
					 		</div>
					 	</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>