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
								if(isset($_SESSION['user'])) //Checks if the user is logged in.
								{
									$username = $_SESSION['user']; //Saves the user name as a local variable.
									
									//Searchs the customer table for the users information.
									$query = "SELECT * FROM customer WHERE name = '$username'";
									$rs = pg_query($dbconn, $query) or die("Goofed up");
									$row = pg_fetch_row($rs);
											
											//Displays the users information.
											echo "<p>Name : ". $row[1] . "</p>";
											echo "<p>Email : ". $row[2] . "</p>";
											echo "<p>Password</p> : ******";
											echo "<p>Address: ". $row[4] . "</p>";
											echo "<p>Phone : ". $row[5] . "</p><br><br>";
											
													
								}
								else //Displays message if the user is not logged in.
								{
									echo "Please Log in.";
								}
							?>
                    </div>
                    <div class="col_1_2">
                        <!-- the right column (right half)-->
                       <h2>
                            Edit Information
                        </h2>
						<!-- Form which takes in user input and sends it to the updateAccount.php file to update the user information in the customer table -->
                        <form action="Sub/updateAccount.php" method="post" onsubmit="return checkPassRegister()">
                            <p>
                                Name:
                            </p><input required="" size="35" type="text" value="<?php echo $row[1]; ?>" name="Name">
                            <p>
                                Contact Number:
                            </p><input required="" type="number" value="<?php echo $row[5]; ?>" name="Phone">
                            <p>
                                Address:
                            </p>
                            <textarea cols="28" required="" rows="5" type="text" value="<?php echo $row[4]; ?>" name="Address">
							</textarea>
                            <p>
                                Email:
                            </p><input required="" size="35" type="email" value="<?php echo $row[2]; ?>" name="Email">
                            <p>
                                Password:
                            </p><input id="password" onkeypress="resetColourPassword()" required="" size="35" type="password" value="<?php echo $row[3]; ?>" name="Password">
                            <p>
                                Confirm Password:
                            </p><input id="confirmPassword" onkeypress="resetColourConfirmPassword()" required="" size="35" type="password" value="<?php echo $row[3]; ?>"><br>
                            <br>
                            <input class="basket" type="submit" value="Confirm Change"><br>
                        </form>
					</div>
                </div>
            </div>
		</div>

<?php
    include('footer.php'); //Uses the shared footer.
?>