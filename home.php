<!-- The <!DOCTYPE> declaration is not an HTML tag; 
it is an instruction to the web browser about what version of HTML the page is written in. -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Friendz Chat - Home</title>		<!-- Title of the Home page -->
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></Script>
		<script src="hide.js"></script>
		<script>
			function getChat(user){
    			var user_number=user;
				var msg=form2.msg.value;

				//Update a web page without reloading the page
	   			//Request data from a server after the page has loaded
   				//Receive data from a server after the page has loaded
				var xmlhttp=new XMLHttpRequest();
		
				//The onreadystatechange event is triggered every time the readyState changes.
    			//The readyState property holds the status of the XMLHttpRequest.
				xmlhttp.onreadystatechange=function(){

					//4: request finished and response is ready
					//200: "OK"
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						document.getElementById('chatlogs').innerHTML=xmlhttp.responseText;
					}
				}	

				//Specifies the type of request, the URL, and if the request should be 
				//handled asynchronously or not.
				xmlhttp.open('GET', 'insert.php?user_number='+user_number,true);

	    		//Sends the request off to the server.
				xmlhttp.send();	
			}
		</script>

		<script>
			function submitChat(){
	    		var msg=form2.msg.value;
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function(){
					if(xmlhttp.readyState==4 && xmlhttp.status==200){
						document.getElementById('chatlogs').innerHTML=xmlhttp.responseText;
					}
				}
				xmlhttp.open('GET', 'insert_record.php?msg='+msg,true);
				xmlhttp.send();
				form2.msg.value="";
				$(document).ready(function(){
        			$.ajaxSetup({cache:true});
	        		//The setInterval() method calls a function 
    	    		//or evaluates an expression at specified intervals (in milliseconds).
					setInterval(function(){$('#chatlogs').load('logs.php');}, 1000);		
				});
		
			}
		</script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div class="top_tab">
			<div class="logout">
				<a href="logout.php">Logout</a>
			</div>
			
			<div class="welcome">Welcome to Friendz Chat</div>
		</div>
		
		<form name=form2>
		
		<div class="chat_box">
			<div class="chat_head">Online Friends </div>
		
		<div class="chat_body">
			<div class="user">
<?php 
			   	session_start();
   				error_reporting(0);
   				$user_fname=$_SESSION['User_fname'];
   				$user_lname=$_SESSION['User_lname'];
   				$name_of_user=$_SESSION['name_of_user'];
   				$online="online";
   
   				$con=mysqli_connect("localhost","root","root","chat");		// Connect to the database
   				if(!$con){
				   	die("Connection Failed!!!".mysqli_connect_error());		// If the database connection fails
				}

   				$result2=mysqli_query($con,"SELECT * FROM login_details WHERE firstName='$user_fname'");
   				while($row2=mysqli_fetch_array($result2)){
   					$user_id=$row2['id'];
    				$_SESSION['user_id']=$user_id; 	
   				}
   				$id=$_SESSION['user_id'];
   				$result3=mysqli_query($con,"UPDATE login_details SET status='$online' WHERE id='$id'");		// Insert new column record (status) in login_details table
   				$result=mysqli_query($con,"SELECT * FROM login_details WHERE status='$online' AND id!='$id'");
?>
<?php 
   				while($row=mysqli_fetch_array($result)){
   				   	$first_name=$row['firstName'];
   					$last_name=$row['lastName'];
   					$username=$row['username'];
   					$unique=$row['id'];
?>  	
					 <table>
				 		<tr>
				 			<td><div id="<?php echo $unique;?>"><?php echo $username;?></div></td>
				 		</tr>
				 	</table>  
<?php 
				}
?>
				<script>
				$(document).ready(function(){
<?php
					for ($i=1;$i<=$unique;$i++){
?>
						$('#<?php echo $i; ?>').click(function(){
		
							$('.msg_wrap').show();
							$('.msg_box').show();
        					display(<?php echo $i; ?>);
		
						});
			<?php   }  ?>
				});
				</script>
				
				<script>
					function display(user){
						//	document.getElementById("msg_head").innerHTML=user;
						//	alert(user);
    					getChat(user);
					}
				</script>
<?php 
				mysqli_close($con);
?>
			</div>
		</div>
	</div>
	
		<div class="msg_box">
			<div id="msg_head">Message Box
				<div class="close">x</div>
			</div>
			
			<div class="msg_wrap">
				<div class="msg_body">
					<div id="chatlogs"></div>
				</div>
				
				<div class="msf_footer">
					<textarea rows ="3" class="input_msg" name="msg"></textarea>
				</div>
	
				<div class="send">
					<button type="button" class="button" onclick="submitChat()">Send</button>
				</div>
			</div>
		</div>

		<div class="bottom_tab"></div>
		</form>
	</body>

	<div class="logged_user">
		<?php echo $name_of_user."'s Home";
		?>
	</div>
</html>


