<?php
session_start();
if(!empty($_GET['id'])&&!empty($_SESSION['user'])){
include('conn.php');

$qno=$_GET['id'];
$result=mysqli_query($con,"select question,options,coption from forms where username='".$_SESSION['user']."' and fnumber=".$_SESSION['fno']." and qno='$qno' ");
$question=array();
$row=mysqli_fetch_array($result);
$question[]=$row['question'];
$options=explode('`',$row['options']);
for($i=0;$i<sizeof($options);$i++){
	$question[]=$options[$i];
}
$question[]=$row['coption'];
echo json_encode($question);
mysqli_close($con);
}



?>