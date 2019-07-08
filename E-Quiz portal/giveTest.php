<?php
session_start();
    include("conn.php");
    
    $query = 'select fnumber,question,options,qno from forms where username="'.$_GET['prof'].'" AND fnumber='.$_GET['test'].' order by qno';
    $questions = mysqli_query($con,$query);
    $question = array();
    while($row = mysqli_fetch_assoc($questions))
    {
      $question[] = $row;
    }
    echo json_encode($question);
?>
