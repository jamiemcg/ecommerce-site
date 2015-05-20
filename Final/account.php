<!DOCTYPE html>
<?php
    include('header.php'); //Uses the shared header.php file.
?>

 <div id="main_body">
            <div class="wrapper">
                <!-- used to create a 2x1 grid -->
                <div class="row">
                    <div class="col_1_2">
                        <!-- the left column (left half) -->
                        <h2>
                            Account Information
                        </h2>
							<?php
								if(isset($_SESSION['user'])) //Checks if the user is logged in
								{
									$username = $_SESSION['user']; //Saves the session user name in an local variable
									
									// Search the customer table for information about the customer.
									$query = "SELECT * FROM customer WHERE name = '$username'"; 
									$rs = pg_query($dbconn, $query) or die("Goofed up");
									$row = pg_fetch_row($rs);
											
											// Display the information from the customer table.
											echo "<p>Name : ". $row[1] . "</p>";
											echo "<p>Email : ". $row[2] . "</p>";
											echo "<p>Password : ******</p>";
											echo "<p>Address: ". $row[4] . "</p>";
											echo "<p>Phone : ". $row[5] . "</p><br><br>";
											echo "<form action=\"editInformation.php\" method=\"post\">";
											echo "<input type=\"submit\" class=\"basket\"value=\"Edit Information\"></form>";
													
								}
								else
								{
									echo "Please Log in."; //The user is asked to login
								}
							?>
							
				  </form></p>
                    </div>
                    <div class="col_1_2">
                        <!-- the right column (right half)-->
                        <h2>
                            Order History
                        </h2>
						
							<?php
							
								if(isset($_SESSION['user'])) //Checks if the user is logged in.
								{
								
								$customer = $_SESSION['customer_id']; //Saves the session user name in an local variable.
						
								// Search the orders table for information about the associated with the logged in customer.
								$query = "SELECT * FROM Orders WHERE customer_id = ".$customer;
								$rs = pg_query($dbconn, $query) or die ("Goofed up");
								$row = pg_fetch_row($rs);
								
								if($row != 0) //Checks if the customer has any orders in the orders table.
								{
									//Display information about the customers order.
									echo "<p>Your order number is: ". $row[0] ."</p>";
									echo $row[2];
									echo "<p>Total : &euro;".$row[1]."</p>";
									echo "<form action=\"Sub/removeOrder.php\" method=\"post\">";
									echo "<button class=\"basket\" type=\"submit\" name=\"id\" value=\"".$customer."\">Close Order</button>";
									echo "</form>"; //Button redirects user to the edit information page sends their customer_id information using the post method.
									
								}
								else //If the user has no orders this message is displayed.
								{
									echo "<p>You have no orders in your order history</p>";
								}
								}
								
								else //If the user is not logged in a message is displayed.
								{
									echo "Please Log in."; 
								}

								?>
                        
							
                    </div>
                </div>
            </div>
		</div>

<?php
    include('footer.php');//Uses the shared footer file.
?>