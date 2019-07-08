<?php  
if(empty($_GET['prof']) || empty($_GET['test']) || empty($_GET['uid'])){
header('location:select-test.php');
}
?>
<html>
<head>
  <title>Result</title>
   <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/common.css">
      <link rel="stylesheet" type="text/css" href="css/report.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/give-test.css">
     <link rel="stylesheet" type="text/css" href="css/common.css"> -->

     
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script> 
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.28/jspdf.plugin.autotable.js"></script>
     <script type="text/javascript">
        function genPDF(){
        document.getElementById("container1").style.display="block";
      var doc = new jsPDF('p', 'pt');
      var elem = document.getElementsByTagName('table')[3];
           var data = doc.autoTableHtmlToJson(elem);

  doc.autoTable(data.columns, data.rows,{startY:20});
      
      //doc.addPage();//second page added
      for(var i=4;i<=5;i++){
      //doc.setPage(i-2);//starting from 1 so i-2 i.e  3-2=1
          var elem = document.getElementsByTagName('table')[i];
           var data = doc.autoTableHtmlToJson(elem);

  doc.autoTable(data.columns, data.rows,{startY:doc.autoTableEndPosY()+20});
}
//doc.setPage(1);
//doc.text(str,100,40);//always use text method after autoTable
    document.getElementById("container1").style.display="none";
    doc.output('save',document.getElementById('uid-for-pdf').innerText+".pdf");

       }
     </script>
     <style type="text/css">
        #container1{
      text-align: left;

      }

      td{
        word-wrap: break-word;
      }

      
     </style>
      
</head>
<body>
 <!--Import jQuery before materialize.js-->
     
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <?php
     include('header.php');

      ?>
  <div class="container">
  <?php
  include('conn.php');
  $test=mysqli_query($con,"select title from gen_forms where username='".$_GET['prof']."' and fnumber=".$_GET['test']."");
  $marksdb=mysqli_query($con,"select * from marks where uid='".$_GET['uid']."' and professor='".$_GET['prof']."' and fnumber=".$_GET['test']."");
  ?>
  <table class="bordered">
    <tr>
      <td colspan="2"><p>Professor Name: <?php echo $_GET['prof']; ?></p></td>
    </tr>
    <tr>
      <td colspan="2"><p>Test Name: <?php $t=mysqli_fetch_assoc($test); echo $t['title']."<br />";?></p></td>
    </tr>
  </table>
  <br /><br />
  <p>UID: <?php echo strtoupper($_GET['uid']);  ?></p>
  <table class="bordered">

    <?php

    $row=mysqli_fetch_array($marksdb);
     $coption=explode(";",$row['details']);
     //echo sizeof($coption);
    for($i=1;$i<=intval($row['number_of_question']);$i++){
      if (array_search($i,$coption)!==false) {
        echo "<tr><td>Question ".$i."</td><td><i class='material-icons dp48'>check</i></td></tr>";
      }
      else {
        echo "<tr><td>Question ".$i."</td><td><i class='material-icons dp48'>clear</i></td></tr>";
      }
    }
    ?>
  </table>

  <table class="bordered">
    <tr>
      <td>
        Correct Answer's : <?php echo $row['score']; ?>
      </td>
    </tr>
    <tr>
      <td>
        Wrong Answer's : <?php echo intval($row['number_of_question'])-sizeof($coption); ?>
      </td>
    </tr>
    <tr>
      <td>
        Total marks : <?php echo $row['score']; ?>
      </td>
    </tr>
  </table>



  <div id="container1">
  
  <table>
    <tr><th>Professor Name</th><th>Test Name</th><th>UID</th></tr>
    <tr><td><?php echo $_GET['prof']; ?></td><td><?php echo $t['title'];?></td><td id="uid-for-pdf"><?php echo strtoupper($_GET['uid']);  ?></td></tr>
  </table>

  <div>
  <table>
<tr><th>Question</th><th>Status</th></tr>
    <?php

     $coption=explode(";",$row['details']);
     //print_r($coption);
    for($i=1;$i<=intval($row['number_of_question']);$i++){
      if (array_search($i,$coption)!==false) {
        echo "<tr><td>Question ".$i."</td><td>Correct</td></tr>";
      }
      else {
        echo "<tr><td>Question ".$i."</td><td>Wrong</td></tr>";
      }
    }

   
    ?>
  </table>
  </div>


<div >
  <table >
  <tr colspan="2"><th>Score</th></tr>
    <tr>
      <td>
        Correct Answer's : <?php echo $row['score']; ?>
      </td>
    </tr>
    <tr>
      <td>
        Wrong Answer's : <?php echo intval($row['number_of_question'])-sizeof($coption); ?>
      </td>
    </tr>
    <tr>
      <td>
        Total marks : <?php echo $row['score']; ?>
      </td>
    </tr>
  </table>
  </div>
  </div>
  <button class="btn" onclick="genPDF();">Generate Pdf</button>
</div>
</body>
</html>
