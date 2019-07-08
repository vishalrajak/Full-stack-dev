<?php
session_start();

  include("conn.php");
  
  if(!empty($_SESSION['exam_over'])){
    header('location:select-test.php');
  }
  unset($_SESSION['selected-ans']);
    

?>

<!DOCTYPE html>
<html>
  <head>
  <title>Test</title>
    <meta charset="utf-8">
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/common.css">
      <link rel="stylesheet" type="text/css" href="css/give-test.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/give-test.css">
     <link rel="stylesheet" type="text/css" href="css/common.css"> -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/give-test.js"></script>
    
    <script type="text/javascript">
       $(document).ready(function(){
      $('.modal').modal({dismissible:false});
    });
    </script>
    <style type="text/css">
      #give-test-question{
        text-align: left;
      }
      #options label{
        color:#00838f;
      }
     
    </style>
<?php
if(empty($_GET['professor'])||empty($_GET['test'])||empty($_GET['join'])||empty($_GET['divison'])||empty($_GET['roll_no'])||empty($_GET['pass'])):  ?>
  <script type='text/javascript'>
  alert('Please Fill All The Details');
  window.location.href='select-test.php';
</script>
<?php
elseif(empty($_SESSION['test_status']) || $_SESSION['test_status']['formn']!=$_GET['test']  || $_SESSION['test_status']['professor']!=$_GET['professor']):
?>
 <script type='text/javascript'>
  alert('Something went Wrong With Verification');
  window.location.href='select-test.php';
</script> 
<?php else:  ?>
    
  </head>

  <body onload="give_test('<?php echo $_GET['professor']?>','<?php echo $_GET['test']?>')">
<!--Import jQuery before materialize.js-->
     
      <script type="text/javascript" src="js/materialize.min.js"></script>
<?php

    include('header.php');
    $_SESSION['uid1'] = $_GET['join']."-".$_GET['department'].$_GET['divison'].$_GET['roll_no']."-".$_GET['pass'];
     $result=mysqli_query($con,"select uid from marks where uid='".$_SESSION['uid1']."' and professor='".$_GET['professor']."'  and fnumber='".$_GET['test']."'");
     if(mysqli_num_rows($result)>=1){
     unset($_SESSION['uid1']);
     echo "<script type='text/javascript'>
  alert('Current Test Is Already Given Using This UID');
  window.location.href='select-test.php';
</script>";
     }
    ?>
    <div class="container">
    <div id="test-page-main">
      <div id="question-container">
        <div id="give-test-question" class="grey lighten-3">
        <div class="bubblingG" id="loading">
  <span id="bubblingG_1">
  </span>
  <span id="bubblingG_2">
  </span>
  <span id="bubblingG_3">
  </span>
   </div>
          <div id="give-test-question-1">
            <p id="question-paragraph"></p>
            <div id="options">

            </div>
          </div>
      </div>
      <div id="paging" class="grey lighten-3">
            <div id="paging-1">
              <div>
                <a href="#" onclick="option_checked(); save(); previous()" class="btn previous">Previous</a>
              </div>
              <div>
                <button data-target="myModal" class="btn modal-trigger" onclick="option_checked(); save();">Submit</button>
              </div>
              <div>
                <a href="#" onclick="option_checked(); save(); next();" class="btn next">Next</a>
              </div>


            </div>

          </div>

          <div  class="card red darken-4">
            <div class="card-content white-text" id="note">
              <span class="card-title">Warning!</span>
              <p>Reloading or Leaving The Test In Between Will Result In Loss Of Your Progress</p>
            </div>
            </div>

      </div>
      <div id="question-list">
        <div class="list-group" id="questions">

        </div>
      </div>
      
        </div>



  <div id="myModal" class="modal">
    <div class="modal-content">
      <h4>Submit Test</h4>
       <p>Do you want to submit your test?</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
          <a href='test-validator.php?prof=<?php echo $_GET["professor"] ?>&test=<?php echo $_GET["test"]?>' class="btn">Submit</a>
    </div>
  </div>

</div>
<?php
mysqli_close($con);
endif;
?>
  </body>
</html>
