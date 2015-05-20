<?php 
/*
* This page checks the email address and password entered by the user and logs them in if they match, else 
* they are returned to the login page.
*/

session_start(); //Allows the page to use the session variables.

include_once 'connection.php'; // Connects to the database using the predefined connection in connection.php


	$email = $_POST['Email']; //Retrieves the Email input from the post method and saves it in a local variable.
	$password_plain = $_POST['Password']; //Retrieves the Password input from the post method and saves it in a local variable.
	$password = md5($password_plain); //Uses the MD5 hashing function on the plain text password and saves the result.
	
	//Searches the customer table for a matching email address.
	$query = "SELECT 1 FROM customer WHERE email='$email'"; 
	$rs = pg_query($dbconn, $query) or die ("Goofed up");
	
	$rows = pg_num_rows($rs); //Counts the number of rows returned by the search.
	
	if ($rows == 1) //Checks if the email address exists in the customer table.
	{
		$query = "SELECT * FROM customer WHERE email = '$email'";
		$rs = pg_query($dbconn, $query) or die("Goofed up");
		$row = pg_fetch_row($rs); //Saves the result as an array called $row.
		
		if($password == $row[3]) //Compares the password entered by the user to the password saved in the database.
		{
			//If the passwords match the users details are stored in session variables.
			$_SESSION['customer_id']= $row[0]; 
			$_SESSION['user']= $row[1];
			$_SESSION['email']= $row[2];
			$_SESSION['login_error']="";
			header("location: ../index.php"); //User is returned to the home page.
			
		}
		else{ //If the passwords don't match the user is returned to the login page and an error message is displayed.
			 $_SESSION['login_error'] = "Incorrect Password.";
			 header("location: ../login.php");
	       }
	}
	else{ //If the email address is not in the customer table the user is returned to the login page and an error message is displayed.
		 $_SESSION['login_error'] = $email. " is not registered.";
		 header("location: ../login.php");
	}
	
?>
	
 
	
	