<?php
session_start();
$user_num=$_SESSION['user_no'];

$msg=$_REQUEST['msg'];

$user_id=$_SESSION['user_id'];

//$_SESSION['user_n']=$user_num;

$con=mysqli_connect("localhost","root","root","chat");
if(!$con){

	die("Connection Failed!!!".mysqli_connect_error());
}

mysqli_query($con, "INSERT INTO logs(user1_id,user2_id,message) VALUES('$user_id','$user_num','$msg') ");

/*$result3=mysqli_query($con, "SELECT * FROM logs WHERE user1_id='$user_id' AND user2_id='$user_num'");*/

//$result4=mysqli_query($con, "SELECT * FROM login_details WHERE id='$user_id' AND id='$user_num'");

/*
while($row4=mysqli_fetch_array($result4)){

	echo "<b>".$row4['firstName']."</b>".':';

}
*/

//$row4=mysqli_fetch_array($result4);
/*
while($row3=mysqli_fetch_array($result3)){

	
	echo $row3['message']. "<br>";
}
*/

mysqli_close($con);

?>