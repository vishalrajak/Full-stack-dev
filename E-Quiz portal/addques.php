<?php  
session_start();
include("conn.php");
$user=$_SESSION['user'];
if(!empty($_POST['details'])){
$details=json_decode($_POST['details'],false);
$question=$details[1];
$options=$details[2];
for($i=3;$i<sizeof($details);$i++){
	$options.='`'.$details[$i];
}
$correct_option=intval($details[0]);
$current_form_no=intval($_SESSION['fno']);
$result=mysqli_query($con,"select maxid from form_max where username='$user' and fnumber='$current_form_no'");
if(mysqli_num_rows($result)==0){//if no questions are added i.e 1st question is created
	$result=mysqli_query($con,"insert into form_max values('$user',$current_form_no,0)");
	$qno=1;
}
else{
$row=mysqli_fetch_array($result);
$qno=intval($row['maxid'])+1;//next question number
}
$update=mysqli_query($con,"update form_max set maxid=maxid+1 where username='$user' and fnumber='$current_form_no'");
$result=mysqli_query($con,"insert into forms values('$user',$current_form_no,'$question','$options',$correct_option,$qno)");
if($result)
echo $qno;
}
else{
	header("location:index.php");
}






?>