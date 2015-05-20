<?php
    include('header.php');
	
	 $rowID = $_GET["chosen_item"];
    $item = pg_query($dbconn, "SELECT * FROM product WHERE product_id = " . $rowID); //example

    $row = pg_fetch_row($item);
?>
        <div id="main_body">
            <div class="wrapper">
                <div class="row">
                    <!--  Product images, takes up 1/3 of width. -->
                    <div class="col_1_3">
                        <img class="product_image" src="<?php echo $row[6]; ?>">
                    </div><!-- Product details and description. Takes up 2/3 of width. -->
                    <div class="col_2_3 product_description">
                        <!-- Further divide product details into three colums -->
                        <h2 id="product_title">
                            <?php echo $row[1]; ?>
                        </h2>
                        
                        <!-- Change the pages title using JS immediately after the product_title has been loaded -->
                    <script type="text/javascript">
                        var title = document.getElementById("product_title").outerText; //Get product title
                        document.title = title + " | Shoes &amp; Footware for Sale"; //Set page title to match product
                    </script>
                        
                    <form method="POST">
                    <div class="row">
                        <div class="col_1_3">
                            <p>
                                <strong>Size:</strong> <select id="size" name="size">

                                    <script language="javascript" type="text/javascript"> 

                                        for(var d=3;d<=12;d++)
                                        {
                                         document.write("<option value='"+d+"'>"+d+" UK</option>");
                                        }

                                        /*var size = $('#size').find(":selected").text();
                                       window.location.href = "product.php?size="+size;*/
                                    </script>

                                </select>
                            </p>
                        </div>
                        <div class="col_1_3">
                            <p>
                                <strong>Quantity:</strong> <select id="quantity" name="quantity">

                                    <script language="javascript" type="text/javascript"> 

                                        for(var d=1;d<=<?php echo $row[5]; ?>;d++)
                                        {
                                         document.write("<option value='"+d+"'>"+d+"</option>");
                                        }
                                        /*var quantity = $('#quantity').find(":selected").text();
                                        window.location.href = "product.php?size="+quantity;*/
                                    </script>

                                </select>
                            </p>
                        </div>
                    </form>
                        <div class="col_1_3">
                            <?php displayLoginButton(); ?>
                            <?php

                                if (isset($_POST['basket']))
                                    { 
                                    $size = $_POST['size'];
                                    $quantity = $_POST['quantity'];
                                    $custid = $_SESSION['customer_id'];

                                    $query = "SELECT 1 FROM shopping_cart WHERE product_id='$rowID' AND customer_id = '$custid'";
                                    $rs = pg_query($dbconn, $query) or die ("Goofed up");
                                    $rownum = pg_num_rows($rs);

                                    if($rownum == 0)
                                    {
                                    pg_query($dbconn,"INSERT INTO shopping_cart VALUES('".$rowID."','".$size."','".$quantity."','".$custid."')");
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

                            ?> 

                        </div>
                        </div>
                        <p class="price" id="price">
                            <?php echo "€".$row[3]; ?>
                        </p>
                        <p id="item_description">
                            <?php echo $row[2]; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            include('footer.php');
        ?>