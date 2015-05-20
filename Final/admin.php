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
                            User Profiles
                        </h2>
							<?php
									$query = "SELECT * FROM Customer ORDER BY customer_id";
									
									$rs = pg_query($dbconn, $query) or die ("Goofed up");
									
									echo '<table cellspacing="5">
											<tr><td>customer_id</td>
											<td>name</td>
											<td>email</td>
											<td>password</td>
											<td>address_1</td>
											<td>Phone</td></tr>';
											
									while ($row = pg_fetch_row($rs))
									{
									
										echo '<tr>'. 
										'<td>'.$row[0].'</td>
										<td>'.$row[1].'</td>
										<td>'.$row[2].'</td>
										<td>'.$row[3].'</td>
										<td>'.$row[4].'</td>
										<td>'.$row[5].'</td>';
										
										echo '</tr>';
											
									}
									echo '</table>';
									
									pg_close($dbconn);

?>       
		<br><br>
		<h2>Remove Order</h2>
         <p>Enter a customer ID to delete any data in the orders table associated with that customer.
					<form action="Sub/removeOrder.php" method="post">
						<input  type="text" name="adminID" value="customer id">
						<input class="basket" type="submit" value="Remove Order"><br>
				  </form></p>
		
		<h2>Remove Customer</h2>
         <p>Enter a customer ID to delete any data in the customer table associated with that customer. Also deletes data
			in the shopping_cart table associated with the customer.
					<form action="Sub/removeCustomer.php" method="post">
						<input  type="text" name="custid" value="customer id">
						<input class="basket" type="submit" value="Remove Customer"><br>
				  </form></p>
  
                    </div>
                    <div class="col_1_2">
                        <!-- the right column (right half)-->
                       <h2>
                            Add Product
                        </h2>
                        <form action="Sub/addProduct.php" method="post" onsubmit="return checkPassRegister()">
                            <p>
                                Name (Required):
                            </p><input required="" size="35" type="text" name="Name" value="Test Boot">
                            <p>
                                Description (Required):
                           </p>
                            <textarea cols="28"  required="" rows="5" name="Description" value="Test Boot. Black and Red">
							</textarea>
							<p>
                                Price (Required):
                            </p>
                          <input required="" size="35" type="number" name="Price" value="&euro;11">
                            <p>
                                Discounted Price:
							</p>
                            </p><input size="35" type="number" name="DiscountedPrice" value="&euro;11">
							<p>
                                Stock (Required):
							</p>
                            </p><input required="" size="35" type="number" name="Stock" value="10">
							<p>
                                Image (Required):
							</p>
                            </p><input required="" size="35" type="text" name="Image" value="img/test.jpg">
							<p>
                                Thumbnail:
							</p>
                            </p><input  size="35" type="text" name="Thumbnail" value="img/test.jpg">
							<p>
                                Category ID (Required) (1-8):
							</p>
                            </p><input required="" size="35" type="text" name="Category" value="1">
							<p>
                                Tags(Required):
							</p>
                            </p><input required="" size="35" type="text" name="Tags" value="Red, Black, Boot, Test">
                           <br>
                            
                            <input class="basket" type="submit" value="Add to DataBase"><br>
                        </form>
					</div>
                </div>
            </div>
		</div>

<?php
    include('footer.php');
?>