<?php
  $id=$_GET['id'];
  $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "Socio";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    if ($conn->connect_error) 
    {
      die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT email, firstname ,lastname,dob FROM user WHERE id='".$id."'";
    $sql1 = "SELECT phone,aboutme,profilepic FROM profile WHERE userid='".$id."'";
    $result = mysqli_query($conn,$sql)or die(mysqli_error($conn));
    $result1 = mysqli_query($conn,$sql1)or die(mysqli_error($conn));
    $num_row = mysqli_num_rows($result);
    $num_row1 = mysqli_num_rows($result1);
      if( $num_row ==1 )
      {
        $row=mysqli_fetch_row($result);
      }
      if ($num_row1==1) 
      {
        $row1=mysqli_fetch_row($result1);
      }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Socio</title>
 <style type="text/css">
    body{
    	margin: 0px;
      background-color: #dcdcdcb0;
    }
 #header{
  background-color: #010146;
  height: 70px;
  width: 100%;
  margin-top: : 0px;
   }
   #header h1{
    margin: 0px;
    color: white;
    padding-left: 100px;
    padding-top: 10px;
    font-size: 40px;
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
    height: 600px;
    width: 200px;
    background-color: #020258c7;
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
   #Profile{
    float: left;
    height: 250px;
    width: 900px;
    background-image: url("Login.jpg");
    margin-left: 150px;
   }
   #Profile img{
    height: 150px;
    width: 130px;
    margin-left: 100px;
    margin-top: 100px;
   }
   #details{
    height: 350px;
    width: 900px;
    margin-left: 350px;
    background-color: #dcdcdc73;
    margin-top: 250px;
   }
   #name{
    font-family: sans-serif;
    font-size: 28px;
    padding-top: 20px;
   }
   #name label{
    padding-left: 50px;
   }
   #about{
    font-family: sans-serif;
    font-size: 18px;
   }
   #about p{
    padding-left: 50px;
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
<div id="Profile">
  <?php
  echo '
  <img src="data:image/jpeg;base64,'.base64_encode($row1[2]).'" alt=" Profile">
  ';
  ?>
</div>
<div id="details">
  <div id="name">
    <label for="name"><?php echo $row[1]." ".$row[2]; ?></label>
  </div>
  <div id="about">
      <p><label>Email:</label><?php echo $row[0]; ?></p>
      <p><label>DOB:</label><?php echo $row[3]; ?></p>
      <p><label>Mobile:</label><?php echo $row1[0]; ?></p>
      <p><label>about:</label><?php echo $row1[1]; ?></p>
  </div>
</div>
</body>
</html>