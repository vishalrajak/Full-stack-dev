<?php
session_start();
if(empty($_SESSION['user'])){
header('location:index.php');
}
include('conn.php');
$user=$_SESSION['user'];
$result=mysqli_query($con,"select nform from utcet where username='$user'");
$row=mysqli_fetch_array($result);
$_SESSION['fno']=intval($row['nform'])+1;

?>
<!DOCTYPE html>
<html>
<head>
  <title>lol</title>
    <meta charset="utf-8">
  <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/common.css">
      <link rel="stylesheet" type="text/css" href="css/load-preview.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/give-test.css">
     <link rel="stylesheet" type="text/css" href="css/common.css"> -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <style type="text/css">
  #main{
  text-align:left;
}
  </style>

</head>
<body onpageshow="loadQuestions();">
<!--Import jQuery before materialize.js-->
     
      <script type="text/javascript" src="js/materialize.min.js"></script>
<?php
include('login.php');
include('signup.php');
include('header.php');


?>
<div  class="container">
  
<div id="main" >

</div>
<br>
<br>
<form action="gen-form.php" method="post">
<div class="input-field">
<input type="text" name="title" id="ttl" required palceholder="enter title"  />
<label>Title:</label>
</div>
<div class="test-abstraction">
<p>Make This Test Password Protected</p>
<input type="radio" name="pass-protect" id="yes" required value="1" onclick="showPassBox(this)" />
<label for="yes">Yes</label>
<input type="radio" name="pass-protect" id="no" required value="0" onclick="showPassBox(this)" />
<label for="no">No</label>
<br>
<div id="pass-box" class="input-field">
<input type="password" name="test-pass" class="validate"/>
<label>Enter Test Password</label>
</div>
</div>
<br>
<button id="add" class="btn" data-target="myModal" class="btn modal-trigger">Add More</button>
<input type="submit" name="submit" value="generate form" class="btn" />
</form>



<!-- <div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
     -->
      <!-- Modal content-->
      <!-- <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Enter Question Details</h4>
        </div>
        <div class="modal-body">
          
          <form id="form1">
<div id="box">
  <textarea class="form-control" rows="3"  style="resize:none;" id="question" required></textarea><br/>
  <p id="choose-ans"><strong>Please select the correct answer</strong></p>
  <div id="options">
  
  </div>
  <input type="submit" value="Add Question" id="add-elem" class="btn btn-success btns" />
  <button class="btn btn-danger btns" id="cancel" data-dismiss="modal">Cancel</button>
</div>
</form>
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
      </div>
      </div> -->




       <!-- Modal Structure -->
  <div id="myModal" class="modal">
    <div class="modal-content">
      <h4>Enter Question Details</h4>
      <form id="form1">
<div class="bubblingG" id="loading">
  <span id="bubblingG_1">
  </span>
  <span id="bubblingG_2">
  </span>
  <span id="bubblingG_3">
  </span>
   </div>
<div id="box">
  <textarea class="input-field" rows="3"  style="resize:none;" id="question" required></textarea><br/>
  <p id="choose-ans"><strong>Please select the correct answer</strong></p>
  <div id="options">
  
  </div>
  <input type="submit" value="Add Question" id="add-elem" class="btn" />
  <button class="btn" id="cancel" >Cancel</button>
</div>
</form>
    </div>
    <div class="modal-footer">
     
    </div>
  </div>
</div>
</body>
</html>