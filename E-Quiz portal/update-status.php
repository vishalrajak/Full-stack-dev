<?php
if(!empty($_POST['formn'])){
	session_start();
	$fnum=$_POST['formn'];
	require_once('conn.php');
	$query=mysqli_query($con,"update gen_forms set active=IF(active=1, 0, 1) where username='".$_SESSION['user']."' and fnumber=$fnum ;");
	if($query){
		echo "1";
	}
	else
	{
		echo "0";
	}

	mysqli_close($con);



}

?>