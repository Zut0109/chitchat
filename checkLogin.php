<?php
session_start();
include("connection.php");
include("class/user.php");
$user=new user;

	$mail = $_REQUEST['inputEmail'];
	$pass = $_REQUEST['inputPassword'];
	echo $mail;
	$p=$user->getbymail($mail);
    $dem = mysqli_num_rows($p);
    if($dem == 0)
    {
		echo "
							<script language='javascript'>
								alert('Accout doesn't exist');
							</script>
						";
		header('location: index.php');
    }
    else
    {
        $sql_check2 = mysqli_query($link, "SELECT * FROM user WHERE mail = '$mail' AND pass = '$pass'");
        $dem2 = mysqli_num_rows($sql_check2);
        if($dem2 == 0)
		{
			echo "
							<script language='javascript'>
								alert('Wrong password');
							</script>
						";
			header('location: index.php');
		}
        else
        {
            $row = mysqli_fetch_array($sql_check2);
			$_SESSION['name']=$row['name'];
			$_SESSION['avt']=$row['avatar'];
			$_SESSION['mail']=$row['mail'];
			$login=$user->online($_SESSION['mail']);
			echo "
							<script language='javascript'>
								alert('Log in suscesfully');
							</script>
						";
				header('location: homepre.php');
                
            }
        }
?>