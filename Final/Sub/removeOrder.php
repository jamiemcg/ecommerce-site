<?php
/*
* This page allows the admin to delete orders associated with a specific user.
* It also allows a logged in user to remove an order associated with their account.
*/

	require_once 'connection.php'; // Connects to the database using the predefined connection in connection.php.
	
		if(isset($_POST['adminID'])) //Checks if the input is adminID from the admin.php page or id from the account.php table.
		{
			$id = $_POST['adminID']; //Saves the information posted from the admin.php page as local a variable.
		}
		else
		{
		$id = $_POST['id']; //Saves the information posted from the account.php page as local a variable.
		}
		
		//Search the orders table for any orders associated with the customer_id.
		$query = "SELECT 1 FROM orders WHERE customer_id='$id'";
		$rs = pg_query($dbconn, $query) or die ("Goofed up");
			
			$rows = pg_num_rows($rs); //Counts the number of results returned.
			
			if ($rows >=1) // Checks if any orders associated with the customer_id exist.
			{
				$delete = pg_query($dbconn, "DELETE FROM orders WHERE customer_id ='$id'");
				
					if(isset($_POST['adminID']))
					{
						header("location: ../admin.php"); //Redirects the user to the admin.php page.
					}
					else
					{
					header("location: ../account.php"); //Redirects the user to the account.php page.
					}
				
			}
			
			else
			{
			 echo "No orders found"; //Display error message.
			 }
			 
	?>