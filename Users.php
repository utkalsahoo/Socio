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
  $sql="select * from user";
  $result = mysqli_query($conn,$sql)or die(mysqli_error($conn));
  $num_row = mysqli_num_rows($result);
  if (isset($_POST['send'])) 
  {
    $sql1 = "SELECT * FROM friendrqst WHERE (senderid='".$_SESSION['id']."' AND receiverid='".$_POST['id']."' AND accept=0) OR (senderid='".$_POST['id']."' AND receiverid='".$_SESSION['id']."' AND accept=0)";
    $sql2 = 'INSERT INTO friendrqst (senderid, receiverid,reqdate,accept) VALUES ("'.$_SESSION['id'].'","'.$_POST['id'].'", NOW(), 1)';
    $sql3 = "SELECT * FROM friendrqst WHERE (senderid='".$_SESSION['id']."' AND receiverid='".$_POST['id']."' AND accept=1)";
    $result1=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
    $num_row=mysqli_num_rows($result1);
    if ($num_row==1) 
    {
      echo "you are already friends";
    }
    else
    {
      $rslt=mysqli_query($conn,$sql3) or die(mysql_error($conn));
      $row_num=mysqli_num_rows($rslt);
      if(!($row_num==1))
      {
        $result2=mysqli_query($conn,$sql2) or die(mysqli_error($conn));
        if($result2==true)
        {
         echo "Friend request sent";
        }
      }
      else
      {
        echo "you have already sent request";
      }
    }
  }
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
   #header h3{
   	margin: 0px;
   	float: right;
   	padding-right: 30px;
   	color: white;
   	padding-top: 20px;
   }
   #menu{
   	float: left;
   	height: 680px;
   	width: 200px;
   	background-color: #020258c7;
    position: fixed;
    margin-top: 70px;
   }
   i{
    margin-top: 65px;
    margin-left: 40px;
   }
   #menu input[type=button]{
    height: 30px;
    color: white;
    border: none;
    background-color: unset;
    font-size: 20px;
   }
   #frndreq{
    height: 130px;
    width: 1150px;
    background-color: #77778673;
    float: right;
    }
  #frndreq img{
    height: 100px;
    width: 100px;
    float: left;
    margin-top: 10px;
    margin-left: 40px;
    border-radius: 50px;
  }
  #detail{
    float: left;
  }
  #detail h3{
    float: left;
    margin-left: 50px;
    margin-top: 30px;
    margin-bottom: 0px;
  }
  #detail h5{
        margin-left: 60px;
  }
  #detail a{
    color: black;
  }
  #user{
    margin-top: 70px;
    float: right;
   }
  #frndreq input[type=submit]{
    float: right;
    margin-right: 350px;
    margin-top: 50px;
    width: 150px;
    height: 30px;
    background-color: #010146;
    border-radius: 20px;
    border: none;
    color:white;
  }
  #frndreq input[type=button]{
   float: right;
   margin-right: 100px;
    margin-top: 50px;
    width: 150px;
    height: 30px;
    background-color: #010146;
    border-radius: 20px;
    border: none;
    color:white; 
  }
  hr{
    margin: 0px;
  }
 </style>
</head>
<body>
<div id="header">
	<h1><i>Socio</i></h1>
	<a href="logout.php"><h3>Logout</h3></a>
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
</form>
</div>
<div id="user">    
 <?php 
 if(isset($result))
 {
    foreach ($result as $data) 
    {
      $sql5="SELECT profilepic FROM profile WHERE userid=".$data['id'];
      $result5=mysqli_query($conn,$sql5)or die(mysqli_error($conn));
      $row5=mysqli_fetch_row($result5);
      $btn='onclick='.'window.location.href="viewprofile.php?id='.$data['id'].'"';
      if(!($_SESSION['id']==$data['id']))
      {
      echo '<form method="post">
          <input type="text" name="id" value="'.$data['id'].'" hidden>
          <div id="frndreq">
          <img src="data:image/jpeg;base64,'.base64_encode($row5[0]).'" alt=" Profile">
          <div id="detail">
            <h3 name="name">'. $data['firstname'].' '.$data['lastname'] .'</h3>
            <h5>Balasore</h5>
          </div>
          <input type="submit" name="send" value="Add friend">
          <input type="button" name="view"  value="View profile" '.$btn.'>
        </div>
        </form>
        <hr></center>';
      }
  }
 }
 ?>
</div>
</body>
</html>