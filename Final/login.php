<?php
    include('header.php'); //Uses the shared header file.
?>

<div id="main_body">
            <div class="wrapper">
                <!-- used to create a 2x1 grid -->
                <div class="row">
                    <div class="col_1_2">
                        <!-- the left column (left half) -->
						
                        <h2>
							
                            Login
                        </h2>
						<?php
							displayLoginError(); //Uses the displayLoginError function from the functions.php file
							?>
							<!-- Form where user enters their log in information -->
                        <form action="Sub/checkLogin.php" method="post">
                            <p>
                                Email:
                            </p><input required="" size="35" type="email" name="Email">
                            <p>
                                Password:
                            </p><input required="" size="35" type="password" name="Password"><br>
                            <br>
                            <input class="basket" type="submit" value="Login"><br>
                        </form>
                    </div>
                    <div class="col_1_2">
                        <!-- the right column (right half)-->
                        <h2>
                            Register
                        </h2>
						<?php
							displayRegisterError(); //Uses the displayRegisterError function from the functions.php file
						?>
						<!-- Form where user enters their information to create an account-->
                        <form action="Sub/register.php" method="post" onsubmit="return checkPassRegister()">
                            <p>
                                Name:
                            </p><input required="" size="35" type="text" name="name">
                            <p>
                                Contact Number:
                            </p><input required="" type="number" name="phone">
                            <p>
                                Address:
                            </p>
                            <textarea cols="28" required="" rows="5" name="address">
							</textarea>
                            <p>
                                Email:
                            </p><input required="" size="35" type="email" name="email">
                            <p>
                                Password:
                            </p><input id="password" onkeypress="resetColourPassword()" required="" size="35" type="password" name="password">
                            <p>
                                Confirm Password:
                            </p><input id="confirmPassword" onkeypress="resetColourConfirmPassword()" required="" size="35" type="password"><br>
                            <br>
                            <input class="basket" type="submit" value="Register"><br>
                        </form>
                    </div>
                </div>
            </div>
      </div>
<?php
    include('footer.php'); //Uses the shared footer file.
?>