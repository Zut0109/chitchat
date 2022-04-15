<?php
include("connection.php");
include("class/user.php");
$p= new user;
    $name = $_REQUEST['inputName'];
	$mail = $_REQUEST['inputEmail'];
	$pass = $_REQUEST['inputPassword'];
	echo $name;
	echo $mail;
	echo $pass;
	$sql = mysqli_query($link, "SELECT * FROM user");
	$userid = mysqli_num_rows($sql) +1;
	echo $userid;
	$addfriend=$p->add($userid,$name,$mail,$pass);
	$sql1 = mysqli_query($link, "SELECT * FROM user");
	$dem1 = mysqli_num_rows($sql1);
	if($dem1 == $userid)
    {
		echo "
							<script language='javascript'>
								alert('Đăng kí thành công');
							</script>
						";
		$sql2 = mysqli_query($link, "SELECT * FROM chatfriend");
		$dem2 = mysqli_num_rows($sql2);
		$addadmin=$p->addfriendadmin($dem2+1,$mail);
		echo "Đăng kí thành công";
		
		header('Location: index.php');
    }
	else echo "Đăng kí thất bại";
?>