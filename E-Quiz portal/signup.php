<?php
if(!empty($_POST['susername'])&&!empty($_POST['spwd'])){
  
  $user=$_POST['susername'];
  $password=password_hash($_POST['spwd'],PASSWORD_DEFAULT);
  $result=mysqli_query($con,"insert into utcet values('$user','$password',0)");
  if($result): ?>


    <script>
    
    alert("success");
    window.location.href='index.php';</script>
  
  <?php else: ?>
<script type="text/javascript">
  alert('Username already exist');
  window.location.href='index.php';
</script>
<?php
endif;
  
}
?>
  <!-- Modal -->
  <!-- <div class="modal fade" id="signup" role="dialog" onload="clearInputs()">
    <div class="modal-dialog"> -->
    
      <!-- Modal content-->
      <!-- <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sign Up</h4>
        </div>
        <div class="modal-body"> -->
        <!-- <form action="" method="post"> -->
  <!--<div class="form-group">
    <label for="fname">First Name:</label>
    <input type="text" class="form-control" name="fname">
  </div>
  <div class="form-group">
    <label for="lname">Last Name:</label>
    <input type="text" class="form-control" name="lname">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email">
  </div>  -->
   <!-- <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="susername">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="spwd">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="clearInputs()">Close</button>
        </div>
      </div>
      
    </div>
  </div> -->


  <!-- Modal Structure -->
  <div id="signup" class="modal"  onpageshow="clearInputs()">
    <div class="modal-content">
      <h4>SignUp</h4>
      <form action="" method="post">
  <!--<div class="form-group">
    <label for="fname">First Name:</label>
    <input type="text" class="form-control" name="fname">
  </div>
  <div class="form-group">
    <label for="lname">Last Name:</label>
    <input type="text" class="form-control" name="lname">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email">
  </div>  -->
   <div class="input-field">
    <input type="text" class="validate" name="susername">
    <label for="username">Username</label>
  </div>
  <div class="input-field">
    <input type="password" class="validate" name="spwd">
    <label for="pwd">Password:</label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"  onclick="clearInputs();return false;">Close</a>
    </div>
  </div>

