<?php
   session_start();
    if (isset($_SESSION['email'])) 
     {
	$userid=$_SESSION['email'];
     }
if (isset($_POST['submit'])) {
  if (empty($_POST["password"])) {
    $error_msg['password'] = "*Please enter a password <br>";
       }
  if ($_POST["password2"] !== $_POST['password']) {
	$error_msg['password2'] = "*Password does not match <br>";
        }
  if(empty($error_msg)){
  	$newpass=md5($_POST['password']);
	$repass=md5($_POST['password2']);
	$servername = "localhost";
	$username = "root";
	$dbpassword = "";
	$dbname = "Socio";

	$conn = new mysqli($servername, $username, $dbpassword, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	else
	{
	echo "Connected successfully";
	}
	$sql = "UPDATE user SET password='".$repass."' where email='".$userid."'";
	if($newpass===$repass)
	{
		if (mysqli_query($conn,$sql) === TRUE) {
    		echo "password changed successfully";
    		session_destroy();
    		header("location:Login.php");
		}
    	else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	else
	{
		echo "password mismatch";
	}
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
	font-size: 16px;
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
		<h1>Reset Password</h1>
	<form method="post">
		  <i class="fa fa-unlock-alt" style="color: black;"></i>
			<input type="password" name="password" autocomplete="off" placeholder="Enter a password" /><br><br>
			<span style="color: red;">
			 <?php
                if(isset($error_msg['password'])){
                	echo $error_msg['password'];
                }
			 ?>
			</span>
			<i class="fa fa-unlock-alt" style="color: black;"></i>
			<input type="password" name="password2" autocomplete="off" placeholder="Confirm your password" /><br><br>
			<span style="color: red;">
			 <?php
                if(isset($error_msg['password2'])){
                	echo $error_msg['password2'];
                }
			 ?>
			</span><br><br>
			<button type="submit" name="submit" class="sign up">Submit</button>
	</form>
	</center>
   </div>
</body>
</html>