<!DOCTYPE html>

<?php
session_start();

include 'Sub/functions.php';
?>
<html>

    <head>
        <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
        <link href="css/main.min.css" rel="stylesheet" type="text/css" title="main">
        <link href="css/alt.min.css" rel="stylesheet" type="text/css" title="alt">
        <meta charset="utf-8">
        <meta content="An outline outlet for buying shoes and footware" name="description">
        <title>
            Shoes | Shoes &amp; Footware for Sale
        </title>
        <link rel="icon" type="image/png" href="img/favicon.png">
        <!-- Icon made by freepik.com from flaticon.com and is licensed under CC 3.0 -->

    </head>
    <body onload="setStyle();">
        <header>
            <ul class="nav_list">
			<?php
               displayUser();
			   ?>
                <li class="nav_list_item">
                    <a href="contact.php">Contact</a>
                </li>
            </ul><a href="index.php">
            <h1 class="title">
                Shoes
            </h1></a>
            <div class="center_search">
                <form action="results.php" id="search_box" name="search_box" onsubmit="return checkSearchTerm()">
                    <input id="search"  name="search" placeholder="Search for an item" > 
                </form>
            </div><br>
            <!--================================================================================-->
            <div id="nava">
                <div id="nava_wrapper">
                    <ul>
                        <li>
                            <a href="category.php?cat=9">Mens</a>    <!-- ?cat=9 at the end of the link makes use of the GET method. -->
                            <ul>
                                <li>
                                   <a href="category.php?cat=1">Casual Shoes</a>
                                </li>
                                <li>
                                  <a href="category.php?cat=2">Dress Shoes</a>
                                </li>
                                <li>
                                    <a href="category.php?cat=3">Runners</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="category.php?cat=10">Womens</a>
                            <ul>
                                <li>
                                    <a href="category.php?cat=4">Casual Shoes</a>
                                </li>
                                <li>
                                    <a href="category.php?cat=5">Dress Shoes</a>
                                </li>
                                <li>
                                    <a href="category.php?cat=6">Runners</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="category.php?cat=11">Kids</a>
                            <ul>
                                <li>
                                    <a href="category.php?cat=7">Boys</a>
                                </li>
                                <li>
                                    <a href="category.php?cat=8">Girls</a>
                                </li>
                  
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!--================================================================================-->
            <hr>
        </header>