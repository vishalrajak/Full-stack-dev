<?php
session_start();
if(!empty($_GET['id'])&&!empty($_SESSION['user'])){
	include('conn.php');
	
	$qno=$_GET['id'];
	$result=mysqli_query($con,"delete from forms where username='".$_SESSION['user']."'  and fnumber=".$_SESSION['fno']." and qno='$qno'");
	if($result)
		echo "success";
	mysqli_close($con);
}

?>