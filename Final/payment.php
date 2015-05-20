<!DOCTYPE html>
<?php
    include('header.php');
?>

 <div id="main_body">
            <div class="wrapper">
                <!-- used to create a 2x1 grid -->
                <div class="row">
                    <div class="col_1_2">
                        <!-- the left column (left half) -->
                        <h2>
                            Shipping Information
                        </h2>
							<?php
								if(isset($_SESSION['user'])) //Checks if the user is logged in. 
								{
									$username = $_SESSION['user']; //Saves the customer user name as a local variable
									
									//Search the customer table for information about the user
									$query = "SELECT * FROM customer WHERE name = '$username'";
											$rs = pg_query($dbconn, $query) or die("Goofed up");
											$row = pg_fetch_row($rs);
											
											//Display the users name, address and phone number
											echo "<p>Name : ". $row[1] . "</p>";
											echo "<p>Address: ". $row[4] . "</p>";
											echo "<p>Phone : ". $row[5] . "</p><br><br>";
								}
								else //If the user is not logged in a message is displayed.
								{
									echo "Please Log in.";
								}
							?>
							
							<!-- Displays a form where the user can enter their payment information. -->
							<h2>Payment Information</h2>
							<form action="Sub/processOrder.php" method="post">
                            <p>
                                Card Holder Name:
                            </p><input required="" size="35" type="text" name="Name" value="Mr Exampleson">
                            <p>
                                Card Number:
                            </p><input required="" size="35" type="text" name="Number" value="123456789">
                            <p>
                                Expiry Date:
                            </p><input required="" size="35" type="date" name="Date" value="2014-02-09">
                            <p>
                                Security Code:
                            </p><input required="" size="35" type="text" name="Code" value="123">
							<br>
                            <p><input class="basket" type="submit" value="Pay Now"> with <font color="green"><b>Secure Pay</b> &#169;</font></p>
                        </form>
						<br><br><br><br><br><br>
						<?php include('footer.php'); ?>
                    </div>
                    <div class="col_1_2">
                        <!-- the right column (right half)-->
                        <h2>
                            Order Details:
                        </h2>
						
						<table>
							<th><p>Product</p></th><th><p>Quantity</p></th><th><p>Price</p></th>
						<?php
							$custid = $_SESSION['customer_id'];
				
							//Getting all items this specific user chose to add to their basket
							$q = pg_query($dbconn,"SELECT * FROM shopping_cart WHERE customer_id= '$custid' ORDER BY product_id"); 
				
							while($row = pg_fetch_array($q)){       //Loops through shopping_cart items
								// This will be used to grab the specific item details from the product table
								
							$product = pg_query($dbconn, "SELECT * FROM product WHERE product_id=".$row[0]); 
							$row2 = pg_fetch_array($product);       //This will loop through the Product array
							$id=$row[0]; 
							
							//Displays the itmes in the users basket
							echo "<tr>";
							echo "<td> <p>". $row2[1]."</p></td>";
							echo "<td> <p>". $row[2]."</p></td>";
							echo "<td> <p>&euro;". $row2[3]."</p></td>";
							
						 } 
							//Displays the total cost of the items.
							echo "<tr>";
							echo "<td> <p>Total</p></td>";
							echo "<td> <p></p></td>";
							echo "<td> <p>&euro;". $_SESSION['total']."</p></td>";
						?>
                        
							
                   </div>
               </div>
           </div>
	</div>
<footer>
            <!-- PHP footer is not positioning correctly. Replace later -->
            
        </footer>
        <!-- Placed just before closing body to improve performance -->
        <script src="js/main.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    </body>
</html>