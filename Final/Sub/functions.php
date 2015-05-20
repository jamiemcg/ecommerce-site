<?php

/*
* This page contains several functions used in the header.php, login.php and basket.php pages.
*/

require_once 'connection.php'; // Connects to the database using the predefined connection in connection.php.

	//The following are used in the header.php page:
	
	function displayUser() //This function displays the "log out" and "user name" hyperlinks in the header if the user is logged in.
						   // else the "log in" hyperlink is displayed.
	{	
			
		if(isset($_SESSION['customer_id'])) //Checks if the user is logged in.
		{
			
			$dbconn = pg_connect("host=webcourse.cs.nuim.ie dbname=cs230 user=cs230teamc8  password=AmaepieX")
            OR die('Could Not Connect'); 
			
			$cust = $_SESSION['customer_id']; //Saves the session variable as a local variable.
			
			//Retrieves information about the number of items in the logged in customers basket from the shopping_cart table.  
			$query = "SELECT * FROM shopping_cart WHERE customer_id = '$cust'";
			$rs = pg_query($dbconn, $query) or die ("Goofed up");
			
			$noOfItems = 0; //initialise variable. 
			
			while ($row = pg_fetch_row($rs)) //loops through the results of the query.
			{
				$noOfItems += $row[2]; //Adds all the values in the quantity table in the shopping_cart table associated with the logged in customer.
			}
			
			if(strcmp($_SESSION['email'], "Admin@email.com") == 0) //Checks if the Admin user is logged in.
			{
				echo "<li class=\"nav_list_item\">
						<a href=\"admin.php\">"; //Displays the hyperlink to the admin.php page.
			}
			else{
				echo "<li class=\"nav_list_item\">
						<a href=\"account.php\">"; // Displays the hyperlink to the account.php page.
			}
		echo			$_SESSION['user']; //Displays the user name of logged in user.
		echo		"</a> |</li>
			<li class=\"nav_list_item\">
					   <a href=\"Sub/logOut.php\">Log Out</a> | 
				</li>
				<li class=\"nav_list_item\">
                    <a href=\"basket.php\">Basket ("; // Displays a hyperlink to the basket.php and logout.php pages.
		echo $noOfItems; //Displays the number of items in the users basket.
		echo ")</a> | </li>";
			
		}
		
		else
		{
		echo "<li class=\"nav_list_item\">
                    <a href=\"login.php\">Log In</a> |
                </li>"; //If the user is not logged in the hyperlink to the login.php page.
		}
	}
	
	//The following is used in the basket.php page:
	
	/*
	*The displayLoginButton() function displays the "Add to Basket button" next to the product description in
	* the basket.php page if the user is logged in. Else it displays a hyperlink to the login.php page.
	*/
	function displayLoginButton() 
	{	
		if(isset($_SESSION['customer_id']))
		{
			echo " <input class=\"basket\" type=\"submit\" value=\"Add to Basket\" name=\"basket\" id=\"basket\">";
		}
		else
		{
			echo "<p>You must be logged in to add items to the basket.<br>
					 <a href=\"login.php\">Log In</a></p>";
		}
	}
	
	//The following functions are used in the login.php page.
	
	function displayLoginError() //This function displays an error message if the users enters incorrect email or password information.
	{
		if(isset($_SESSION['login_error'])) //checks if the login_error session variable has been set by the checklogin.php page.
		{
			echo "<font color='red'>".$_SESSION['login_error']."</font>";
			$_SESSION['login_error']="";
		}
	}
	
	function displayRegisterError() //This function displays an error message if the user tries to register an email address that already exists on the customer database.
	{
		if(isset($_SESSION['register_error'])) //checks if the login_error session variable has been set by the register.php page.
		{
			echo "<font color='red'>".$_SESSION['register_error']."</font>";
			$_SESSION['register_error']="";
		}
	}
	
	
	
?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	