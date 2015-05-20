<?php
/*
* This page receives post variables from the account.php page and uses them to update the customer table for the loggin in user.
*/

session_start(); //Allows the page to use the session variables.

	require_once 'connection.php'; // Connects to the database using the predefined connection in connection.php.
	
	//Saves the session variables as local variables.
	$name = $_POST['Name'];
	$newEmail = $_POST['Email']; 
	$password = $_POST['Password'];
	$phone = $_POST['Phone'];
	$address = $_POST['Address'];
	$address = ltrim($address);  // remove white space from the address
	$address = rtrim($address);  // remove white space from the address
	
	$email = $_SESSION['email']; //Retrieves the email session variable and saves it as a local variable.
	
	//Updates the customer table with the new information
	$query = "UPDATE customer SET name = '$name', email = '$newEmail', password = '$password', address_1 = '$address', dob ='$phone' WHERE email='$email'";
	$rs = pg_query($dbconn, $query) or die ("goofed");
		
		header("location: ../account.php"); //redirects the user to the account.php page.
 
?>
