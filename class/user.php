<?php
class user
{
	function getbymail($usermail)
	{
		include("connection.php");
		$sql="SELECT * FROM user WHERE '$usermail' = mail";
		$query=mysqli_query($link, $sql);
		return $query;
	}
	function getAllUser()
	{
		$conn = new mysqli("us-cdbr-east-05.cleardb.net","b879315a711615","a9caf152","heroku_15432f44b19325e");
		$result = $conn->query("SELECT * FROM user");
    	if ($result->num_rows > 0) 
        	return $result;
    	else return false;
	}
	function getAllChat()
	{
		$conn = new mysqli("us-cdbr-east-05.cleardb.net","b879315a711615","a9caf152","heroku_15432f44b19325e");
		$result = $conn->query("SELECT * FROM tinnhan");
    	if ($result->num_rows > 0) 
        	return $result;
    	else return false;
	}
	function findfriend($mail)
	{
		$conn = new mysqli("us-cdbr-east-05.cleardb.net","b879315a711615","a9caf152","heroku_15432f44b19325e");
		$result = $conn->query("SELECT * FROM chatfriend as cf INNER JOIN user us on cf.friend= us.mail WHERE '$mail' = cf.me");
    	if ($result->num_rows > 0) 
        	return $result;
    	else return false;
	}
    function online($mail)
	{
		include("connection.php");
		$sql="UPDATE user SET online = 1 WHERE '$mail' = mail";
		$query=mysqli_query($link, $sql);
		return $query;
	}
	function addfriend($number,$mail1,$mail2)
	{
		include("connection.php");
		$sql1="INSERT INTO chatfriend(no, me, friend) VALUE ($number,'$mail1','$mail2')";
		$sql2="INSERT INTO chatfriend(no, me, friend) VALUE ($number+1,'$mail2','$mail1')";
		$query=mysqli_query($link, $sql1);
		$query=mysqli_query($link, $sql2);
		return $query;
	}
	function sendmessage($number,$mail1,$mail2,$time,$text)
	{
		include("connection.php");
		$sql2="INSERT INTO tinnhan(no, sendmail, sendtext, getmail, timesend) VALUE ($number,'$mail1','$text','$mail2','$time')";
		$query2=mysqli_query($link, $sql2);
		return $query2;
	}
	function getmessage($mail1,$mail2)
	{
		include("connection.php");
		$sql2="SELECT * FROM tinnhan WHERE ('$mail1'= sendmail and '$mail2'= getmail) or ('$mail1'= getmail and '$mail2'= sendmail)";
		$query2=mysqli_query($link, $sql2);
		return $query2;
	}
	function checkfriend($mail1,$mail2)
	{
		include("connection.php");
		$sql2="SELECT * FROM chatfriend WHERE ('$mail1'= me and '$mail2'= friend) or ('$mail1'= friend and '$mail2'= me)";
		$query2=mysqli_query($link, $sql2);
		return $query2;
	}
	function add($number,$name,$mail,$pass)
	{
		include("connection.php");
		$sql2="INSERT INTO user(no, name, mail, pass, avatar) VALUE ($number, '$name', '$mail', '$pass', 'images/avatar/Defaut.jpg')";
		$query2=mysqli_query($link, $sql2);
		return $query2;
	}
	function addfriendadmin($number,$mail)
	{
		include("connection.php");
		$sql1="INSERT INTO chatfriend(no, me, friend) VALUE ($number, '$mail', 'admin@chitchat.com')";
		$sql2="INSERT INTO chatfriend(no, me, friend) VALUE ($number+1, 'admin@chitchat.com', '$mail')";
		$query=mysqli_query($link, $sql1);
		$query=mysqli_query($link, $sql2);
		return $query;
	}
}
?>