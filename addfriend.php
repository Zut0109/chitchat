<?php
session_start();
include("connection.php");

include("class/user.php");

$useradd= new user;

$addmail= $_REQUEST['mail'];

$mess= $_REQUEST['welcome'];

$time= date("d-m-Y h:i:s");

$check_friend= $useradd->checkfriend($_SESSION['mail'],$addmail);

$dem3 = mysqli_num_rows($check_friend);

if ($dem3 == 0){

    $sql_check = mysqli_query($link, "SELECT * FROM chatfriend");

    $dem = mysqli_num_rows($sql_check)+1;

    $add =$useradd->addfriend($dem,$_SESSION['mail'],$addmail);

    $sql_dem_tinnhan= mysqli_query($link, "SELECT * FROM tinnhan");

    $dem2 = mysqli_num_rows($sql_dem_tinnhan)+1;

    $addmess=$useradd->sendmessage($dem2,$_SESSION['mail'],$addmail,$time,$mess);

    echo $dem2;

    header('location: home.php?addfriend=1');
}
else {
    header('location: home.php?addfriend=2');
}



?>