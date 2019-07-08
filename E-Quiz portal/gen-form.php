<?php
session_start();
if(isset($_POST['submit'])&&isset($_SESSION['fno'])&&$_POST['title'] && isset($_POST['pass-protect'])){
	if($_POST['pass-protect']=="0"){
	include('conn.php');
	$user=$_SESSION['user'];
	$title=$_POST['title'];
	$fno=$_SESSION['fno'];
	$add=mysqli_query($con,"insert into gen_forms values('$user','$title',$fno,0,1,0,'null')");
	$update=mysqli_query($con,"update utcet set nform=nform+1 where username='$user' ");

	if($add&&$update){
		header('location:show-titles.php');
	}
	else
{  
	echo '<script>alert("some error occured");window.location.href="create-test.php"</script>';
}
	}
   else if($_POST['pass-protect']=="1"  && !empty($_POST['test-pass'])){
    
    include('conn.php');
	$user=$_SESSION['user'];
	$title=$_POST['title'];
	$fno=$_SESSION['fno'];
	$pass=password_hash($_POST['test-pass'],PASSWORD_DEFAULT);
	$add=mysqli_query($con,"insert into gen_forms values('$user','$title',$fno,0,1,1,'$pass')");
	$update=mysqli_query($con,"update utcet set nform=nform+1 where username='$user' ");

	if($add&&$update){
		header('location:show-titles.php');
	}
	else
{   
	echo '<script>alert("some error occured");window.location.href="create-test.php"</script>';
}

   }
}


?>