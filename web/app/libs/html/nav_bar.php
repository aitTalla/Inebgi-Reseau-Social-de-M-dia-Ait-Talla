<?php
$myAccounts = isset($_SESSION["username"]) ? $_SESSION["username"] : false;

?>
<div class="d-flex justify-content-center mb-3">

<div class="col-12 col-lg-8">
<div class="ui secondary menu w-100 p-1" style="border-radius: 5px;">
  <a class="item">
    <i class="fa fa-chess" style="font-size: 36px;color: #F43B5C;"></i>
  </a>
  <a href="/" class="active item">
    Home
  </a>

 <!--  <a class="item">
     <i class="fa fa-box mx-2"></i> 
     Messages
    <!-- <div class="floating ui red label">+9</div> -->
  </a>

  <a class="item">
    <i class="fa fa-users mx-2"></i> Friends
  </a> 

  <?= 
    !empty($myAccounts) ? '<a href="/pages/profile.php?usr='.$myAccounts.'" class="item"><i class="fa fa-user mx-2"></i> '.$myAccounts .' </a>' : '' ?>
  <div class="right menu">
    <div class="item">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="search's ... " aria-label="Recipient's username" aria-describedby="basic-addon2">
        <a href="#" class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></a>
      </div>

    </div>
    <?= 
    !empty($myAccounts) ? '<a class="ui item" href="/app/libs/php/api/user.php?logout=1">log-out <i class="fa fa-arrow-right mx-2"></i></a>' : '<a class="ui item" href="/pages/login.php">log-in <i class="fa fa-arrow-right mx-2"></i></a>' ?>
  </div>
</div>
</div>


</div>