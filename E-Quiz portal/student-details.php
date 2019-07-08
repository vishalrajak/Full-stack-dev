<?php
session_start();
if(empty($_SESSION['user'])){
	header('location:index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Details</title>
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
<script type="text/javascript" src="js/materialize.min.js"></script>
 

<?php
require_once('conn.php');
require_once('login.php');
require_once('signup.php');
require_once('header.php');

$result=mysqli_query($con,"select title,fnumber from gen_forms where username='".$_SESSION['user']."' and deleted=0 order by fnumber  ");


    if(!empty($_SESSION['user'])): ?>
    <!--  $result=mysqli_query($con,"select fnumber,title from gen_forms where username='".$_SESSION['user']."' order by fnumber"); -->
    <div class="container">
    <p>Select Test to View Students Performance:</p>
    <form method="get" action="">
    <div class="input-field" id="select_box">
<select id='list-test' name="fno"  onchange="getDetails(this.value);">
<option selected disabled value="0" >Choose Test</option>
    <?php
    while($row=mysqli_fetch_array($result)){
     echo  '<option value='.$row['fnumber'].'>'.$row['title'].'</option>'; 

     }  ?>    
    
</select>


<input type="text" name="search" id="isearch" placeholder="Search By UID" />
<button id="search" class="btn">Search</button>
</div>
</form>
<?php endif;  ?>

<br>
<br>
<br>
    <div class="bubblingG" id="loading">
  <span id="bubblingG_1">
  </span>
  <span id="bubblingG_2">
  </span>
  <span id="bubblingG_3">
  </span>
   </div>
<?php
if(!empty($_GET['fno']) &&  !empty($_GET['search'])){
	$query=mysqli_query($con,"select uid,score from marks where professor='".$_SESSION['user']."' and fnumber=".$_GET['fno']."  and uid like '%".$_GET['search']."%'");

	if(mysqli_num_rows($query)>0){
 echo "<p>Click On The UID To Get Additional Details</p>";
echo '<div>
<table class="highlight centered" id="test-table">';
echo "<thead><tr><th>UID</th><th>Marks</th></tr></thead><tbody>";
while($row=mysqli_fetch_array($query)){
echo "<tr><td><a href='report.php?uid=".$row['uid']."&prof=".$_SESSION['user']."&test=".$_GET['fno']."'>".strtoupper($row['uid'])."</td><td>".$row['score']."</a></td></tr>";

}

echo '</table>
    </div>';


	}
	else
	{
		echo "<p>Nothing To Show</p>";
	}
}

     ?>
<input type="hidden" id="navno" value="2" />
</div>
<script type="text/javascript">
	$('select').material_select();
</script>

</body>
</html>