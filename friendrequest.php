<?php
session_start();
if(isset($_SESSION['id']))
{
  $message="";
  $servername = "localhost";
  $username = "root";
  $dbpassword = "";
  $dbname = "Socio";

  $conn = new mysqli($servername, $username, $dbpassword, $dbname);
 
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  } 
  $message="";
  $sql1 = "SELECT * FROM friendrqst f,user u WHERE (f.senderid=u.id) AND f.accept=1 AND f.receiverid=".$_SESSION['id']; 
  $result1=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
  $num_row=mysqli_num_rows($result1);
  if ($num_row>=1) 
  {
    $row1=mysqli_fetch_row($result1);
    
  }

  if (isset($_POST['accept'])) 
  {
    $sql5 = "SELECT * FROM friendrqst WHERE senderid=".$_POST['id']." AND receiverid='".$_SESSION['id']."' AND accept=1";
    $result5=mysqli_query($conn,$sql5) or die(mysqli_error($conn));
    $num_row5=mysqli_num_rows($result5);
    if($num_row5==1)
    {
      $sql3 = "UPDATE friendrqst SET  accept=0, acceptdate=NOW() WHERE receiverid=".$_SESSION['id']." AND senderid=".$_POST['id'];
      $result3=mysqli_query($conn,$sql3) or die(mysqli_error($conn));
      if ($result3==TRUE) 
      {
        echo "you are friends now.";
      }
    }
  }
  if (isset($_POST['delete'])) 
  {
    $sql5 = "SELECT * FROM friendrqst WHERE senderid=".$_POST['id']." AND receiverid='".$_SESSION['id']."' AND accept=1";
    $result5=mysqli_query($conn,$sql5) or die(mysqli_error($conn));
    $num_row5=mysqli_num_rows($result5);
    if($num_row5==1)
    {
      $sql4 = "DELETE FROM friendrqst  WHERE receiverid=".$_SESSION['id']." AND senderid=".$_POST['id']." AND accept=1";
      $result4=mysqli_query($conn,$sql4) or die(mysqli_error($conn));
      if ($result4==TRUE) 
      {
        echo "request deleted.";
      }
    }
  }
  
}
else
{
  header("location:Login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Socio</title>
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
   #menu input[type=button]{
    height: 30px;
    color: white;
    border: none;
    background-color: unset;
    font-size: 20px;
   }
   i{
    margin-top: 65px;
    margin-left: 40px;
   }
   #frndreq{
    height: 130px;
    width: 950px;
    float: right;
    background-color: #77778673;
    padding-left: 200px;
    }
  #frndreq img{
    height: 100px;
    width: 100px;
    float: left;
    margin-top: 10px;
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
    margin-right: 50px;
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
   margin-right: 50px;
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
    width: 2px;
  }
 </style>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
 if(isset($result1))
 {
    foreach ($result1 as $data) 
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
          <img src="data:image/jpeg;base64,'.base64_encode($row5[0]).'">
          <div id="detail">
            <h3 name="name">'. $data['firstname'].' '.$data['lastname'] .'</h3>
            <h5>Balasore</h5>
          </div>
          <input type="submit" name="accept" value="confirm request" onclick="myFunction()">
          <input type="submit" name="delete" value="delete request" onclick="myFunction()">
          <input type="button" name="view"  value="view profile" '.$btn.'>
        </div>
        </form>
        <hr></center>';
      }
  }
 }
 ?>
 <script type="text/javascript">
  function myFunction()
  {
    location.reload();
  }
  
 </script>
</div>
</body>
</html>