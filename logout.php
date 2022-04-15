<?php
session_start();
require('database/ChatUser.php');

require('database/chatroom.php');

include("connection.php");

include("class/user.php");

$user_object = new ChatUser;

$user_object->setUserEmail($_SESSION['mail']);

$status= 0;

$user_object->setOnline($status);

if($user_object->update_user_login_data())
{
    session_destroy();

    header('location: index.php');
};


?>