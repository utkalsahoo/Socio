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
    $sql = "SELECT firstname , lastname , email , dob FROM user WHERE id='".$_SESSION['id']."'";
    $sql1 = "SELECT phone,aboutme,profilepic FROM profile WHERE userid='".$_SESSION['id']."'";

    $result = mysqli_query($conn,$sql)or die(mysqli_error($conn));
    $result1 = mysqli_query($conn,$sql1)or die(mysqli_error($conn));
    $num_row = mysqli_num_rows($result);
    $num_row1=mysqli_num_rows($result1);
    if( $num_row ==1 )
    {
      $row=mysqli_fetch_row($result);
    }
    if($num_row1==1)
    {
      $row1=mysqli_fetch_row($result1);
    }
    if (isset($_POST['submit'])) 
     {
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $dob=$_POST['dob'];
      $phone=$_POST['phone'];
      $about=$_POST['about'];
      $file=addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
      $sql2 = "UPDATE user SET firstname='".$fname."',lastname='".$lname."', dob='".$dob."' WHERE id='".$_SESSION['id']."'";
      $sql3 = 'UPDATE profile SET phone="'.$phone.'",profilepic="'.$file.'",aboutme="'.$about.'" WHERE userid="'.$_SESSION['id'].'"';
        echo "string";
      if (mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) 
      {
          echo "Record updated successfully";
          header("Location:Profile.php");
      } 
      else 
      {
          echo "Error updating record: " . mysqli_error($conn);
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
   background-color:  #d8d6d67d;
   margin: 0px;
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
   #edit{
    margin-left: 700px;
    margin-top: 50px;
    font-family: sans-serif;
    font-size: 16px;
   }
   #edit img{
    height: 100px;
    width: 100px;
    border-radius: 50px;
  }
   input{
    border: none;
    background-color: unset;
    border-bottom: 1px solid black;
    height: 30px;
   }
   textarea{
    border: none;
    background-color: unset;
    border-bottom: 1px solid black;
    height: 30px;
   }
   input[type=submit]{
    background-color:#010146;
    margin-left: 30px;
    width: 100px;
    height: 30px;
    border-radius: 20px;
    color: white; 
   }
   input[type=file]{
   	border:none;
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
<div id="edit">
<form method="post" enctype="multipart/form-data">
    <?php
  echo '
  <img src="data:image/jpeg;base64,'.base64_encode($row1[2]).'" alt=" Profile">
  ';
  ?>
    <input type="file" name="image" id="image" accept="image/*"><br>
    <label for="fname">First Name</label><br>
    <input type="text" name="fname"  id="fname" value="<?php echo $row[0]; ?>" required><br><br>
    <label for="lname">Last Name</label><br>
    <input type="text" name="lname"  id="lname" value="<?php echo $row[1]; ?>" required><br><br>
    <label for="dob">Date of Birth</label><br>
    <input type="date" name="dob"  id="dob" value="<?php echo $row[3]; ?>" required><br><br>
    <label for="phno">Mobile</label><br>
    <input type="number" name="phone"  id="phone" value="<?php echo $row1[0]; ?>"><br><br>
    <label for="about">About</label><br>
    <textarea name="about" id="about" value="<?php echo $row1[1]; ?>"></textarea><br>
    <input type="submit" name="submit" value="Update">
  </form>
</div>
</body>
</html>