<?php
session_start();
if(isset($_POST['submit']))
 {
	$user_id ="";
	$servername = "localhost";
	$username = "root";
	$dbpassword = "";
	$dbname = "Socio";

	$conn = new mysqli($servername, $username, $dbpassword, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$userid=$_POST['email'];
	$sql = "SELECT email FROM user WHERE email='".$userid."'";
	$result = mysqli_query($conn,$sql)or die(mysqli_error($conn));
    $num_row = mysqli_num_rows($result);
    if( $num_row ==1 )
     {
     	$_SESSION['email']=$userid;
         header("Location: newpassword.php");
         exit;
     }
     else
     {
     	$msg= "Invalid username";
     }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Socio-Reset Password</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
body{
	height: 650px;
	width: 100%;
	margin: 0px;
	background-color: gainsboro;
}
#header{
	background-color:#010146;
	height: 70px;
	width: 100%;
	margin-top: : 0px;
}
#header h1{
	margin: 0px;
	color: white;
	font-size: 44px;
	padding-left: 100px;
	padding-top: 10px;
}
#form{
    padding-top: 150px;
    }
#form h1{
	margin: 0px;
	}
form{
	font-family: sans-serif;
	font-size: 16px;
	margin-top: 20px;
	}
input{
    border-left: none;
    border-right: none;
    border-top: none;
	background-color: unset;
	border-bottom: 2px solid black;
	width: 300px;
	height: 30px;
	font-family: sans-serif;
	font-size: 14px;
	}
button{
	height: 30px;
	width: 150px;
	background-color:#010146;
	color: white;
	border: none;
	border-radius: 20px;
	}
</style>
</head>
<body>
	<div id="header">
		<div id="logo">
			<h1><i>Socio</i></h1>
	    </div>
		
	</div>
	<div id="form">
		<center>
			<span style="color: red; font-size: 22px;"><?php
			 if(isset($msg)){
			 	echo $msg;
			 }
			?></span>
		<h1>Reset Password</h1>
	<form method="post">
		<label for="email">Enter your email:<br></label>
		    <i class="fa fa-user" style="color: black;"></i>
			<input type="text" name="email" autocomplete="off" placeholder="Enter userid" /><br><br>
			<span style="color: red;">
			 <?php
                if(isset($error_msg['email'])){
                	echo $error_msg['email'];
                }
			?>
		</span>
			<button type="submit" name="submit" class="sign up">Submit</button>
	</form>
	</center>
   </div>
</body>
</html>