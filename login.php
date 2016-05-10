<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Friendz Chat - Log in</title>		<!-- Title of the page -->
		<link rel="stylesheet" type="text/css" href="style.css">		<!-- Linking style.css to include the design on login.php page -->
		<script src="hide.js"></script>			<!-- Including hide.js javascript file -->
	</head>
	
	<body>
		<form name="form3" action="login.php" method="post">		<!-- Creating a new form for login procedure of the application -->
			<div class="login_title">	
				<h2 align="center"><u>Friendz Chat</u></h2>			<!-- Application title on login page -->
				<h3 align="center">Login</h3>		
			</div>
		
			<div class="login_table">								<!-- Tabular format to accept username and password from the user -->
				<table align="center" border=1>
					<tr>
						<td>Username:</td>							<!-- Ask user to enter the username -->
						<td><input type="text" name="username"></td>	<!-- User will enter the username -->
					</tr>
				
					<tr>
						<td>Password:</td>							<!-- Ask user to enter the password -->
						<td><input type="password" name="password"></td>	<!-- User will enter the password -->
					</tr>
				
					<tr>
						<td><input type="submit" name="login" value="Login"></td>	<!-- User will press this Login button to log in to the application -->
					</tr>
				</table>
			</div>
		
			<div class="register">			<!-- For a new user visiting for the first time, application registration link -->
				<p align="center">Don't have an Account? Click <a href="register.php">here</a> to Register!! </p>
			</div>
		</form>
	</body>
</html>


<?php
	if(isset($_POST['login'])){
		$con=mysqli_connect("localhost","root","root","chat");		// Connect to the database
		if(!$con){
			die("Connection Failed!!!".mysqli_connect_error());		// If connection fails.
		}

		$username=$_POST['username'];
		$password=$_POST['password'];
	
		$result5=mysqli_query($con, "SELECT * FROM login_details WHERE username='$username' AND password='$password' ");	//Check if the username and password exists in the database table
		if(mysqli_num_rows($result5)==1){
			while($row5=mysqli_fetch_array($result5)){
				$fname=$row5['firstName'];
				$lname=$row5['lastName'];
			}
			session_start();			// If the username exists and password is correct then start the session for that particular user
			$_SESSION['name_of_user']=$username;
			$_SESSION['User_fname']=$fname;
			$_SESSION['User_lname']=$lname;
?>
			<br/>
			<script>window.location="home.php"</script>		<!-- Redirect the validated user to his/her homepage i.e. home.php -->
			<?php 	
		}	// end of if statement
		else{
			?> 
			<script>alert("Username or password does not match!!!");</script>		<!-- If validation fails then display appropriate message to the user -->
			<?php 
		}
    	mysqli_close($con);		// Close the database connection
	}
	
			?>	