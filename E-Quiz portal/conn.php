<?php
$con=mysqli_connect('fdb6.awardspace.net','2515330_onlinetest','Killer514','2515330_onlinetest') or die('error');
// Usage 1:
// echo password_hash('rohit', PASSWORD_DEFAULT)."\n";//bcrypt hashing

// //$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

// if (password_verify('rasmuslerdorf', $hash)) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }
// $result=mysqli_query($con,"select username,pass from utcet where username='rohit'");
// 	if(mysqli_num_rows($result)>0){
//      $row=mysqli_fetch_array($result);
//      $hash=$row['pass'];
//      if(password_verify('rohit',$hash))
//      	echo "   valid";
//      else
//      	echo "   invalid";
// 	}

?>