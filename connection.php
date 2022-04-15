<?php
	$link=mysqli_connect("us-cdbr-east-05.cleardb.net","b879315a711615","a9caf152") or die("Cannot connect to the localhost");
	mysqli_select_db($link ,"heroku_15432f44b19325e") or die("Cannot connect to the database");
	mysqli_query($link, "SET NAMES 'UTF8'");
?>