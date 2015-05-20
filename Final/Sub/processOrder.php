<?php

session_start(); //Allows the page to use session variables.
include_once 'connection.php'; // Connects to the database using the predefined connection in connection.php.
/*
* This page contains PHP elements which take a variable customer_id from the payment page via the the POST method.
* The page then copies data from the shopping_cart table to the Order_detail table where the customer_id matches the
* POST variable.
* Once copied the information is then deleted from the shopping_cart table. 
* This page uses the product_id col in the Order_detail page to store the customer_id data from the 
* shopping_cart table.
*/

	$custid = $_SESSION['customer_id'];
				
                //Getting all items this specific user chose to add to their basket
                $query = pg_query($dbconn,"SELECT * FROM shopping_cart WHERE customer_id= '$custid'") or die ("goofed"); 
				$name_and_quantity = "";
				
               while($row = pg_fetch_array($query))  //Loops through shopping_cart items
				{      
                    // This will be used to grab the specific item details from the product table
					
                    $query2 = pg_query($dbconn, "SELECT * FROM product WHERE product_id=".$row[0]) or die ("goofed"); 
                    $product = pg_fetch_array($query2);       //This will loop through the Product array
					
					$name_and_quantity .= "<p>".$product[1] . " x " . $row[2] ."</p>";
				}	
					$tot = $_SESSION['grand_total']; //Saves the grand_total variable which is set in the basket.php page as a local variable.
				
					//Inserts the data from the shopping_cart table and the product table into the orders table.
					$insert = pg_query($dbconn, "INSERT INTO orders (total_amount, product_list, customer_id) VALUES ('$tot', '$name_and_quantity', '$custid')") or die ("goofed");
				
				//Deletes the data associated with the user from the shopping_cart table.
				$delete = pg_query($dbconn, "DELETE FROM shopping_cart WHERE customer_id='$custid'") or die ("goofed");
				
				header("location: ../account.php"); //User is redirected to the account.php page.
	
?>
