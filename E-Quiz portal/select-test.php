<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Select Test</title>
    <meta charset="utf-8">
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/common.css">
      <link rel="stylesheet" type="text/css" href="css/select-test.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/give-test.css">
     <link rel="stylesheet" type="text/css" href="css/common.css"> -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/getTests.js"></script>
   
  </head>
  <body onpageshow="reset();">
  <script type="text/javascript" src="js/materialize.min.js"></script>
    <?php
    include('conn.php');
    //print_r($_SESSION['test_status']);

    unset($_SESSION['exam_over']);
    unset($_SESSION['selected-ans']);
    unset($_SESSION['uid1']);
    unset($_SESSION['test_status']);
  
    include('login.php');
    include('signup.php');
    include('header.php');


    ?>
    <?php
    $tests=mysqli_query($con,"select username from utcet");

    ?>
    <br>
    <br>
    <br>
    <div id="pick-test" class="container">
      <form method="get" action="give-test.php">
        <div class="input-field joining-year">
        <select  id="join"  name="join">
          <option disabled selected value="0">Choose...</option>
          <?php for ($i=2001; $i <=date("Y") ; $i++) {
            echo "<option value=".$i.">".$i."</option>";
          } ?>
        </select>
        <label>joining Year</label>
        </div>
        <div class="input-field ">
        <select  id="department"  name="department">
          <option disabled selected value="0">Choose...</option>
          <option value="cmpn">CMPN</option>
          <option value="it">IT</option>
          <option value="etrx">ETRX</option>
          <option value="extc">EXTC</option>
        </select>
        <label for="department">Department</label>
        </div>
        <div class="input-field ">
        <select  id="divison"  name="divison">
          <option disabled selected value="0">Choose...</option>
          <option value="a">A</option>
          <option value="b">B</option>
        </select>
        <label for="divison">Divison</label>
        </div>
        <div class="input-field ">
        <select  id="roll_no"  name="roll_no">
          <option disabled selected value="0">Choose...</option>
          <?php
          for ($i=1; $i < 91; $i++) {
          echo  "<option value=".$i.">".$i."</option>";
          }
          ?>
        </select>
        <label for="roll_no">Roll no.</label>
        </div>
        <div class="input-field ">
        <select  id="pass"  name="pass" >
          <option disabled selected value="0">Choose...</option>
          
        </select>
        <label for="pass">Passing year</label>
        </div>
      <div class="input-field " id="select-prof-div">
      <select   name='professor'  id="select-professor">
      <option disabled selected value="0">Select a Professor</option>
      <?php
      while($row = mysqli_fetch_assoc($tests))
      echo "<option  value=".$row['username'].">".$row['username']."</option>"
      ?>

      </select>
      <label>Select professor:</label>
      </div>
           <div class="bubblingG" id="loading">
  <span id="bubblingG_1">
  </span>
  <span id="bubblingG_2">
  </span>
  <span id="bubblingG_3">
  </span>
   </div>
      <div id="select_test" class="input-field" onchange="showPassword()">
      <select   name='test' id="test-list" ><!--test is form no. of that professor -->

      </select>
      <label>Select test:</label>
      </div>
      <button type="submit" class="btn btns" id="give-test">Give Test</button>
      </form>

<div id="test-verification" class="input-field">
  

</div>


    </div>
    <input type="hidden" id="navno" value="1" />
  </body>
</html>
