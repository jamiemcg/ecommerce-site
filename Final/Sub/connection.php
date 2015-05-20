
<?php
/*
* This page stores the connection details and connects to the cs230 database.
*/

$dbconn = pg_connect("host=webcourse.cs.nuim.ie dbname=cs230 user=cs230teamc8  password=AmaepieX")
OR die('Could Not Connect');

?>