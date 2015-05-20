 <?php
 session_start();

include_once 'connection.php';                               
			
			if (isset($_POST['basket']))
				{ 
				$prod_id = $_GET['Add']; 
				$size = $_POST['size'];
				$quantity = $_POST['quantity'];
				$custid = $_SESSION['customer_id'];
										
				$query = "SELECT 1 FROM shopping_cart WHERE product_id='$prod_id' AND customer_id = '$custid'";
				$rs = pg_query($dbconn, $query) or die ("Goofed up");
				$rownum = pg_num_rows($rs);
										
				if($rownum == 0)
				{
					pg_query($dbconn,"INSERT INTO shopping_cart VALUES('".$prod_id."','".$size."','".$quantity."','".$custid."')");
					$rs = pg_query($dbconn, $query) or die ("goofed");
				}
				else
				{	
					$query = pg_query($dbconn, "SELECT * FROM shopping_cart WHERE product_id = '$rowID' AND customer_id = '$custid'");
					$result = pg_fetch_row($query);
					$newq = $quantity + $result[2];
					$query = "UPDATE shopping_cart SET quantity = '$newq' WHERE product_id='$rowID' AND customer_id = '$custid'";
					$rs = pg_query($dbconn, $query) or die ("goofed");
				}
											
				}
		header("location:javascript://history.go(-1)");								
?> 