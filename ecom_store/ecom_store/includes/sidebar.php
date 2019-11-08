<div class="card sidebar-menu mb-4">
	<div class="card-header" href="#manufacturers" style="color: black; cursor: pointer;" data-toggle="collapse">
					<h5>Manufacturers 	<i class="fas fa-angle-up float-right"></i></h5>

	</div>
	<div id="manufacturers" class="collapse show">
		<div class="card-body">
			<div class="input-group">
				<input type="text" class="form-control" id="filter-manufacturer" data-action="filter" data-filters="#dev-manufacturer" placeholder="filter manufacturers">
			</div>
		</div>
		<div class="card-body scroll-menu">
			<ul class="nav nav-pills flex-column category-menu" id="dev-manufacturer">
			  <?php 
			  	$get_manufacturer="select * from manufacturers where manufacturer_top='yes'";
			  	$run_manufacturer=mysqli_query($con,$get_manufacturer);
			  	while ($row_manufacturer=mysqli_fetch_array($run_manufacturer)) {
			  		$manufacturer_id=$row_manufacturer['manufacturer_id'];
			  		$manufacturer_title=$row_manufacturer['manufacturer_title'];

			  	echo "<li class='nav-item checkbox checkbox-primary'>
				    	<a class='nav-link'>
				    		<label>
				    			<input type='checkbox' value='$manufacturer_id' name='manufacturer' class='get_manufacturer brand'>
				    			<span> $manufacturer_title</span>
				    		</label>
				    	</a>
				  	  </li>";
			  	}
			  	$get_manufacturer="select * from manufacturers where manufacturer_top='no'";
			  	$run_manufacturer=mysqli_query($con,$get_manufacturer);
			  	while ($row_manufacturer=mysqli_fetch_array($run_manufacturer)) {
			  		$manufacturer_id=$row_manufacturer['manufacturer_id'];
			  		$manufacturer_title=$row_manufacturer['manufacturer_title'];
		  		echo "<li class='nav-item checkbox checkbox-primary'>
			    	<a class='nav-link'>
			    		<label>
			    			<input type='checkbox' value='$manufacturer_id' name='manufacturer' class='get_manufacturer'>
			    			<span> $manufacturer_title</span>
			    		</label>
			    	</a>
			  	  </li>";
			  	}
			   ?>
			</ul>
		</div>
	</div>
</div>


<div class="card sidebar-menu mb-4">
	<div class="card-header" href="#p_categories" style="color: black; cursor: pointer;" data-toggle="collapse">
					<h5>Product Categories<i class="fas fa-angle-up float-right"></i></h5>

	</div>
	<div id="p_categories" class="collapse show">
		<div class="card-body">
			<ul class="nav nav-pills flex-column">
				<?php getPCats(); ?>
			</ul>
		</div>
	</div>
</div>

<div class="card sidebar-menu mb-4">
	<div class="card-header" href="#categories" style="color: black; cursor: pointer;" data-toggle="collapse">
					<h5>Categories <i class="fas fa-angle-down float-right"></i></h5>

	</div>
	<div id="categories" class="collapse">
		<div class="card-body">
			<div class="input-group">
				<input type="text" class="form-control" id="filter-cats" data-action="filter" data-filters="#dev-cats" placeholder="filter categories">
				<div class="input-group-append">
			   	  <a href="" class="input-group-text"><i class="fas fa-search"></i></a>
			    </div>
			</div>
		</div>	
		<div class="card-body scroll-menu">
			<ul class="nav nav-pills flex-column category-menu" id="dev-cats">
			  <?php 
			  	$get_cats="select * from categories where cat_top='yes'";
			  	$run_cats=mysqli_query($con,$get_cats);
			  	while ($row_cats=mysqli_fetch_array($run_cats)) {
			  		$cat_id=$row_cats['cat_id'];
			  		$cat_title=$row_cats['cat_title'];

			  	echo "<li class='nav-item checkbox checkbox-primary'>
				    	<a class='nav-link'>
				    		<label>
				    			<input type='checkbox' value='$cat_id' name='cat' class='get_cat' id='cat'>
				    			<span> $cat_title</span>
				    		</label>
				    	</a>
				  	  </li>";
			  	}
			  	$get_cats="select * from categories where cat_top='no'";
			  	$run_cats=mysqli_query($con,$get_cats);
			  	while ($row_cats=mysqli_fetch_array($run_cats)) {
			  		$cat_id=$row_cats['cat_id'];
			  		$cat_title=$row_cats['cat_title'];

			  	echo "<li class='nav-item checkbox checkbox-primary'>
				    	<a class='nav-link'>
				    		<label>
				    			<input type='checkbox' value='$cat_id' name='cat' class='get_cat' id='cat'>
				    			<span> $cat_title</span>
				    		</label>
				    	</a>
				  	  </li>";
			  	}
			   ?>
			</ul>
		</div>
	</div>
</div>