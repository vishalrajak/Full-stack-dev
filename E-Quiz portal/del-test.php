<?php
if(!empty($_POST['formn'])){
	session_start();
	include('conn.php');
	$formno=intval($_POST['formn']);
	$del_test=mysqli_query($con,"update gen_forms set deleted=1,active=0  where username='".$_SESSION['user']."'   and fnumber=$formno");
     $del_ques=mysqli_query($con,"delete from forms where username='".$_SESSION['user']."'   and fnumber=$formno");

     $del_formmax=mysqli_query($con,"delete from form_max where username='".$_SESSION['user']."'   and fnumber=$formno");
     
     if($del_formmax && $del_ques && $del_test){
     	echo "1";
     }
     else
     {
     	echo "0";
     }

     mysqli_close($con);
}


?>