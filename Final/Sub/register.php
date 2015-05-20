<?php
session_start(); //Allows the page to use the session variables.

include_once 'connection.php'; // Connects to the database using the predefined connection in connection.php.

	//Saves the information posted from the login.php page as local variables.
	$username = $_POST['name'];
	$password_plain = $_POST['password'];
	$password = md5($password_plain); //Uses the MD5 hashing function on the plain text password.
	$address = $_POST['address'];
	$email = $_POST['email'];
	$dob = $_POST['phone'];
	
	//Check if the email address entered already exists in the customer database.
	$query = "SELECT 1 FROM customer WHERE email='$email'";
	$rs = pg_query($dbconn, $query) or die ("Goofed up");
	
	$rows = pg_num_rows($rs); //Counts the number of search results returned.
	
	if ($rows >= 1) //Checks if the email address already exists.
	{
		$_SESSION['register_error'] = "Email Address is already Registered, please use a different address."; //Set the register_error session variable
		header("location: ../login.php"); //Redirect the user to the login.php page.
	}
	
	else //Email address is not on the database.
	{
		//Insert the users input into the customer table.
		$query = "INSERT INTO customer (name, email, password, address_1, dob) VALUES('$username', '$email', '$password','$address', '$dob')";
		$rs = pg_query($dbconn, $query) or die ("Goofed up");
		
			$query2 = "SELECT * FROM customer WHERE email='$email'"; //Retrieve the users information from the customer table.
			$result = pg_query($dbconn, $query2) or die ("Goofed up");
			$row2 = pg_fetch_row($result); //Save the results in an array called $row2.
		
		//Set the session variables using the customer information to log them in.
		$_SESSION['customer_id']= $row2[0]; 
		$_SESSION['user'] = $username;
		$_SESSION['email'] = $email;
		$_SESSION['register_error']="";
		header("location: ../account.php"); //Redirect the user to the account.php page.
	}
?>