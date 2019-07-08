<?php
require_once('conn.php');
if(!empty($_POST['formn']) && !empty($_POST['nverify-pass']) &&!empty($_POST['professor']) ){
	
	session_start();
	$query=mysqli_query($con,"select test_pass from gen_forms where username='".$_POST['professor']."' and fnumber=".$_POST['formn']."");
	$row=mysqli_fetch_array($query);
	$pass_hash=$row['test_pass'];
	$pass=mysqli_real_escape_string($con,$_POST['nverify-pass']);
	if(password_verify($pass,$pass_hash)){
		$_SESSION['test_status']=array("formn"=>$_POST['formn'],"professor"=>$_POST['professor']);
		echo "1";
	}
	else{
		echo "0";
	}
	
}
elseif(!empty($_POST['formn']) && !empty($_POST['professor']) ){
	session_start();
  	$query=mysqli_query($con,"select pass_status from gen_forms where username='".$_POST['professor']."' and fnumber=".$_POST['formn']."");
  	$row=mysqli_fetch_array($query);
  	if($row['pass_status']=="0"){
  $_SESSION['test_status']=array("formn"=>$_POST['formn'],"professor"=>$_POST['professor']);
  echo "-1";
	}
	else{
     echo "0";
	}

}
mysqli_close($con);

?>