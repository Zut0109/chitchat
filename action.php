<?php

//action.php

session_start();

if(isset($_POST['action']) && $_POST['action'] == 'leave')
{
	require('database/ChatUser.php');

	$user_object = new ChatUser;

	$user_object->setUserName($_POST['usermail']);

	$user_object->setOnline('Logout');

	if($user_object->update_user_login_data())
	{

		session_destroy();

		echo json_encode(['status'=>1]);
	}
}


?>