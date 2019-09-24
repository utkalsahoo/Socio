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
      if (empty($_POST["password"])) {
	     $error_msg['password'] = "*Password is required <br>";
        }
       if ($_POST["password2"] !== $_POST['password']) {
	     $error_msg['password2'] = "*Password does not match <br>";
        } 
      if (empty($_POST["firstname"])) {
	     $error_msg['firstname'] = "*First name is required <br>";
        } 
      if (empty($_POST["lastname"])) {
	     $error_msg['lastname'] = "*Last name is required <br>";
        } 
      if (empty($_POST["checkbox"])) {
	     $error_msg['checkbox'] = "Please agree to our term & policy <br>";
        } 
      if (empty($_POST["gender"])) {
	     $error_msg['gender'] = "* Gender is required <br>";
        }
      if (empty($_POST["dob"])) {
	     $error_msg['dob'] = "* Please enter your date of birth <br>";
        }

if(empty($error_msg)){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "Socio";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	if (isset($_POST['submit'])) 
	{
		
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$dob=$_POST['dob'];
		$gender=$_POST['gender'];
	
		$sql = "INSERT INTO user (firstname, lastname, email , password , dob , gender , regdate)
		VALUES ('$firstname', '$lastname', '$email' , '$password' , '$dob' , '$gender' , NOW() )";
		if($conn->query($sql)=== TRUE)
		 {
		 	$sql2="SELECT * from user where email='$email'";
		 	$result = mysqli_query($conn,$sql2)or die(mysqli_error($conn));
		 	$num_row = mysqli_num_rows($result);
		 	if($num_row ==1)
		 	{
		 		$row=mysqli_fetch_row($result);
		 	}
		 	if (isset($row))
		 	{
		 		$sql1 = "INSERT INTO profile (userid) VALUES ('$row[0]')";
		 		if(($conn->query($sql1))=== TRUE)
		 		{
                  header("Location:Login.php");
		 		}
		 	}
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		     echo "Error: " . $sql1 . "<br>" . $conn->error;
		}
	}
}else{
	foreach ($error_msg as $key => $value) {
	}
}
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Socio-sign Up</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		body{
	height: 650px;
	width: 100%;
	margin: 0px;
	background-image: url("Signup.jpg");
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
	padding-left: 80px;
	padding-top: 10px;
}
#Signup{
background-color: rgb(0,0,0,.4);
color: white;
height: 550px;
width: 400px;
margin-left: 450px;
margin-top: 30px;
border: 1px;
border-radius: 18px;
font-family: sans-serif;
}
#logo img{
	width: 100px;
	height: 40px;
	padding-left: 70px;
	padding-top: 8px;
}
form h2{
	color: green;
	text-align: center;
}
button {
	background-color: green;
	color: white;
	border-radius: 10px;
	border: none;
	height: 30px;
	width: 150px;
	margin-left: 120px;
}
input[type=text],[type=password]{
	border: none;
	background-color: unset;
	border-bottom: 1px solid white;
	color: white;
	font-size: 14px;
	font-family: sans-serif;
	width: 200px;
}
i{
	margin-left: 100px;
}
input[type=date]{
	border: none;
	background-color: unset;
	border-bottom: 1px solid white;
	color: white;
	font-size: 14px;
	font-family: sans-serif;
}
.Show{
	margin-left: 100px;
}
label{
	margin-left: 100px;
}
.term{
	margin-left: 100px;
}
p{
	margin-left: 100px;
}
</style>
</head>
<body>
	<div id="header">
		<div id="logo">
			<h1><i>Socio</i></h1>
	    </div>
		
	</div>
	<div id="Signup">
		<form name="Signup" method="post" action="Signup.php">
			<h2>CREATE AN ACCOUNT</h2>
			<i class="fa fa-user" style="color: white;"></i>
			<input type="text" name="firstname" placeholder="Enter your first name" autocomplete="off" /><br><br>
			<center><span style="color: red;">
			 <?php
                if(isset($error_msg['firstname'])){
                	echo $error_msg['firstname'];
                }
			?>
		   </span></center>
		    <i class="fa fa-user" style="color: white;"></i>
			<input type="text" name="lastname" placeholder="Enter your last name" autocomplete="off" /><br><br>
			<center><span style="color: red;">
			 <?php
                if(isset($error_msg['lastname'])){
                	echo $error_msg['lastname'];
                }
			?>
		    </span></center>
		    <i class="fa fa-envelope" style="color: white;"></i>
			<input type="text" name="email" placeholder="Enter your email" autocomplete="off" /><br><br>
			<center><span style="color: red;">
			 <?php
                if(isset($error_msg['email'])){
                	echo $error_msg['email'];
                }
			?>
		    </span></center>
		    <i class="fa fa-unlock-alt" style="color: white;"></i>
			<input type="password" name="password" id="myInput" placeholder="Enter a password" autocomplete="off"/><br>
			<input type="checkbox" class="Show"onclick="myFunction()" />Show Password<br><br>
			<center><span style="color: red;">
			 <?php
                if(isset($error_msg['password'])){
                	echo $error_msg['password'];
                }
			 ?>
			</span></center>
			<i class="fa fa-unlock-alt" style="color: white;"></i>
			<input type="password" name="password2" placeholder="Confirm password" autocomplete="off"/><br><br>
			<center><span style="color: red;">
			 <?php
                if(isset($error_msg['password2'])){
                	echo $error_msg['password2'];
                }
			 ?>
			</span></center>
			<label>DOB:</label>
			<input type="date" name="dob" placeholder="Enter your date of birth" autocomplete="off"><br><br>
			<center><span style="color: red; text-align:">
			 <?php
                if(isset($error_msg['dob'])){
                	echo $error_msg['dob'];
                }
			 ?>
			</span></center>
			<label>Gender: </label>
			<input type="radio" name="gender" value="Male">Male
            <input type="radio" name="gender" value="Female">Female
            <input type="radio" name="gender" value="Other">Other<br>
            <center><span style="color: red;">
			 <?php
                if(isset($error_msg['gender'])){
                	echo $error_msg['gender'];
                }
			 ?>
			</span></center>
			<input type="checkbox" class="term" name="checkbox">Agree to our <a href="#">Term & Policy</a><br>
              <center><span style="color: red;">
			 <?php
                if(isset($error_msg['checkbox'])){
                	echo $error_msg['checkbox'];
                }
			 ?>
			</span></center>
			<button type="submit" name="submit" class="sign up">Sign Up</button><br>
		</form>
		<p>Already have an account?<a href="Login.php">&nbsp;Login</a></p>
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
<?php
if(isset($conn)) 
	$conn->close(); 
?>