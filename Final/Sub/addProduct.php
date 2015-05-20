<?php
session_start();

include_once 'connection.php';

	// The following variables takes the value from the Post method variable set in the admin.php page.
	$name = $_POST['Name'];  
	$description = $_POST['Description']; 
	$price = $_POST['Price']; 
	if (isset($_POST['DiscountedPrice'])) // checks if the user has entered the optional discounted price field.
	{
		$discount = $_POST['DiscountedPrice']; //Takes the value from the $_POST['discounted_price'] variable set in the admin.php page.
	}
	else
	{
		$discount = "5"; //default value if no user input
	}
	$stock = $_POST['Stock'];
	$image = $_POST['Image'];
	if(isset($_POST['Thumbnail']))
	{
		$thumb = $_POST['Thumbnail']; // checks if the user has entered the optional discounted price field.
	}
	else
	{
		$thumb = "Test Thumbnail"; //default value if no user input
	}
	$display = "1";
	$category = $_POST['Category'];
	$tags = $_POST['Tags'];
	
		// query inserts the Post values into the relevent fields in the products table
		$query = "INSERT INTO product ( name, description, price, discounted_price, stock, image, thumbnail, display, category_id, tags) VALUES( '$name', '$description', '$price','$discount', '$stock', '$image', '$thumb', '$display', '$category', '$tags')";
		
		//uses the global 
		$rs = pg_query($dbconn, $query) or die ("Goofed");
		
		header("location: ../admin.php");

?>