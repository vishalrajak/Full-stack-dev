<script type="text/javascript">
  $(document).ready(function(){
    if($('#navno').length==0){
      return;
    }
    var no=$('#navno').val();
    var e=$('ul li')[no];//select all li having parent ul
    var me=$('.side-nav li')[no];//for mobile nav
    //console.log(me);
    e.classList.add('active');
    me.classList.add('active');

  });


  $(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $(".button-collapse").sideNav();
  });
</script>
<div >
    <nav>
      <div class="nav-wrapper deep-orange accent-4">
      <a href="index.php" class="brand-logo center" id="logo">MyFreeTest</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="hide-on-med-and-down"  >
        <li><a href="index.php">Home</a></li>
         <?php
        
          if(empty($_SESSION['user'])): ?>
        <li><a href="select-test.php">Active tests</a></li>
      <?php endif; ?>
       <?php if(!empty($_SESSION['user'])): ?>
<li><a href="show-titles.php">My Tests</a></li>
<li><a href="student-details.php">Student Details</a></li>
<?php endif;   ?>
        <li><a href="about.php">About</a></li>  
      </ul>
      <ul class="right hide-on-med-and-down hlogin">
      <?php if(empty($_SESSION['user'])): ?>
        <li><a class="waves-effect waves-light btn modal-trigger"  href="#signup">Sign Up</a></li>
        <?php endif; ?>


        <li><a  <?php if(empty($_SESSION['user'])){echo 'class="waves-effect waves-light btn modal-trigger"   href="#login"';}else{echo 'href="logout.php"';}   ?> ><?php if(empty($_SESSION['user'])){echo ' login';}else{echo ' logout '.$_SESSION['user'];}  ?></a></li>
      </ul>
      

      <ul class="side-nav" id="mobile-demo">
        <li><a href="index.php">Home</a></li>
         <?php
        
          if(empty($_SESSION['user'])): ?>
        <li><a href="select-test.php">Active tests</a></li>
      <?php endif; ?>
       <?php if(!empty($_SESSION['user'])): ?>
<li><a href="show-titles.php">My Tests</a></li>
<li><a href="student-details.php">Student Details</a></li>
<?php endif;   ?>
        <li><a href="about.php">About</a></li>
        <?php if(empty($_SESSION['user'])): ?>
        <li class="hlogin"><a class="waves-effect waves-light btn modal-trigger"  href="#signup">Sign Up</a></li>
        <?php endif; ?>


        <li class="hlogin"><a  <?php if(empty($_SESSION['user'])){echo 'class="waves-effect waves-light btn modal-trigger"   href="#login"';}else{echo 'href="logout.php"';}   ?> ><?php if(empty($_SESSION['user'])){echo ' login';}else{echo ' logout '.$_SESSION['user'];}  ?></a></li>  
      </ul>
      </div>
    </nav>
  </div>
