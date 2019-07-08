<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>About</title>
	<meta charset="utf-8">
     <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/common.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
    
</head>
<body>
 <!--Import jQuery before materialize.js-->
     
      <script type="text/javascript" src="js/materialize.min.js"></script>
<?php

include('login.php');
include('signup.php');
include('header.php');


?>
<div class="container">
<p>This website is created to generate online test for institutes and students can give the test at the same palce.So this is a all in one package</p>
<input type="hidden" id="navno" value="3" />
</div>
</body>
</html>