  <script type="text/javascript">
    function clearInputs(){
      
      var inputs=document.getElementsByTagName("input");
      var ninputs=inputs.length;
      for(var i=0;i<ninputs;i++){
        inputs[i].value="";
        //console.log(inputs[i].value);
      }
    
      
    }

    $(document).ready(function(){
      $('.modal').modal({dismissible:false});
    });
  </script>
  <!-- Modal -->
  <?php
if(!empty($_POST['username'])&&!empty($_POST['pwd'])){
  $query="select username,pass from utcet where username='".$_POST['username']."'";
  $result=mysqli_query($con,$query);
  if(mysqli_num_rows($result)==1){
    $row=mysqli_fetch_array($result);
    $hash=$row['pass'];
    if (password_verify($_POST['pwd'],$hash)) {
    $_SESSION['user']=$_POST['username'];
    echo "<script>window.location.href='index.php';</script>;";
}
else {
    echo '<script>alert("Password is invalid!");</script>';
}
  }
  else{
    echo '<script>alert("Invalid Username!");</script>';
  }
}

  ?>
  <!-- <div class="modal fade" id="login" role="dialog" onload="clearInputs()">
    <div class="modal-dialog">
     -->
      <!-- Modal content-->
      <!-- <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login</h4>
        </div>
        <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="pwd">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="clearInputs()" >Close</button>
        </div>
      </div>
      
    </div>
</div>
 -->

  <!-- Modal Structure -->
  <div id="login" class="modal" onpageshow="clearInputs()">
    <div class="modal-content">
      <h4>Login</h4>
      <form action="" method="post">
          <div class="input-field">
            <label for="username">Username:</label>
            <input type="text" class="validate" name="username">
          </div>
          <div class="input-field">
            <label for="pwd">Password:</label>
            <input type="password" class="validate" name="pwd">
          </div>
          <button type="submit" class="btn">Submit</button>
        </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"onclick="clearInputs();return false;">Close</a>
    </div>
  </div>

