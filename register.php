<html>
	<head>
		<title>Friendz Chat - Register</title>			<!-- Title of the registration page -->
		<link rel="stylesheet" type="text/css" href="style.css">		<!-- Including the style.css file in order to incorporate the design on this page -->
	</head>
	
	<body>
		<form name="form1" action="register.php" method="post">		<!-- A form for a new user to register to the application -->
			<div class="register_title">
				<h2 align="center"><u>Friendz Chat</u></h2>			<!-- Displaying the application name on registration page -->
				<h3 align="center">Register</h3>
			</div>
			
			<table align="center" border="2">
				<tr>
					<td>FirstName:</td>								<!-- Ask user to enter the first name -->
					<td><input type="text" name="firstname"></td>	<!-- User will enter the first name -->
				</tr>
			
				<tr>
					<td>LastName:</td>								<!-- Ask user to enter the last name -->
					<td><input type="text" name="lastname"></td>	<!-- User will enter the last name -->
				</tr>
			
				<tr>
					<td>Username:</td>								<!-- Ask user to enter the unique username -->
					<td><input type="text" name="username"></td>	<!-- User will enter the username -->
				</tr>

				<tr>
					<td>Password:</td>									<!-- Ask user to enter the password -->
					<td><input type="password" name="password"></td>	<!-- User will enter the password -->
				</tr>
			
				<tr>
					<td>Re-Enter Password:</td>							<!-- Ask user to re-enter the password -->
					<td><input type="password" name="password2"></td>	<!-- User will re-enter the same password as entered earlier -->
				</tr>
			
				<tr>
					<td><input type="submit" name="register" value="Register"></td>		<!-- User will press this button in order to submit the details and register to the Friendz Chat application -->
				</tr>
			</table>	
		</form>
	</body>
</html>

<?php
	if(isset($_POST['register'])){
		$con=mysqli_connect("localhost","root","root","chat");		// Connect to the database
		if(!$con){
			die("Connection Failed!!!".mysqli_connect_error());		// If connection to the database fails
		}

		$fname=$_POST['firstname'];
		$lname=$_POST['lastname'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
	
		if(empty($fname) || empty($lname) || empty($username) || empty($password) || empty($password2)){	// If any of the fields are empty, display appropriate message to the user
?>
			<script>alert("Enter all the fields.");</script>
			<?php
		}

		else if($password!=$password2){		// If the re-entered password doesn't match the password entered earlier, display appropriate message to the user.
			?>
			<script>alert("Passwords do not match.");</script>
			<?php
		}
	
		else{				// Check whether any other user with same username already exists in the database. If yes, then tell user to enter some other username
			$exist=mysqli_query($con,"SELECT username FROM login_details WHERE username='$username'");
			if(mysqli_num_rows($exist)!=0){
			?>	
	      		<script>alert("Username already exists!!! Please enter another username.");</script>		
				<?php
			}
			else{			// Enter the valid user details in the login_details table in the database
        		$count=mysqli_query($con,"INSERT INTO login_details(firstName,lastName,username,password) VALUES('$fname','$lname','$username','$password')");
        		if($count!=0){
        		?>
        			<p align="center">You have sucessfully registered !!!<p>
        			<p align="center">Click <a href="login.php">here</a> to login.</p>		<!-- After successful user registration, display a link to login -->
                	<?php
        		}
        		if (false===$count){
        			printf("error: %s\n", mysqli_error($con));
        		}
        	}
		}
    	mysqli_close($con);		// Close the database connection
	}
					?>