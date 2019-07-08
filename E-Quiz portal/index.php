<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Examination Portal</title>
     <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/common.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/getTests.js"></script>
    
</head>

<body >
 <!--Import jQuery before materialize.js-->
     
      <script type="text/javascript" src="js/materialize.min.js"></script>
<?php

require_once('conn.php');

require_once('login.php');
require_once('signup.php');
require_once('header.php');

?>
<input type="hidden" id="linuser" value="<?php if(!empty($_SESSION['user'])){echo $_SESSION['user'];}?>" >
<div  class="container">
   <div>
          <div class="card deep-orange lighten-2">
            <div class="card-content white-text">
              <span class="card-title" id="welcome">Welcome <?php if(!empty($_SESSION['user'])){echo ucwords($_SESSION['user'])."! Start Creating Awesome Tests For your Students";}else{echo " Guest!Get Ready For Awesome Tests";}   ?></span>
            </div>
            </div>
            </div>
<div class="carousel carousel-slider center" data-indicators="true">
    <div class="carousel-item  brown lighten-5" href="#one!">
      <p>Here You Can Give And Create Awesome Tests</p>
       <br>
      
      
      <span>Steps to Give Test:</span><br>
        <span>1) Goto Active Tests.</span><br>
        <span>2)Provide Your Details and Password If Required.</span><br>
        <span>3)Select Options And Submit.</span><br>
        <span>4)Result Will Be Generated And You Can Save It As Pdf.</span>  

      </span>
    </div>
    <div class="carousel-item brown lighten-5" href="#two!">
       <p>Note: Test Creation Requires SignUp</p>
       <br>
       
       
      <span>Steps to Create Test:</span></span><br>
        <span>1)Press Create Test.</span><br>
        <span>2)Use Add More Button To Create Questions And Also Provide The Correct Options.</span><br>
        <span>3)You Can Also Edit And Delete Questions Using Edit And Delete Buttons.</span><br>
        <span>4)You Can Get All Your Created Tests In My Tests Tab And You Can Customize Your Tests Also.</span>    

      </span>
    </div>
    
  </div>
<script type="text/javascript">
  $('.carousel.carousel-slider').carousel({fullWidth: true});
</script>
<br>
<br>
  <div id="welcome-box">
   <div id="welcome-box-inner">
 <?php if(empty($_SESSION['user'])): ?>
    <button type="button" class="btn btns" onclick="window.location.href='select-test.php'">Select Test</button>
    <?php endif;  ?>
    <br/>
    <?php if(!empty($_SESSION['user'])): ?>
    <button type="button" class="btn btns" onclick="window.location.href='create-test.php'">Create test</button>
<?php endif; ?>
    </div>
  </div>
<input type="hidden" id="navno" value="0" />
</div>
</body>
</html>