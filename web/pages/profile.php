<?php
require '../app/libs/php/class/conf.php';
require '../app/libs/php/class/users.php';

if (isset($_GET["usr"]) && !empty($_GET["usr"])) 
{
  if (!$MGuser->isUserExiste(htmlspecialchars($_GET["usr"]))) {
    die("user Not Found !");
  }
  $account = $MGuser->searchUserByUsername(htmlspecialchars($_GET['usr']));
}else{
  if (isset($_SESSION["username"])) {
    $account = $MGuser->searchUserByUsername(htmlspecialchars($_SESSION['username']));
  }else{
    die("user not set !");
  }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>inebgi - <?= $account["username"] ?></title>

    <link rel="stylesheet" type="text/css" href="/app/libs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/app/libs/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="/app/libs/css/semantic.min.css">
    
    <link rel="stylesheet" type="text/css" href="/app/libs/css/style.light.css">


</head>
<body>


<!--  Debut De La Nav bar -->
<?php include '../app/libs/html/nav_bar.php';?>
<!--  Fin De La Nav bar -->

<div class="ui">
  <div class="ui d-flex justify-content-center">
  
    <div class="col-lg-8">


      <div class="col-12 p-0" style="margin-bottom: 70px;">
        <div class="card d-flex align-items-center">
          <div id="coverIamgeUser" <?= $isConnected ? 'onclick="$(\'#fileCoverImg\').click()"' : "" ?> style="width: 100%;height: 230px;background: #111;background-image : url('/app/media/imgs/<?= $account["coverImg"] ?>');background-size: 100%;background-position: center;border-radius: 10px;">
          </div>
          <div class="position-absolute top-100 start-50 translate-middle">
            <?php

            if($isConnected)
            {
              echo '<input style="display: none" type="file" id="fileAvatarImg" onchange="uploadAvatarUsers()">
                    <input style="display: none" type="file" id="fileCoverImg" onchange="uploadCoverUsers()">
                    ';
            }
            ?>

            <img <?= $isConnected ? 'onclick="$(\'#fileAvatarImg\').click()"' : "" ?> id="imageAvatras" style="width:130px;height: 130px;border-radius: 50%;border: 1px solid #fff;" src="/app/media/imgs/<?= $account["avatar"] ?>">
          </div>
        </div>
      </div>
      <div class="col-12 d-flex flex-column align-items-center justify-content-center">
            <h2 class="m-0"><?= $account["username"] ?></h2>
        <p class="m-0 w-50 text-center text-secondary text-muted"><?= $account["description"] ?></p>
        <p class="mt-3"><?= $account["creation_date"] ?></p>
      </div>

      <div class="ui menu my-2">
        <div class="item active">
          <i class="fa fa-image mx-2"></i>
          Posts
        </div>
        <a class="item">
          <i class="fa fa-pen mx-2"></i>
          About Us
        </a>
        <a class="item">
          <i class="fa fa-users mx-2"></i>
          Frinds <div class="mx-1 pink"><?= $account["folowerLen"] ?></div>
        </a>
        <a class="right item">
          <i class="fa fa-cog mx-2"></i>
          Settings
        </a>
      </div>









      <?php 

      if($isConnected)
      {
      /*echo '<div class="ui ordered steps w-100">
        <div class="completed step">
          <div class="content">
            <div class="title">update Your Avatars </div>
            <div class="description">Choose your shipping options</div>
          </div>
        </div>
        <div class="completed step">
          <div class="content">
            <div class="title">Billing</div>
            <div class="description">Enter billing information</div>
          </div>
        </div>
        <div class="active step">
          <div class="content">
            <div class="title">Confirm Order</div>
            <div class="description">Verify order details</div>
          </div>
        </div>
      </div>'*/
        echo '
      <div class="ui card w-100">
        <div class="content">
          <div class="right floated meta"><?= date("d/m/Y h:i:s")?></div>
          <img class="ui avatar image" style="" src="/app/media/imgs/'. $account["avatar"] .'"> 
          '. $account["username"] .'
          </div>

        <div class="image">
          <div class="ui form">
          <textarea id="qsdmkpvob" style="min-height:100px;height: 100px;" placeholder="Post Text here ..."></textarea>
          </div>
          <div class="d-flex" id="posetedImageUploaded">

            
          </div>
        </div>

        <div class="ui right aligned p-2">
          <div class="ui animated button btn btn-lg primary" onclick="addPostLittel(\''.$account["username"].'\',$(\'#qsdmkpvob\')[0],\'\',postImage,$(this))" tabindex="0">
            <div class="visible content">post</div>
            <div class="hidden content">
              <i class="fa fa-arrow-right"></i>
            </div>
            </div>

          <input type="file" style="display: none;" onchange="uploadImage()" id="fileImagesCovers" name="" />
          
          <div class="ui animated button btn btn-lg primary" onclick="$(\'#fileImagesCovers\').click()" tabindex="0">

            <div class="visible content">image</div>
            <div class="hidden content">
              <i class="fa fa-image"></i>
            </div>
            </div>
        </div>
      </div>
        ';
      }
      ?>


  <div id="myPostsPanels">


  </div>
  </div>


  </div>

</div>


</body>
</html>
<script type="text/javascript" src="/app/libs/js/jquery.min.js"></script>
<script type="text/javascript" src="/app/libs/js/semantic.min.js"></script>
<script type="text/javascript" src="/app/libs/js/app.js"></script>

<script type="text/javascript">

panel = $("#myPostsPanels");

getMyPosts('<?= $account["username"] ?>',panel);



postImage = [];


function uploadImage() {
    var file_data = $('#fileImagesCovers').prop('files')[0];
    
    if(file_data == '')
    {
        return 0;
    }


    var form_data = new FormData();
        form_data.append('file', file_data);

    $.ajax({
                url         : '/app/libs/php/api/posts.php',
                dataType    : 'text',           // what to expect back from the PHP script, if anything
                cache       : false,
                contentType : false,
                processData : false,
                data        : form_data,                         
                type        : 'post',
                success     : function(output){
                  if (output == "0")
                  {
                    console.log("Fail !");              // display response from the PHP 
                  }else{
                    postImage[0] = output;
                    console.log(output);              // display response from the PHP 
                    $("#posetedImageUploaded").append('<div class="col-2 m-2" style="max-height: 200px;"><img class="w-100" src="/app/media/imgs/'+output+'"></div>');
                  }

                }
         });
}


function uploadAvatarUsers() {
    var file_data = $('#fileAvatarImg').prop('files')[0];
    
    if(file_data == '')
    {
        return 0;
    }


    var form_data = new FormData();
        form_data.append('file', file_data);

    $.ajax({
                url         : '/app/libs/php/api/user.php',
                dataType    : 'text',
                cache       : false,
                contentType : false,
                processData : false,
                data        : form_data,                         
                type        : 'post',
                success     : function(output){
                  if (output == "0")
                  {
                    console.log("Fail !");
                  }else{
                    $rep = updateUserAvatar("<?= $_SESSION['username']?>",output);
                    console.log($rep);              // display response from the PHP 
                    if (true)
                    {
                      $("#imageAvatras")[0].src = "/app/media/imgs/"+output;
                    }
                  }

                }
         });
}


function uploadCoverUsers() {
    var file_data = $('#fileCoverImg').prop('files')[0];
    
    if(file_data == '')
    {
        return 0;
    }


    var form_data = new FormData();
        form_data.append('file', file_data);

    $.ajax({
                url         : '/app/libs/php/api/user.php',
                dataType    : 'text',
                cache       : false,
                contentType : false,
                processData : false,
                data        : form_data,                         
                type        : 'post',
                success     : function(output){
                  if (output == "0")
                  {
                    console.log("Fail !");
                  }else{
                    $rep = updateCover("<?= $_SESSION['username']?>",output);
                    console.log(output);              // display response from the PHP 
                    if (true)
                    {
                      $("#coverIamgeUser").css("background-image","url('/app/media/imgs/"+output+"')");
                    }
                  }

                }
         });
}
</script>