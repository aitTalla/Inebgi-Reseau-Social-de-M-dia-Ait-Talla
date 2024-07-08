<?php

/*  En Verifies Les Connection De La Sessions   */
if (!session_start()) 
{session_start();}

/*  En Charge Tout Les Class Qui Le Faux */
require 'app/libs/php/class/conf.php';
require 'app/libs/php/class/users.php';

/*  En Cherche Un Uttulisateur Si Il Est Connecter En Le Mets Dans La Variable $accounts */
$account = isset($_SESSION["username"]) ? $MGuser->searchUserByUsername(htmlspecialchars($_SESSION['username'])) : false;


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= conf::$name . " - " .conf::$nameCorp ?></title>

    <link rel="stylesheet" type="text/css" href="/app/libs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/app/libs/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="/app/libs/css/semantic.min.css">
    
    <link rel="stylesheet" type="text/css" href="/app/libs/css/style.light.css">


</head>
<body>

<!--  Debut De La Nav bar -->
<?php include 'app/libs/html/nav_bar.php';?>
<!--  Fin De La Nav bar -->

<div class="ui">
  <div class="ui d-flex justify-content-center">
  
    <div class="col-lg-8">

      <?php 

      if($_SESSION["username"] == $account["username"] && isset($_SESSION['login']))
      {
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

  
  <div id="postsPanels">
    

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

panel = $("#postsPanels");
  
getRandomPosts(panel);
getRandomPosts(panel);
getRandomPosts(panel);
var doc = $(document), w = $(window), timer;

doc.on('scroll', function(){

    if(doc.scrollTop() + w.height() >= doc.height()-100){

        if(typeof timer !== 'undefined') clearTimeout(timer);

        timer = setTimeout(function(){
            getRandomPosts(panel);
            getRandomPosts(panel);
            getRandomPosts(panel);
            getRandomPosts(panel);
            console.log('end of page');
        }, 10);

    }

});

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

</script>