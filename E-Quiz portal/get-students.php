<?php

session_start();

include('conn.php');

$result=mysqli_query($con,"select uid,score from marks where professor='".$_SESSION['user']."' and fnumber=".$_GET['fno']."");

if(mysqli_num_rows($result)>0){

echo "<thead><tr><th>UID</th><th>Marks</th></tr></thead><tbody>";

while($row=mysqli_fetch_array($result)){

	echo "<tr><td>".strtoupper($row['uid'])."</td><td>".$row['score']."</td></tr>";

}
echo "</tbody>";



}

mysqli_close($con);



?>







