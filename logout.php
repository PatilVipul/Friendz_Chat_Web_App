<?php
	session_start();
	$uid=$_SESSION['user_id'];
	$offline="offline";

	$con=mysqli_connect("localhost","root","root","chat");
	if(!$con){	
		die("Connection Failed!!!".mysqli_connect_error());
	}

	$result4=mysqli_query($con,"UPDATE login_details SET status='$offline' WHERE id='$uid'");

	mysqli_close($con);

	echo "You have logged out !!!";

	echo " Click "?><a href="login.php">here</a><?php echo " to login again...";
?>

<html>
	<head>
		<title>Friendz Chat - Logged out</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
</html>