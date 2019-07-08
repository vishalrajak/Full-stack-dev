<?php
session_start();
if(empty($_SESSION['user'])){
header('location:index.php');
}
include("conn.php");
if(!empty($_GET['formn'])){
  $user=$_SESSION['user'];
    $_SESSION['fno']=$_GET['formn'];
$result=mysqli_query($con,"select question,options,coption,qno from forms where  username='$user' and fnumber='".$_SESSION['fno']."' order by qno");
if(!$result){
  echo "<script>Materialize.toast('<i class='material-icons dp48'>close</i>Connection Problem!', 2000);</script>";
  exit(0);
}
if(mysqli_num_rows($result)>0){
	echo '<!DOCTYPE html>
<html>
<head>
  <title>Test Preview</title>
    <meta charset="utf-8">
   <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link rel="stylesheet" type="text/css" href="css/common.css">
      <link rel="stylesheet" type="text/css" href="css/load-preview.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  
  <style type="text/css">
  #main{
  text-align:left;
}
  </style>
  
</head>
<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/materialize.min.js"></script>';
include('login.php');
include('signup.php');
include('header.php');
echo '<div  class="container">
        <div id="main">

';

while($row=mysqli_fetch_array($result)){
echo '<div class="list" id="'.$row['qno'].'">
<a href="#" onclick="return removeOptions(this);" style="float: right;" class="btn">Delete</a>
<button class="btn update">Edit</button>
<p>'.$row['question'].'</p>';
$options=explode("`",$row['options']);
for($i=0;$i<sizeof($options);$i++){
	if($i===intval($row['coption']))
echo '<input type="radio" name="anslist'.$row['qno'].'" checked="checked" id="ooption'.($i+1).$row['qno'].'" />';
else
echo '<input type="radio" name="anslist'.$row['qno'].'" disabled id="ooption'.($i+1).$row['qno'].'"  />';
echo '<label for="ooption'.($i+1).$row['qno'].'">'.$options[$i].'</label>
<br/>';// ooption+counter+qno is the id to prevent same ids in different divs
}
echo '<br/></div>';
}
echo '</div><br>
<div>
<button id="add" class="btn" data-target="myModal" class="btn modal-trigger">Add More</button>
</div>
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

</body>
</html>';
}
else
{
  header('location:show-titles.php');
}
//unset($_SESSION['fno']);
}
elseif(!empty($_SESSION['fno'])){
   $user=$_SESSION['user'];
	$result=mysqli_query($con,"select question,options,coption,qno from forms where  username='$user' and fnumber='".$_SESSION['fno']."' order by qno");
  if(!$result){
  echo "<script>Materialize.toast('<i class='material-icons dp48'>close</i>Connection Problem!', 2000);</script>";
  exit(0);
}
       if(mysqli_num_rows($result)>0){
while($row=mysqli_fetch_array($result)){
echo '<div class="list" id="'.$row['qno'].'">
<a href="#" onclick="return removeOptions(this);" style="float:right;" class="btn">Delete</a>
<button class="btn update">Edit</button>
<p>'.$row['question'].'</p>';
$options=explode("`",$row['options']);
for($i=0;$i<sizeof($options);$i++){
	if($i===intval($row['coption']))
echo '<input type="radio" name="anslist'.$row['qno'].'" checked="checked" id="ooption'.($i+1).$row['qno'].'" />';
else
echo '<input type="radio" name="anslist'.$row['qno'].'" disabled id="ooption'.($i+1).$row['qno'].'" />';
echo '<label for="ooption'.($i+1).$row['qno'].'">'.$options[$i].'</label>
<br/>';
}
echo '<br></div>';
}
}

}

mysqli_close($con);
?>