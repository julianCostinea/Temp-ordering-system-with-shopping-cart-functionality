<?php 
	
	$db = mysqli_connect("localhost", "root", "ratpack12", "ecom_store");

	 function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
			    }
		 }



		 function getPCats(){

			global $db;

			$get_p_cats = "select * from product_categories";

			$run_p_cats = mysqli_query($db,$get_p_cats);

			while($row_p_cats = mysqli_fetch_array($run_p_cats)){

			$p_cat_id = $row_p_cats['p_cat_id'];

			$p_cat_title = $row_p_cats['p_cat_title'];

			echo "<li class='nav-item'><a class='nav-link' href='shop_withphp.php?p_cat=$p_cat_id'> $p_cat_title </a></li>";

		} }


	function add_cart($product_link){
			global $db;
			$ip_add=getRealUserIp();
			$product_id=$product_link;
			$product_qty=$_POST['product_qty'];
			$product_size=$_POST['product_size'];

			$get_product_url="select * from products where product_id='$product_id'";
			$run_product_url=mysqli_query($db,$get_product_url);
			$row_product_url=mysqli_fetch_array($run_product_url);
			$product_url=$row_product_url['product_url'];
			$check_product="select * from cart where ip_add='$ip_add' AND p_id='$product_id'";
			$run_check=mysqli_query($db, $check_product);
			if (mysqli_num_rows($run_check)>0) {
				echo "
				<script>alert('This product is already in your cart') </script>
				";
				echo "
				<script>window.open('$product_url', '_self') </script>
				";
			}
			else{
				$get_price="select * from products where product_id='$product_id'";
				$run_price=mysqli_query($db,$get_price);
				$row_price=mysqli_fetch_array($run_price);
				$pro_price=$row_price['product_price'];
				$pro_psp_price=$row_price['product_psp_price'];
				$pro_label=$row_price['product_label'];
				$pro_url=$row_price['product_url'];
				if ($pro_label=="Sale") {
					$product_price=$pro_psp_price;
				}
				else{
					$product_price=$pro_price;
				}

				$query="insert into cart (p_id,ip_add,qty,p_price, size) values ('$product_id','$ip_add','$product_qty', '$product_price' ,'$product_size')";
				$run_query=mysqli_query($db,$query);
				echo "
				<script>window.open('$pro_url', '_self') </script>
				";
			}
	}

	function items(){
		global $db;
		$ip_add=getRealUserIp();
		$get_items="select * from cart where ip_add='$ip_add'";
		$run_items=mysqli_query($db,$get_items);
		$count_items=mysqli_num_rows($run_items);
		echo $count_items;

	}

	function total_price(){
		global $db;
		$ip_add=getRealUserIp();
		$total=0;
		$select_cart="select * from cart where ip_add='$ip_add'";
		$run_cart=mysqli_query($db,$select_cart);
		while ($record=mysqli_fetch_array($run_cart)) {
			$pro_id=$record['p_id'];
			$pro_qty=$record['qty'];
			$p_price=$record['p_price'];
			$sub_total=$p_price*$pro_qty;
			$total+=$sub_total;
		}
		echo "$ $total";
	}

	function getPro(){
		global $db;
		$get_products="select * from products order by 1 DESC LIMIT 0,8"; 
			$run_products= mysqli_query($db, $get_products);
			while ($row_products=mysqli_fetch_array($run_products)) {
				$pro_id=$row_products['product_id'];
				$pro_title=$row_products['product_title'];
				$pro_price=$row_products['product_price'];
				$pro_img1=$row_products['product_img1'];
				$pro_label=$row_products['product_label'];
				$pro_psp_price=$row_products['product_psp_price'];
				$manufacturer_id=$row_products['manufacturer_id'];

				$get_manufacturer="select * from manufacturers where manufacturer_id='$manufacturer_id'";
				$run_manufacturer=mysqli_query($db,$get_manufacturer);
				$row_manufacturer=mysqli_fetch_array($run_manufacturer);
				$manufacturer_name=$row_manufacturer['manufacturer_title'];
				$pro_url=$row_products['product_url'];

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

				echo "
				 <div class='col-sm-6 col-md-3 single'>
				 	<div class='product'>
				 		<a href= '$pro_url'>
				 		<img src='admin_area/product_images/$pro_img1' class='img-fluid'>
				 		</a>
				 		<div class='text'>
				 			<div class='text-center mt-3'>
				 			<p class='btn btn-primary'>$manufacturer_name</p> <hr>
				 			</div>
							<h4 class='mt-0'><a href='$pro_url'> $pro_title </a></h4>
							<p class='price'>$product_price $product_psp_price</p>
							<p class='buttons'>
								<a href='$pro_url' class='btn btn-light'> 
								View Details</a>
								<a href='$pro_url' class='btn btn-primary'>
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


 function getPCatPro(){
 	global $db;
 	if (isset($_GET['p_cat'])){
 		$p_cat_id=$_GET['p_cat'];
 		$get_p_cat="select * from product_categories where p_cat_id='$p_cat_id'";
 		$run_p_cat=mysqli_query($db,$get_p_cat);
 		$row_p_cat=mysqli_fetch_array($run_p_cat);
 		$p_cat_title=$row_p_cat['p_cat_title'];
 		$p_cat_desc=$row_p_cat['p_cat_desc'];
 		$get_products="select * from products where p_cat_id=$p_cat_id";
 		$run_products=mysqli_query($db, $get_products);

 		echo "
	 		<div class='col-md-12'>
	 		<div class='boxes mb-4'>
	          <h1>$p_cat_title</h1>
	          <hr>
	          <p>
	            $p_cat_desc
	          </p>
	         </div>
	        </div>
	 		";
 		while ($row_products=mysqli_fetch_array($run_products)) {
 			$pro_id=$row_products['product_id'];
 			$pro_title=$row_products['product_title'];
 			$pro_price=$row_products['product_price'];
 			$pro_img1=$row_products['product_img1'];

 			echo "
				 <div class='col-md-4 col-sm-6'>
				 	<div class='product'>
				 		<a href= 'pro_url'>
				 		<img src='admin_area/product_images/$pro_img1' class='img-fluid'>
				 		</a>
				 		<div class='text'>
							<h4><a href='details.php?pro_id=$pro_id'> $pro_title </a></h4>
							<p class='price'>$ $pro_price</p>
							<p class='buttons'>
								<a href='details.php?pro_id=$pro_id' class='btn btn-light'> 
								View Details</a>
								<a href='details.php?pro_id=$pro_id' class='btn btn-danger'>
									<i class='fa fa-shopping-cart'></i> Add to Cart
								</a>
							</p>
					    </div>
				 	</div>
				 </div>
				";
 		}
 	}
 }

 function getCatPro(){
 	global $db;
 	if (isset($_GET['cat'])) {
 		$cat_id=$_GET['cat'];
 		$get_cat="select * from categories where cat_id=$cat_id";
 		$run_cat=mysqli_query($db,$get_cat);
 		$row_cat=mysqli_fetch_array($run_cat);
 		$cat_title=$row_cat['cat_title'];
 		$cat_desc=$row_cat['cat_desc'];
 		$get_products="select * from products where 
 		cat_id='$cat_id'";
 		$run_products=mysqli_query($db,$get_products);
 		echo "
	 		<div class='col-md-12'>
	 		<div class='boxes mb-4'>
	          <h1>$cat_title</h1>
	          <hr>
	          <p>
	            $cat_desc
	          </p>
	         </div>
	        </div>
	 		";

	 	while ($row_products=mysqli_fetch_array($run_products)) {
	 		$pro_id=$row_products['product_id'];
 			$pro_title=$row_products['product_title'];
 			$pro_price=$row_products['product_price'];
 			$pro_img1=$row_products['product_img1'];

 			echo "
				 <div class='col-md-4 col-sm-6'>
				 	<div class='product'>
				 		<a href= 'details.php?pro_id=$pro_id'>
				 		<img src='admin_area/product_images/$pro_img1' class='img-fluid'>
				 		</a>
				 		<div class='text'>
							<h4><a href='details.php?pro_id=$pro_id'> $pro_title </a></h4>
							<p class='price'>$ $pro_price</p>
							<p class='buttons'>
								<a href='details.php?pro_id=$pro_id' class='btn btn-light'> 
								View Details</a>
								<a href='details.php?pro_id=$pro_id' class='btn btn-danger'>
									<i class='fa fa-shopping-cart'></i> Add to Cart
								</a>
							</p>
					    </div>
				 	</div>
				 </div>
				";
	 	}
 	}
 }
 ?>
