<?php

require '../class/conf.php';
require '../class/users.php';


if (isset($_GET['getUserForloginControle'])) 
{
    $user = $MGuser->searchUserByUsername(htmlspecialchars($_GET['usr']));
    if (!empty($user["username"])) {
        echo '<a class="ui label"><img class="ui right spaced avatar image" src="/app/media/imgs/'.$user["avatar"].'">'.$user["username"].'</a>';
    }else{
        echo "not founds !";
    }
}

//isUserExisted
if (isset($_GET['isUserExisted'])) 
{
    $rep = $MGuser->isUserExiste(htmlspecialchars($_GET['usr']));
    if ($rep) {
        echo "1";
    }else{
        echo '0';
    }
}

if (isset($_POST['userLoginCheks'])) {
    $usr = htmlentities($_POST['usr']);
    $psw = htmlentities($_POST['psw']);

    if ($MGuser->userLoginCheks($usr,hash("sha256",$psw))) {
        echo "1";
        conf::login($usr);
    }else{
        echo "0";
    }
}

if (isset($_GET['logout'])) {
    if (session_start()) {
        session_destroy();
        header("location: /index.php");
    }
    header("location: /index.php");
}


if (isset($_POST['registerUser'])) {
    $usr = htmlspecialchars($_POST['usr']);
    $psw = htmlspecialchars($_POST['psw']);
    $gen = (int)htmlspecialchars($_POST['gender']);

    if ($MGuser->registerLitel($usr,hash("sha256", $psw),$gen)) {
        conf::login($usr);
        echo "done";
    }else{
        echo "fail";
    }
}


//updateAvatar
if (isset($_POST['updateAvatar'])) {
    $usr = htmlspecialchars($_POST['usr']);
    $img = htmlspecialchars($_POST['img']);
    if ($_SESSION["username"] != $usr) {
        die("fail");
    }

    if ($MGuser->updateAvatar($usr,$img)) {
        echo "done";
    }else{
        echo "fail";
    }
}
//updateCover
if (isset($_POST['updateCover'])) {
    $usr = htmlspecialchars($_POST['usr']);
    $img = htmlspecialchars($_POST['img']);
    if ($_SESSION["username"] != $usr) {
        die("fail");
    }

    if ($MGuser->updateCover($usr,$img)) {
        echo "done";
    }else{
        echo "fail";
    }
}


if (isset($_FILES["file"])) {
  if (in_array($_FILES["file"]["type"], ["image/png","image/jpeg","image/jpg"])) {
    $fileName = md5(base64_encode(random_bytes(12))).".".str_replace("image/", "", $_FILES["file"]["type"]);
    if (move_uploaded_file($_FILES['file']["tmp_name"], '../../../media/imgs/'.basename($fileName))) {
      //var_dump($_FILES['file']);
      echo $fileName;
    }

  }else{
    echo "0";
  }
}