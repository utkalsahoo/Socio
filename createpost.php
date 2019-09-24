<?php
session_start();
if (isset($_SESSION['id']))
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
    if (isset($_POST['submit'])) 
      {
        $title=$_POST['title'];
        $about=$_POST['about'];
        $file=addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $sql = "INSERT INTO post (textmsg,title,userid,image,date) VALUES ('".$about."','".$title."','".$_SESSION['id']."','".$file."',NOW())";
        if (mysqli_query($conn, $sql))
        {
          header("Location:home.php");
      } 
      else 
      {
          echo "Error updating record: " . mysqli_error($conn);
      }

      }
}
else
  {
    header("Location: Login.php");
    
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome to Socio</title>
 <style type="text/css">
    body{
      margin: 0px;
      background-color: #aac0d4;
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
   #user form{
    margin-top: 100px;
   }
   #user input[type=submit]{
    background-color: #010146;
    height: 30px;
    border:none;
    width: 100px;
    color: white;
    border-radius: 20px;
   }
   #user input[type=text]{
    width: 602px;
    height: 50px;
    border-bottom: none;
    background-color: #b5c7d6;
    font-family: sans-serif;
    font-size: 15px;
    color: black;
   }
   #user textarea{
    width: 600px;
    height: 200px;
    font-family: sans-serif;
    font-size: 15px;
    background-color: #b5c7d6;
   }
 </style>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="header">
  <h1><i>Socio</i></h1>
  <a  href="logout.php"><h3>Logout</h3></a>
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
  <center>
    <form method="POST"  enctype="multipart/form-data">
    <input type="text" name="title" placeholder="write your title" autocomplete="off"><br>
    <textarea name="about" rows="5" cols="50">type your post...</textarea><br>
    <input type="file" name="image" id="image" accept="image/*"><br><br>
    <input type="submit" name="submit" value="Post">
    </form>
    </center>
</div>
</body>
</html>