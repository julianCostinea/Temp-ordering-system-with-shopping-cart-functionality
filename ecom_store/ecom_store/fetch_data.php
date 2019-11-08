<?php
	include 'includes/db.php';
	if (isset($_POST['action'])) {
		if (isset($_POST['page'])) {
                  $page=$_POST['page'];
                }
                else {
                  $page=1;
                }
        $per_page=6;
        $start_from=($page-1) * $per_page;
		$query="SELECT * FROM products LIMIT $start_from, $per_page";
		
		if (isset($_POST['brand'])) {
			$query="SELECT * FROM products ";
			$brand_filter=implode("','", $_POST['brand']);
			$query.="WHERE manufacturer_id IN('".$brand_filter."') ";
			$query.="LIMIT $start_from, $per_page";
		}
		$run_query=mysqli_query($con,$query);
		$output='';
		$count=mysqli_num_rows($run_query);
		if ($count>0) {
			while ($row_products=mysqli_fetch_array($run_query)) {
 			$pro_id=$row_products['product_id'];
 			$pro_title=$row_products['product_title'];
 			$pro_price=$row_products['product_price'];
 			$pro_img1=$row_products['product_img1'];
 			$pro_label=$row_products['product_label'];
 			$pro_url=$row_products['product_url'];
			$pro_psp_price=$row_products['product_psp_price'];
			$manufacturer_id=$row_products['manufacturer_id'];

			$get_manufacturer="select * from manufacturers where manufacturer_id='$manufacturer_id'";
			$run_manufacturer=mysqli_query($con,$get_manufacturer);
			$row_manufacturer=mysqli_fetch_array($run_manufacturer);
			$manufacturer_name=$row_manufacturer['manufacturer_title'];

			if ($pro_label=="Sale") {
					$product_price="<del> $$pro_price </del>";
					$product_psp_price="$$pro_psp_price";
				}
				else{
					$product_psp_price="";
					$product_price="$$pro_price";
				}

				if (!empty($pro_label)) {
					$product_label= "<a class='label sale' href='#'> 
						<div class='thelabel'> $pro_label </div>
						<div class='label-background'> </div>
					</a>
					";
				}

 			$output.= "
				 <div class='col-md-4 col-sm-6'>
				 	<div class='product'>
				 		<a href= '$pro_url'>
				 		<img src='admin_area/product_images/$pro_img1' class='img-fluid'>
				 		</a>
				 		<div class='text'>
				 			<div class='text-center mt-3'>
				 			<p class='btn btn-primary'>$manufacturer_name</p> <hr>
				 			</div>
							<h4><a href='$pro_url'> $pro_title </a></h4>
							<p class='price'>$product_price $product_psp_price</p>
							<p class='buttons'>
								<a href='$pro_url' class='btn btn-light'> 
								View Details</a>
								<a href='$pro_url' class='btn btn-danger'>
									<i class='fa fa-shopping-cart'></i> Add to Cart
								</a>
							</p>
					    </div>
					    $product_label
				 	</div>
				 </div>
				";
 		 }
		}
		else{
			$output='<h3>No Data Found</h3>';
		}
		echo $output;
	}
?>