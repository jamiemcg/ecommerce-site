<?php
/*
* This page allows the admin user to remove customers from the customer table.
*/

	require_once 'connection.php'; // Connects to the database using the predefined connection in connection.php.
	
		$id = $_POST['custid']; //Saves the post variable from the admin.php page as a local variable.
		
		//Search the customer table for the user.
		$query = "SELECT * FROM customer WHERE customer_id='$id'"; 
		$rs = pg_query($dbconn, $query) or die ("Goofed up");
			
			$rows = pg_num_rows($rs); //Count the number of results.
			
			if ($rows !=0 ) //Checks if the user exists.
			{
				//Deletes the row containing the customer information.
				$delete = pg_query($dbconn, "DELETE FROM customer WHERE customer_id ='$id'") or die ("goofed");
				$delete2 = pg_query($dbconn, "DELETE FROM shopping_cart WHERE customer_id ='$id'") or die ("goofed");
				header("location: ../admin.php"); //Redirects the user to the admin.php page.
			}
			
			else
			{
			echo $id;
			 echo "No customers found"; //Displays an error message.
			 }
			 
	?>