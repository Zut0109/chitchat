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
		<script src="vendor-front/jquery/jquery.js"></script>
		
		<!-- <script src="vendor-front/jquery/jquery.min.js"></script> -->

    	<script src="vendor-front/bootstrap/js/bootstrap.bundle.min.js"></script>

    	<!-- Core plugin JavaScript-->
    	<script src="vendor-front/jquery-easing/jquery.easing.min.js"></script>

    	<script type="text/javascript" src="vendor-front/parsley/dist/parsley.min.js"></script>
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
								<a href="home3.php" data-toggle="tab"><i class="material-icons">settings</i></a>
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
								<div class="list-group sort">
										<button class="btn filterMembersBtn active show" data-toggle="list" data-filter="all">All</button>
										<button class="btn filterMembersBtn" data-toggle="list" data-filter="online">Online</button>
										<button class="btn filterMembersBtn" data-toggle="list" data-filter="offline">Offline</button>
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
							</div>
						</div>
					</div>
				</div>
				<!-- End of Sidebar -->
				<!-- Start of Add Friends -->
				<?php 
					$user= new user;
					$alluser= $user->getAllUser();
					$ustestname= "Hoai2";
					$ustestmail= "yuri@gmail.com";
					$ustestavt= "images/avatar/Hoai2_avt.jpg";
					?>
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
										<input type="text" class="form-control" name="user" id="user" placeholder="yuri@gmail.com" required>
									</div>
									<div class="form-group">
										<label for="welcome">Message:</label>
										<textarea class="text-control" name="welcome" id="welcome" placeholder="Send your welcome message...">Hi <?php echo $ustestname?>, I'd like to add you as a contact.</textarea>
									</div>
									<button type="submit" class="btn button w-100">Send Friend Request</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Add Friends -->
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
						var html_data = "<div id='newchat' class='"+classtype+"'><img class='avatar-md' src='"+avt+"' data-toggle='tooltip' data-placement='top' title='"+data.sendto+"'alt='avatar'><div class='text-main'><div class='text-group'><div class='text'><p>"+data.msg+"</p></div></div><span>"+data.dt+"/span></div></div>";
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