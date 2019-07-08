<?php 
session_start();

if(empty($_SESSION['user'])){
header('location:index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Test List</title>
    <meta charset="utf-8">
  <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/common.css">
      <link rel="stylesheet" type="text/css" href="css/titles.css">
      
     

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/give-test.css">
     <link rel="stylesheet" type="text/css" href="css/common.css"> -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
       <script type="text/javascript" src="js/titles.js"></script>
      
</head>
<body>
<!--Import jQuery before materialize.js-->
     
      <script type="text/javascript" src="js/materialize.min.js"></script>

<?php
include('conn.php');

include('login.php');
include('signup.php');
include('header.php');

?>
<div class="container">
<?php
$user=$_SESSION['user'];
$forms=mysqli_query($con,"select title,fnumber,active from gen_forms where username='$user' and deleted=0 ");
while($row=mysqli_fetch_array($forms)){
  if($row['active']=="1"){
    $status="Close";
  }
  else{
   $status="Open"; 
  }
	echo "<div class='test-list' id=".$row['fnumber']."><a href='load-preview.php?formn=".$row['fnumber']."' class='btn blue-grey darken-4 '>".$row['title']."</a>
  <button class='btn blue-grey darken-4 floatr' onclick='changeStatus(this);' title='Test Status'>".$status."</button><button class='btn blue-grey darken-4 floatr' onclick='deleteTest(this);' title='Delete Test'><i class='material-icons dp48' >clear</i></button></div>";
   
}



//echo "<div class='titles'><a href='load-preview.php?formn=1'>Demo page title</a><div>";
?>




  </div>
  <input type="hidden" id="navno" value="1" />
</body>
</html>