<?php
include("class/user.php");
session_start();
require __DIR__ . '/vendor/autoload.php';
if(!isset($_SESSION['mail']))
{
	header('location:index.php');
}
$user= new user;

$friend= $user->findfriend($_SESSION['mail']);

echo $_SESSION['mail'];

while($row = $friend->fetch_assoc()) {
	$_SESSION['namefr']=$row['name'];
	$_SESSION['mailfr']=$row['mail'];
	$_SESSION['avtfr']=$row['avatar'];
	$_SESSION['onlfr']=$row['online'];
}
require('database/ChatUser.php');

require('database/chatroom.php');

$chat_object = new ChatRooms;

$chat_data = $chat_object->get_all_chat_data();

$chatrow = new user;

$row= $chatrow->getAllChat();

$demrow = mysqli_num_rows($row);

$_SESSION['rowchat']=$demrow +1;

$user_object = new ChatUser;

$user_data = $user_object->get_user_all_data();

?>
<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8">
		<title>Chitchat – The Simplest Chat Platform</title>
		<meta name="description" content="#">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap core CSS -->
		<link href="dist/css/lib/bootstrap.min.css" type="text/css" rel="stylesheet">
		<!-- Swipe core CSS -->
		<link href="dist/css/swipe.min.css" type="text/css" rel="stylesheet">
		<!-- Favicon -->
		<link href="dist/img/favicon.png" type="image/png" rel="icon">
		<!-- Bootstrap core JavaScript -->
	</head>
	<body>
		<main>
			<div class="layout">
				<!-- Start of Navigation -->
				<div class="navigation">
					<div class="container">
						<div class="inside">
							<div class="nav nav-tab menu">
								<p id='usermail' class="d-none"> <?=$_SESSION['mail']?> </p>
								<button class="btn"><img class="avatar-xl" src="<?php echo$_SESSION['avt'];?>" alt="avatar"></button>
								<a href="#members" data-toggle="tab"><i class="material-icons">account_circle</i></a>
								<a href="#settings" data-toggle="tab"><i class="material-icons">settings</i></a>
								<a href="logout.php?usermail=<?=$_SESSION['mail']?>" class="btn power"><i class="material-icons">power_settings_new</i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Navigation -->
				<!-- Start of Sidebar -->
				<div class="sidebar" id="sidebar">
					<div class="container">
						<div class="col-md-12">
							<div class="tab-content">
								<!-- Start of Contacts -->
								<div class="search">
										<form class="form-inline position-relative">
											<input type="search" class="form-control" id="people" name="people" placeholder="Search for people...">
											<button type="button" class="btn btn-link loop"><i class="material-icons">search</i></button>
										</form>
										<button class="btn create" data-toggle="modal" data-target="#exampleModalCenter"><i class="material-icons">person_add</i></button>
									</div>
								<?php 
								$user= new user;
								$friend= $user->findfriend($_SESSION['mail']);
								?>
								<div class="tab-pane fade show active" id="members">				
									<div class="contacts">
										<h1>Contacts</h1>
										<div class="list-group" id="contacts" role="tablist">
										<?php
										while($row = $friend->fetch_assoc()) {
												$namefr=$row['name'];
												$mailfr=$row['mail'];
												$avtfr=$row['avatar'];
												$onlinestatus=$row['online'];
												if ($onlinestatus == 1) {
												?>
												<a href="home.php?friendmail=<?php echo $mailfr?>&friendname=<?php echo $namefr?>&friendavt=<?php echo $avtfr?>&friendonl=<?php echo $onlinestatus?>" class="filterMembers all online contact">
												<img class="avatar-md" src="<?php echo $avtfr?>" data-toggle="tooltip" data-placement="top" title="<?php echo $namefr?>" alt="avatar">
												<div class="status">
													<i class="material-icons online">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5><?php echo $namefr?></h5>
													<p><?php echo $mailfr?></p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
												</a>
												<?php } 
												else {?>
												<a href="home.php?friendmail=<?php echo $mailfr?>&friendname=<?php echo $namefr?>&friendavt=<?php echo $avtfr?>&friendonl=<?php echo $onlinestatus?>" class="filterMembers all offline contact">
												<img class="avatar-md" src="<?php echo $avtfr?>" data-toggle="tooltip" data-placement="top" title="<?php echo $namefr?>" alt="avatar">
												<div class="status">
													<i class="material-icons offline">fiber_manual_record</i>
												</div>
												<div class="data">
													<h5><?php echo $namefr?></h5>
													<p><?php echo $mailfr?></p>
												</div>
												<div class="person-add">
													<i class="material-icons">person</i>
												</div>
												</a>
												<?php } 
										}
												?>
										</div>
										<a href="friendadd.php"><i class="material-icons">person_add</i></a>
									</div>
								</div>
								<!-- End of Contacts -->
								<!-- Start of setting -->
								<div class="tab-pane fade" id="settings">			
									<div class="settings">
										<div class="profile">
											<img class="avatar-xl" src="<?php echo $_SESSION['avt']?>" alt="avatar">
											<h1><a href="#"><?php echo $_SESSION['name']?></a></h1>
										</div>
										<div class="categories" id="accordionSettings">
											<h1>Settings</h1>
											<!-- Start of My Account -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													<i class="material-icons md-30 online">person_outline</i>
													<div class="data">
														<h5>My Account</h5>
														<p>Update your profile details</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<php>
												<div class="collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionSettings">
													<div class="content">
														<div class="upload">
															<div class="data">
																<img class="avatar-xl" src="<?php echo $_SESSION['avt']?>" alt="image">
																<label>
																	<input type="file">
																	<span class="btn button">Upload avatar</span>
																</label>
															</div>
															<p>For best results, use an image at least 256px by 256px in either .jpg or .png format!</p>
														</div>
														<form>
															<div class="parent">
																<div class="field">
																	<label for="firstName">First name <span>*</span></label>
																	<input type="text" class="form-control" id="firstName" placeholder="First name" value="Michael" required>
																</div>
																<div class="field">
																	<label for="lastName">Last name <span>*</span></label>
																	<input type="text" class="form-control" id="lastName" placeholder="Last name" value="Knudsen" required>
																</div>
															</div>
															<div class="field">
																<label for="email">Email <span>*</span></label>
																<input type="email" class="form-control" id="email" placeholder="Enter your email address" value="michael@gmail.com" required>
															</div>
															<div class="field">
																<label for="password">Password</label>
																<input type="password" class="form-control" id="password" placeholder="Enter a new password" value="password" required>
															</div>
															<div class="field">
																<label for="location">Location</label>
																<input type="text" class="form-control" id="location" placeholder="Enter your location" value="Helena, Montana" required>
															</div>
															<button class="btn btn-link w-100">Delete Account</button>
															<button type="submit" class="btn button w-100">Apply</button>
														</form>
													</div>
												</div>
											</div>
											<!-- End of My Account -->
											<!-- Start of Chat History -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
													<i class="material-icons md-30 online">mail_outline</i>
													<div class="data">
														<h5>Chats</h5>
														<p>Check your chat history</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionSettings">
													<div class="content layer">
														<div class="history">
															<p>When you clear your conversation history, the messages will be deleted from your own device.</p>
															<p>The messages won't be deleted or cleared on the devices of the people you chatted with.</p>
															<div class="custom-control custom-checkbox">
																<input type="checkbox" class="custom-control-input" id="same-address">
																<label class="custom-control-label" for="same-address">Hide will remove your chat history from the recent list.</label>
															</div>
															<div class="custom-control custom-checkbox">
																<input type="checkbox" class="custom-control-input" id="save-info">
																<label class="custom-control-label" for="save-info">Delete will remove your chat history from the device.</label>
															</div>
															<button type="submit" class="btn button w-100">Clear blah-blah</button>
														</div>
													</div>
												</div>
											</div>
											<!-- End of Chat History -->
											<!-- Start of Notifications Settings -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
													<i class="material-icons md-30 online">notifications_none</i>
													<div class="data">
														<h5>Notifications</h5>
														<p>Turn notifications on or off</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionSettings">
													<div class="content no-layer">
														<div class="set">
															<div class="details">
																<h5>Desktop Notifications</h5>
																<p>You can set up Swipe to receive notifications when you have new messages.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Unread Message Badge</h5>
																<p>If enabled shows a red badge on the Swipe app icon when you have unread messages.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Taskbar Flashing</h5>
																<p>Flashes the Swipe app on mobile in your taskbar when you have new notifications.</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Notification Sound</h5>
																<p>Set the app to alert you via notification sound when you have unread messages.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Vibrate</h5>
																<p>Vibrate when receiving new messages (Ensure system vibration is also enabled).</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Turn On Lights</h5>
																<p>When someone send you a text message you will receive alert via notification light.</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>
													</div>
												</div>
											</div>
											<!-- End of Notifications Settings -->
											<!-- Start of Connections -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
													<i class="material-icons md-30 online">sync</i>
													<div class="data">
														<h5>Connections</h5>
														<p>Sync your social accounts</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseFour" aria-labelledby="headingFour" data-parent="#accordionSettings">
													<div class="content">
														<div class="app">
															<img src="dist/img/integrations/slack.svg" alt="app">
															<div class="permissions">
																<h5>Skrill</h5>
																<p>Read, Write, Comment</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="app">
															<img src="dist/img/integrations/dropbox.svg" alt="app">
															<div class="permissions">
																<h5>Dropbox</h5>
																<p>Read, Write, Upload</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="app">
															<img src="dist/img/integrations/drive.svg" alt="app">
															<div class="permissions">
																<h5>Google Drive</h5>
																<p>No permissions set</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>
														<div class="app">
															<img src="dist/img/integrations/trello.svg" alt="app">
															<div class="permissions">
																<h5>Trello</h5>
																<p>No permissions set</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>
													</div>
												</div>
											</div>
											<!-- End of Connections -->
											<!-- Start of Appearance Settings -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
													<i class="material-icons md-30 online">colorize</i>
													<div class="data">
														<h5>Appearance</h5>
														<p>Customize the look of Swipe</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseFive" aria-labelledby="headingFive" data-parent="#accordionSettings">
													<div class="content no-layer">
														<div class="set">
															<div class="details">
																<h5>Turn Off Lights</h5>
																<p>The dark mode is applied to core areas of the app that are normally displayed as light.</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round mode"></span>
															</label>
														</div>
													</div>
												</div>
											</div>
											<!-- End of Appearance Settings -->
											<!-- Start of Language -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
													<i class="material-icons md-30 online">language</i>
													<div class="data">
														<h5>Language</h5>
														<p>Select preferred language</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseSix" aria-labelledby="headingSix" data-parent="#accordionSettings">
													<div class="content layer">
														<div class="language">
															<label for="country">Language</label>
															<select class="custom-select" id="country" required>
																<option value="">Select an language...</option>
																<option>English, UK</option>
																<option>English, US</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<!-- End of Language -->
											<!-- Start of Privacy & Safety -->
											<div class="category">
												<a href="#" class="title collapsed" id="headingSeven" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
													<i class="material-icons md-30 online">lock_outline</i>
													<div class="data">
														<h5>Privacy & Safety</h5>
														<p>Control your privacy settings</p>
													</div>
													<i class="material-icons">keyboard_arrow_right</i>
												</a>
												<div class="collapse" id="collapseSeven" aria-labelledby="headingSeven" data-parent="#accordionSettings">
													<div class="content no-layer">
														<div class="set">
															<div class="details">
																<h5>Keep Me Safe</h5>
																<p>Automatically scan and delete direct messages you receive from everyone that contain explict content.</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>My Friends Are Nice</h5>
																<p>If enabled scans direct messages from everyone unless they are listed as your friend.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Everyone can add me</h5>
																<p>If enabled anyone in or out your friends of friends list can send you a friend request.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Friends of Friends</h5>
																<p>Only your friends or your mutual friends will be able to send you a friend reuqest.</p>
															</div>
															<label class="switch">
																<input type="checkbox" checked>
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Data to Improve</h5>
																<p>This settings allows us to use and process information for analytical purposes.</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>
														<div class="set">
															<div class="details">
																<h5>Data to Customize</h5>
																<p>This settings allows us to use your information to customize Swipe for you.</p>
															</div>
															<label class="switch">
																<input type="checkbox">
																<span class="slider round"></span>
															</label>
														</div>
													</div>
												</div>
											</div>
											<!-- End of Privacy & Safety -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Sidebar -->
				<!-- Start of Add Friends -->
				<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="requests">
							<div class="title">
								<h1>Add your friends</h1>
								<button type="button" class="btn" data-dismiss="modal" aria-label="Close"><i class="material-icons">close</i></button>
							</div>
							<div class="content">
								<form action="addfriend.php" method="post">
									<div class="form-group">
										<label for="user">Mail:</label> 
										<input type="text" class="form-control" name="mail" id="mail" placeholder="yuri@gmail.com" required>
									</div>
									<div class="form-group">
										<label for="welcome">Message:</label>
										<textarea class="text-control" name="welcome" id="welcome" placeholder="Send your welcome message...">Hi, Id like to add you as a contact.</textarea>
									</div>
									<button type="submit" class="btn button w-100">Send Friend Request</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Add Friends -->
				<!-- Start of Add Friends log -->
				<?php
				$checkaddfriend = 0;
				if (isset($_REQUEST['addfriend'])){
					$checkaddfriend= $_REQUEST['addfriend'];
				}
				if ($checkaddfriend == 1){
				?>
				<div class="modal fade show" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<p> Make friends successfully</p>
					</div>
				</div>
				<?php }
				else if ($checkaddfriend == 2) {?>
				<div class="modal fade show" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<p> Already added this friend </p>
					</div>
				</div>
				<?php }
				else {
				?>
				<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<p> Already added this friend </p>
					</div>
				</div>
				<?php
				}
				?>
				<!-- End of Add Friends log-->
				<div class="main">
					<div class="tab-content" id="nav-tabContent">
					    <?php 
						
						?>
						<!-- Start of Babble -->
						<div class="babble tab-pane fade active show" id="list-chat" role="tabpanel" aria-labelledby="list-chat-list">
							<!-- Start of Chat -->
							<div class="chat" id="chat1">
								<div class="top">
									<div class="container">
										<div class="col-md-12">
											<div class="inside">
												<a href="#"><img class="avatar-md" src="<?php echo $_SESSION['avtfr']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $_SESSION['namefr']?>" alt="avatar"></a>
												<div class="status">
													<?php if ($_SESSION['onlfr'] == 1){
													?>
													<i class="material-icons online">fiber_manual_record</i>
													<?php }
													else {
														?>
														<i class="material-icons offline">fiber_manual_record</i>
														<?php
													}
													?>
												</div>
												<div class="data">
													<h5><a href="#"><?php echo $_SESSION['namefr']?></a></h5>
													<?php 
													if ($_SESSION['onlfr']==1) {
													?>
													<span>Active now</span>
													<?php }
													else{
														?>
													<span>Offline</span>
													<?php
													}
													?>
												</div>
												<button class="btn d-md-block d-none"><i class="material-icons md-30">info</i></button>
												<div class="dropdown">
													<button class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons md-30">more_vert</i></button>
													<div class="dropdown-menu dropdown-menu-right">
														<hr>
														<button class="dropdown-item"><i class="material-icons">clear</i>Clear History</button>
														<button class="dropdown-item"><i class="material-icons">block</i>Block Contact</button>
														<button class="dropdown-item"><i class="material-icons">delete</i>Delete Contact</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="content" id="content">
									<div class="container">
										<?php
										$textmail= new user;
										$getmail= $textmail->getmessage($_SESSION['mail'],$_SESSION['mailfr']);
										?>
										<div id="message_area" class="col-md-12">
										<?php
										while($row = $getmail->fetch_assoc()) {
												$namesend=$row['sendmail'];
												$text=$row['sendtext'];
												$time=$row['timesend'];
												if ($namesend==$_SESSION['mail']){
												?>
												<div class="message me">
												<div class="text-main">
													<div class="text-group me">
														<div class="text me">
															<p><?php echo $text?></p>
														</div>
													</div>
													<span><?php echo $time?></span>
												</div>
											</div>
											<?php } 
											else {?>
											<div class="message">
													<img class="avatar-md" src="<?php echo $_SESSION['avtfr']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $_SESSION['namefr']?>" alt="avatar">
													<div class="text-main">
														<div class="text-group">
															<div class="text">
																<p><?php echo $text?></p>
															</div>
														</div>
														<span><?php echo $time?></span>
													</div>
												</div>
											<?php } 
										}
											?>
										</div>
									</div>
								</div>
								<div class="container">
									<div class="col-md-12">
										<div class="bottom">
											<form id="chat_form" name="chat_form" class="position-relative w-100" data-parsley-errors-container="#validation_error">
											<textarea class="form-control" id="chat_message" name="chat_message" placeholder="Type Message Here" data-parsley-maxlength="1000" data-parsley-pattern="/^[a-zA-Z0-9\s]+$/" required></textarea>												<button class="btn emoticons"><i class="material-icons">insert_emoticon</i></button>
												<button type="submit" class="btn send"><i class="material-icons">send</i></button>
												<div id="validation_error"></div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- End of Chat -->
						</div>
						<!-- End of Babble -->
						</div>
						<!-- End of Babble -->
					</div>
				</div>
			</div> <!-- Layout -->
		</main>
		<!-- Bootstrap/Swipe core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="vendor-front/jquery/jquery.js"></script>
		
		<!-- <script src="vendor-front/jquery/jquery.min.js"></script> -->

    	<script src="vendor-front/bootstrap/js/bootstrap.bundle.min.js"></script>

    	<!-- Core plugin JavaScript-->
    	<script src="vendor-front/jquery-easing/jquery.easing.min.js"></script>

    	<script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>

		<script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>
		<script>
			function scrollToBottom(el) { el.scrollTop = el.scrollHeight; }
			scrollToBottom(document.getElementById('content'));
		</script>
		<script type="text/javascript">
			var i=1;
			$(document).ready(function(){

				var conn = new WebSocket('ws://localhost:8080');
				conn.onopen = function(e) {
		    		console.log("Connection established!");
				};

				conn.onmessage = function(e) {
		    		console.log(e.data);

		    		var data = JSON.parse(e.data);

		    		var classtype = '';

		    		if(data.username == 'Me')
		    		{
						classtype = 'message me';
						name= '<?=$_SESSION['name']?>';
						mail= '<?=$_SESSION['mail']?>';
						avt= '<?=$_SESSION['avt']?>';
						var html_data = "<div id='newchat' class='"+classtype+"'><div class='text-main'><div class='text-group me'><div class='text me'><p>"+data.msg+"</p></div></div><span>"+data.dt+"</span></div></div>";
		    			
		    		}
		   			else 
		    		{
						
		    			classtype = 'message';
						name= '<?=$_SESSION['namefr']?>';
						mail= '<?=$_SESSION['mailfr']?>';
						avt= '<?=$_SESSION['avtfr']?>';
						var html_data = "<div id='newchat' class='"+classtype+"'><img class='avatar-md' src='"+avt+"' data-toggle='tooltip' data-placement='top' title='"+data.sendto+"'alt='avatar'><div class='text-main'><div class='text-group'><div class='text'><p>"+data.msg+"</p></div></div><span>"+data.dt+"</span></div></div>";
		    		}


		    		$('#message_area').append(html_data);

		    		$("#chat_message").val("");
				};
		

				$('#chat_form').submit(function(event){
				event.preventDefault();
				var chatnum = parseInt('<?=$_SESSION['rowchat']?>')+i;
				var user_name = '<?=$_SESSION['name']?>';
				var user_mail = '<?=$_SESSION['mail']?>';
				var send_to = '<?=$_SESSION['mailfr']?>';
				var message = $('#chat_message').val();
				console.log(chatnum);
				var data = {
					chatnumber : chatnum,
					usermail : user_mail,
					username : user_name,
					sendto : send_to,
					msg : message
				};
				conn.send(JSON.stringify(data));
				i++;
				});
			});	
</script>
	</body>


</html>