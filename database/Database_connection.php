<?php

//Database_connection.php

class Database_connection
{
	function connect()
	{
		$connect = new PDO("mysql:host=us-cdbr-east-05.cleardb.net; dbname=heroku_15432f44b19325e", "b879315a711615", "a9caf152");
		return $connect;
	}
}

?>