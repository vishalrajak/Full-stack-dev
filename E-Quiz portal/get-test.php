<?php
include('conn.php');
if(!empty($_GET['name'])){
	$username=$_GET['name'];
$result=mysqli_query($con,"select title,fnumber,pass_status from gen_forms where username='$username' and deleted=0 and active=1 order by fnumber  ");
if(mysqli_num_rows($result)>0){
$forms=array(array());
$i=0;
while($row=mysqli_fetch_array($result)){
$forms[$i][0]=$row['fnumber'];
$forms[$i][1]=$row['title'];
$forms[$i][2]=$row['pass_status'];
$i++;
}
echo json_encode($forms);
}
else
{
echo json_encode(array());	
}
}

?>