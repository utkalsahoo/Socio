 <?php
    
    if (isset($_POST['submit'])) {
        if (empty($_POST["email"])) {
		     $error_msg['email'] = "*Email is required <br>";
	  	} else {
		    $email = $_POST["email"];
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      $error_msg['email'] = "Invalid email format <br>"; 
		    }
		}	
	    if($_POST['password'] == ""){
		    $error_msg['password'] = "*Password is required <br>";
        }

        $servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Socio";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		    echo "connected";
		}
		$username=$_POST['email'];
		$password=md5($_POST['password']);
		$query= "SELECT * FROM user where email='".$username."' and password='".$password."'";
		$res =mysqli_query($conn,$query) or die(mysqli_error($conn));
		$num_row=mysqli_num_rows($res);
		if ($num_row==1) {
			$row=mysqli_fetch_row($res);
			session_start();
			$_SESSION['id']=$row[0];
			header("Location:home.php");
		}
		else {
			$error_msg['match']="user name and password doesnot match";
		}
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Socio-Login</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<style type="text/css">
		body{
	height: 650px;
	width: 100%;
	margin: 0px;
	background-image: url("Login.jpg");
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
	padding-left: 10px;
	padding-top: 10px;
}
#Login{
height: 300px;
width: 400px;
margin-left: 450px;
margin-top: 120px;
border: 1px;
border-radius: 20px;
background-color: rgb(0,0,0,.7);
font-family: sans-serif;
color: white;
}
form h2{
	color: green;
	margin: 0px;
	margin-top: 10px;
}
button {
	background-color: green;
	border-radius: 10px;
	height: 30px;
	width: 130px;
	border: none;
	color: white;
}
.error{
	color: blue;
}
#header h1{
	margin: 0px;
	margin-left: 70px;
	color: white;
}
input{
	border: none;
	background-color: unset;
	border-bottom: 1px solid white;
	color: white;
	font-family: sans-serif;
	font-size: 16px;
}
</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div id="header">
		<h1><i>Socio</i></h1>
		
	</div>
	<div id="Login">
		<center>
			<span style="color: red;">
			 <?php
               if(isset($error_msg['match'])){
                	echo $error_msg['match'];
                }
			?>
		</span>
		<form name="Login" method="post" enctype="multipart/form-data">
			<h2>Login</h2>
			<i class="fa fa-user" style="color: white;"></i>
			<input type="text" name="email"placeholder="Userid" autocomplete="off"><br><br>
			<span style="color: red;">
			 <?php
                if(isset($error_msg['email'])){
                	echo $error_msg['email'];
                }
			?>
		</span>
			<i class="fa fa-key" style="color: white;"></i>
			<input type="password" name="password" placeholder="Enter your password" id="myInput" autocomplete="off"><br><br>
			<input type="checkbox" onclick="myFunction()">Show Password<br>
			<span style="color: red;">
			 <?php
                if(isset($error_msg['password'])){
                	echo $error_msg['password'];
                }
			 ?>
			</span>
			<button type="submit" name="submit" class="sign up">Login</button><br>

		</form>
		<a href="resetpassword.php">Forget Password?</a>
		<p>New User?<a href="Signup.php">&nbsp;Sign Up</a></p>
	</center>
	</div>	
	<script>
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
</body>
</html>