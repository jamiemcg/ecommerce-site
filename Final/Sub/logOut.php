<?php 
/*
* This page logs the user out by destroying the session and the session variables.
*/

session_start();
session_destroy();

?>
<meta http-equiv="refresh" content="0;URL=../index.php" /> <!-- the user is returned to the home page.-->