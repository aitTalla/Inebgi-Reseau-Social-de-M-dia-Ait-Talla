<?php

require '../class/conf.php';
require '../class/users.php';
require '../class/post.php';

function widgetPost($post)
{
    $MGpost = new posts();
    
    $MGuser = new users();

    $description = '<div class="h2 text-center w-100 mb-2 p-2">
        '.$post["description"].'
      </div>';
    $images = '<img style="max-height: 500px;width: auto;max-width: 100%;" src="/app/media/imgs/'.$post["covers"].'" id="imgsPost">';

    $content = empty($post["covers"]) ? $description : $images;

    $delete = ($post["author"] == $_SESSION['username']) ? '<a onclick="deletePost(\''.
    
    $post["id"].'\',$(this))"  class="btn btn-danger"><i class="fa fa-trash"></i></a>' : $post["dateUploade"] ;


    return ('<div class="ui card w-100" id="post'.$post["id"].'">
    <div class="content">
      <div class="right floated meta">'.$delete.'</div>
      <img class="ui avatar image" src="/app/media/imgs/'.(empty($MGuser->searchUserByUsername($post["author"])["avatar"]) ? "matthew.png" : $MGuser->searchUserByUsername($post["author"])["avatar"] ).'"> <a href="/pages/profile.php?usr='.$post["author"].'">'.$post["author"].'</a>
    </div>
    <div class="image d-flex align-items-center justify-content-center" style="min-height: 100px;">

     '.$content.'
      
    </div>
    <div class="content">
      '.
      (!empty($post["covers"]) ? '<div class="description mb-2">'.$post["description"].'</div>' : "")
      .'
      <span class="right floated">
       <div class="ui labeled button" '.
      (isset($_SESSION["username"]) ? 'onclick="likePostByID('.$post["id"].',$(this))"' : "")
      .' tabindex="0">

        <div class="ui '.
      ($MGpost->is_userLikePost($_SESSION["username"],$post["id"]) ? "red" : "")
      .' button">
          <i class="fa fa-heart"></i>
        </div>
        <a class="ui basic '.
      ($MGpost->is_userLikePost($_SESSION["username"],$post["id"]) ? "red" : "")
      .' left pointing label">
          '.$post["likeLen"].'
        </a>

      </div>

      </span>
      <div class="ui labeled button" tabindex="0">
        <div class="ui info button">
          <i class="fa fa-comments"></i> Comments
        </div>
        <a class="ui basic info left pointing label">
          '.$post["commentLen"].'
        </a>
      </div>
    </div>
    <div class="extra content">
      <div class="ui transparent left icon input">
        <i class="fa fa-comment"></i>
        <input type="text" placeholder="Add Comment...">
      </div>
        </div>
      </div>
    </div>
  </div>');
}

if (isset($_GET["getLastPostUser"])) 
{
  $usr = htmlspecialchars($_GET['usr'],ENT_QUOTES);
  $post = $MGpost->getLastPostUser($usr);

  echo widgetPost($post);
}


if (isset($_GET["getRandomPosts"])) {
    $post = $MGpost->getRandomPosts();
    if (empty($post)) {
      $post["author"] = "Inebgi Bots";
      //$post["covers"] = "matthew.png";
      $post["likeLen"] = "23";
      $post["commentLen"] = "23";

      $post["description"] = "<a class='text-danger'>Not Post Found !</a><br> Start Create Your Own Post  &#129409; !<br> <a href='/login.php' class='text-info'>&#128151; Click Here To join ! &#128151;</a>";
    }
    echo widgetPost($post);

}


if (isset($_GET['getsPostUser'])) {

  $posts = $MGpost->getsPostUser(htmlspecialchars($_GET["usr"]),ENT_QUOTES);


  while ($post = mysqli_fetch_assoc($posts)) {
    echo widgetPost($post);
  }
  die();
}

if (isset($_POST['addPost'])) 
{
  $author      = htmlspecialchars($_POST['author'],ENT_QUOTES);
  $description = htmlspecialchars($_POST['description'],ENT_QUOTES);
  $cover       = htmlspecialchars($_POST['cover'],ENT_QUOTES);

  if (isset($_SESSION['login']) && $_SESSION['username'] == $author) {
    if($MGpost->addPostLittel($author,$description,$cover))
    {
      echo "done";
    }else{
      echo 0;
    }
  }

}

if (isset($_POST['deletePost'])) 
{
  $id      = (int)htmlspecialchars($_POST['id'],ENT_QUOTES);
  $post    = $MGpost->getsPostByID($id);

  if (isset($_SESSION['login']) && $_SESSION['username'] == $post["author"]) {
    if($MGpost->deletePost($id))
    {
      echo "done";
    }
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

//likePost
if (isset($_POST['likePostByID'])) 
{
  $id      = (int)htmlspecialchars($_POST['id'],ENT_QUOTES);

  if(isset($_SESSION['login']) && $MGpost->likePostByID($_SESSION['username'],$id))
  {
    echo "done";
  }
}

//likePost
if (isset($_POST['dislikePostByID'])) 
{
  $id      = (int)htmlspecialchars($_POST['id'],ENT_QUOTES);

  if(isset($_SESSION['login']) && $MGpost->dislikePostByID($_SESSION['username'],$id))
  {
    echo "done";
  }
}

?>