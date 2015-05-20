<?php include('header.php'); //Uses the shared header.php file.


	$id = $_GET['cat']; //Saves the variable sent from the header.php file using the GET method and saves it as a local variable.
	
	//Depending on the category selected by the user a different search query is used:
	if($id == 9) 
	{
		$item = pg_query($dbconn, "SELECT * FROM product WHERE category_id = 1 OR category_id=2 OR category_id=3");
		
		
	}
	else if ($id== 10)
	{
		$item = pg_query($dbconn, "SELECT * FROM product WHERE category_id = 4 OR category_id=5 OR category_id=6");
	
	}
	else if($id == 11)
	{
		$item = pg_query($dbconn, "SELECT * FROM product WHERE category_id = 7 OR category_id=8");
		
	}
	else{
	$item = pg_query($dbconn, "SELECT * FROM product WHERE category_id = '$id'"); 
	
	}

	//Execute the search and loop through the results.
	while($row = pg_fetch_array($item)) {

?>

<div class="Product-box">
	<div class="wrapper">
	    <!-- used to create a 2x1 grid -->
	    <div class="row">
	        <div class="col_1_3">
	        	<a id="pic" href="product.php?chosen_item=<?php echo $row[0]; ?>">
	        		<img src="<?php echo $row[6];?>" alt="Product" width="300" height="300">
        		</a>
	        </div>
	        <div class="col_2_3">
	        	<a href="product.php?chosen_item=<?php echo $row[0]; ?>"><h2 class="product_description"><?php echo $row[1];?></h2></a>
	        	<p class="product_description">&euro;<?php echo $row[3];?></p>
	        	<p class="product_description"><?php echo $row[2];?></p>
	        </div>
	    </div>
	</div>
	<hr class="a">
<?php 
}?>

</div>

<?php include('footer.php'); ?>