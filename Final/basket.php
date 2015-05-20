<?php 
include('header.php'); //USes the shared hearder.php file.
$grandTot=0; //initialise local variable. 
?>


    <div id="main_body">
        <h2>Shopping Basket</h2>
        <div id="basket_items" class="wrapper">
            <?php 
				$custid = $_SESSION['customer_id'];
				
                //Getting all items this specific user chose to add to their basket
                $q = pg_query($dbconn,"SELECT * FROM shopping_cart WHERE customer_id= '$custid' ORDER BY product_id"); 
				
                while($row = pg_fetch_array($q)){       //Loops through shopping_cart items
                    // This will be used to grab the specific item details from the product table
					
                    $product = pg_query($dbconn, "SELECT * FROM product WHERE product_id=".$row[0]); 
                    $row2 = pg_fetch_array($product);       //This will loop through the Product array
                   // NEDDED???? $id=$row[0]; 
					?>
                    
  <div class="Product-box">
	<div class="wrapper">
	    <!-- used to create a 2x1 grid -->
	    <div class="row">
	        <div class="col_1_3">
	        	<a id="pic" href="product.php?chosen_item=<?php echo $row[0]; ?>">
	        		<img src="<?php echo $row2[6];?>" alt="Product" width="300" height="300">
        		</a>
	        </div>
	        <div class="col_2_3">
			<!-- Displays information from the shopping_cart table -->
	        	<a href="product.php?chosen_item=<?php echo $row[0]; ?>"><h2 class="product_description"><?php echo $row2[1];?></h2></a>
	        	<p class="product_description">&euro;<?php echo $row2[3];?> </p>
				<p class="product_description">Quantity = <?php echo $row[2]; ?> </p>
				
				<p>	
				<!-- Button which allows the user to remove items from the basket -->
				<form action="Sub/removeFromBasket.php" method="get">
				<button class="basket" type="submit" value="<?php echo $row[0]; ?>" name="Remove" id="basket">Remove From Basket</button>
                   </form>  </p>           
								
	        	<p class="product_description">Total Price = &euro;<?php $tot = ($row2[3]*$row[2]); echo $tot; ?></p> <?php $grandTot += $tot; ?>
	        </div>
	    </div>
	</div>
	
	<hr class="a">
 <?php } //This will exit the loop when all items have been visited
		$_SESSION['grand_total'] = $grandTot;
 ?> 
			<!-- Displays the total price of the items and a button which redirects the user to the payment.php page. -->
            <h2 style="color:black">Total Price: &euro;<?php echo $grandTot;?><span id="total_price"></span></h2> <!-- Prints total -->
            <p> <form action="payment.php">
				<button class="basket" type="submit" value="<?php echo $row[0]; ?>" name="Remove" id="basket">Submit Order</button>
                   </form> 
        </div>
    </div>
<?php include('footer.php');
$_SESSION['total'] = $grandTot;
?>