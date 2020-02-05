<?php
session_start();
if(isset($_SESSION['id']))
{
  $servername = "localhost";
  $username = "root";
  $dbpassword = "";
  $dbname = "Socio";
  $conn = new mysqli($servername, $username, $dbpassword, $dbname);
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  } 
  $sql="select * from post";
  $result = mysqli_query($conn,$sql)or die(mysqli_error($conn));
  $num_row = mysqli_num_rows($result);
  $sql1="SELECT profilepic FROM profile WHERE userid='".$_SESSION['id']."'";
  $result1 = mysqli_query($conn,$sql1)or die(mysqli_error($conn));
  $row1=mysqli_fetch_row($result1);
  $sql2="SELECT firstname,lastname FROM user WHERE id='".$_SESSION['id']."'";
  $result2 = mysqli_query($conn,$sql2)or die(mysqli_error($conn));
  $row2=mysqli_fetch_row($result2);
}
else
{
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Socio</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <style type="text/css">
    body{
    	margin: 0px;
    	background-color: gainsboro;
    }
 	#header{
	background-color: #010146;
	height: 70px;
	width: 100%;
	margin-top: : 0px;
  position: fixed;
   }
   #header h1{
   	margin: 0px;
   	color: white;
   	padding-left: 100px;
   	padding-top: 10px;
   	font-size: 38px;
   	float: left;
   }
   #header p{
   	margin: 0px;
    float: right;
   	margin-right: 580px;
   	color: white;
   	padding-top: 30px;
    font-family: sans-serif;
   }
   #menu{
   	float: left;
   	height: 680px;
   	width: 200px;
   	background-color: #020258c7;
    position: fixed;
    margin-top: 70px;
   }
   #menu input[type=button]{
    height: 30px;
    color: white;
    border: none;
    background-color: unset;
    font-size: 20px;
    margin-top: 0px;
    margin-left: 0px;
   }
   #user{
    height: auto;
    width: 700px;
    float: right;
    margin-right: 150px;
    padding-top: 70px;
    text-align: left;

   }
  #profile{
    height: 50px;
    width: 50px;
    border-radius: 30px;
    border: 1px solid black;
    margin-right: 400px;
   }
   #user button{
        background-color: #010146;
        height: 30px;
        width: 100px;
        border-radius: 18px;
        border: none;
        color: white;
        margin-right: 100px;
   }
   hr{
   	margin: 0px;
   	width: 500px;
   }
   #write p{
   	margin-right: 215px;
   }
   i{
    margin-top: 60px;
    margin-left: 40px;
   }
   #postimg{
    height: auto;
    max-width: 500px;
    max-height: 400px;
   }
   #img{
    height: auto;
   }
 </style>
</head>
<body>
<div id="header">
	<h1><i>Socio</i></h1>
  <?php
  echo '
  <img src="data:image/jpeg;base64,'.base64_encode($row1[0]).'" alt=" Profile" style="height: 35px; width: 35px; border-radius: 20px; margin-left: 400px; margin-top: 20px;">
  ';
  ?>
  <p><?php echo $row2[0]; ?></p>
</div>
<div id="menu">
  <form method="post">
    <i class="fa fa-home" style="color: white;"></i>
    <input type="button" name="profile" value="Home" onclick="window.location.href='home.php'"><br>
    <i class="fa fa-user-circle" style="color: white;"></i>
    <input type="button" name="profile" value="Profile" onclick="window.location.href='Profile.php'"><br>
    <i class="fa fa-users" style="color: white;"></i>
    <input type="button" name="friend" value="Find Friends" onclick="window.location.href='Users.php'"><br>
    <i class="fa fa-edit" style="color: white;"></i>
    <input type="button" name="post" value="Write Post" onclick="window.location.href='createpost.php'"><br>
    <i class="fa fa-users" style="color: white;"></i>
    <input type="button" name="post" value="My Friends" onclick="window.location.href='friends.php'"><br>
    <i class="fa fa-users" style="color: white;"></i>
    <input type="button" name="post" value="Requests" onclick="window.location.href='friendrequest.php'"><br>
    <i class="fa fa-sign-out" style="color: white;"></i>
    <input type="button" name="logout" value="Logout" onclick="window.location.href='logout.php'"><br>
</form>
</div>
<center>
<div id="user">    
 <?php 
 if(isset($result))
 {
    foreach ($result as $data) 
    {
      $sql="SELECT firstname,lastname FROM user WHERE id=".$data['userid'];
      $result2=mysqli_query($conn,$sql)or die(mysqli_error($conn));
      $row1=mysqli_fetch_row($result2);
      $sql2="SELECT profilepic FROM profile WHERE userid=".$data['userid'];
      $result3=mysqli_query($conn,$sql2)or die(mysqli_error($conn));
      $row2=mysqli_fetch_row($result3);
      echo '<div id="write">
      <img src="data:image/jpeg;base64,'.base64_encode($row2[0]).'" style="float:left"; id="profile">
      <p>'.$row1[0]." ".$row1[1].'</p>
      <p>'.$data['title'].'</p>
      <p>'.$data['textmsg'].'</p>
      <div id=img>
      <p><img src="data:image/jpeg;base64,'.base64_encode($data['image']).'" id="postimg" ></P>
      </div>
      <hr>
      <button type="submit" name="like" value="Like" id="btn1">Like</button>
      <button type="submit" name="comment" value="Comment" id="btn1">Comment</button>
      <button type="submit" name="share" value="Share" id="btn1">Share</button>
      </div>';
  }
 }
 ?>
</div>
</center>
</body>
</html>
