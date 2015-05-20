<?php 
/*
* This page allows the user to remove items associate with them from the shopping_cart table.
*/

session_start(); //Allows the page to use the session variables.

include_once 'connection.php'; // Connects to the database using the predefined connection in connection.php.

		$prod_id = $_GET['Remove']; //Saves the information posted from the basket.php page as local a variable.
	
		$custid = $_SESSION['customer_id']; //Saves the customer_id session variable as a local vaiable.
		
		//Searches the shopping_cart for the specific product associated with the logged in user.
		$query = pg_query($dbconn, "SELECT * FROM shopping_cart WHERE product_id = '$prod_id' AND customer_id = '$custid'");
		$result = pg_fetch_row($query);
		$quantity = ($result[2] - 1); //This is what the item quantity will be when one is removed.
										
		if($quantity == 0) //If the quantity will be zero then the entire row is deleted from the shopping_cart table.
		{
			$query = "DELETE FROM shopping_cart WHERE product_id = '$prod_id' AND customer_id = '$custid'";
			$rs = pg_query($dbconn, $query) or die ("goofed");
		}
		else //The quantity field in the shopping_cart table is decremented by one.
		{	
			$query = "UPDATE shopping_cart SET quantity = '$quantity' WHERE product_id='$prod_id' AND customer_id = '$custid'";
			$rs = pg_query($dbconn, $query) or die ("goofed");
		}
		
		header("location: ../basket.php"); //The user is redirected to the basket page.

?>