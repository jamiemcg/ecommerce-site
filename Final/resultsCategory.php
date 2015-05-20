<?php

    include('header.php'); //Call the php header.


		$query = trim($_POST['Order']);	 //Get search term and trim white space.
		

        //Returns results where the query matches the description of the product or the title or tags field. Case insensitive. Ordered by Price.
        $sql_query = "SELECT * FROM product WHERE UPPER(description) LIKE UPPER('%$query%') OR UPPER(name) LIKE UPPER('%$query%') OR UPPER(tags) LIKE UPPER('%$query%') ORDER BY category_id";
		
		
		$item = pg_query($dbconn, $sql_query); 	//Perform search.
		
		$num = pg_num_rows($item); //Counts the number of results.
		?>
<div id="main_body">
	<table id="order" align="center">
	 <tr>
		<td>
		<form action="resultsPrice.php" method="post">
				<button class="basket" type="submit" value="<?php echo $query; ?>" name="Order" id="basket">Order by: Price</button>
		</form> 
		</td>
		<td>
		<form action="resultsName.php" method="post">
				<button class="basket" type="submit" value="<?php echo $query; ?>" name="Order" id="basket">Order by: Name</button>
		</form> 
		</td>
		<td>
		<form action="resultsCategory.php" method="post">
				<button class="basket" type="submit" value="<?php echo $query; ?>" name="Order" id="basket">Order by: Category</button>
		</form> 
		</td>
		</tr>
		</table>
	
 <?php
	while($row = pg_fetch_array($item)) { //loop through search results, results stored in an array called $row.

?>
<div class="Product-box">
	
	<div class="wrapper">
	    <!-- used to create a 2x1 grid -->
	    <div class="row">
	        <div class="col_1_3">
	        	<a id="pic" href="product.php?chosen_item=<?php echo $row[0]; ?>"> <!-- display image of the product which is also a hyperlink to the product information page. -->
	        		<img src="<?php echo $row[6];?>" alt="Product" width="300" height="300">
        		</a>
	        </div>
	        <div class="col_2_3">
	        	<a href="product.php?chosen_item=<?php echo $row[0]; ?>"><h2 class="product_description"><?php echo $row[1];?></h2></a> <!-- display name of product which is also a hyperlink to the product information page. -->
	        	<p class="product_description">&euro;<?php echo $row[3];?></p> <!-- display product price -->
	        	<p class="product_description"><?php echo $row[2];?></p> <!-- display product price -->
	        </div>
	    </div>
	</div>
	<hr class="a"> <!-- line break between products displayed -->
<?php 
}?>

</div>
</div>

 <?php 
            include('footer.php'); //call the php footer.
 ?>