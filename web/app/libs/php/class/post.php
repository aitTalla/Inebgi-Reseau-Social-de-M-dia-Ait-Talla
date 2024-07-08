<?php 

/**
 * 
 */
class posts
{
    
    function __construct()
    {
        /*if (!class_exists(conf)) {
            die("the script user need conf.php include !");
        }*/
    }

    public function getRandomPosts()
    {
        $req = "SELECT * from posts ORDER BY RAND() LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        if (!$req) {
            return false;
        }
        return mysqli_fetch_assoc($req);
    }

    public function getsPostUser($username)
    {
        $req = "SELECT * from posts WHERE author='$username' ORDER BY id desc";
        $req = mysqli_query(conf::DB(),$req);
        if (!$req) {
            return false;
        }
        return $req;
    }

    public function getsPostByID($id)
    {
        $req = "SELECT * from posts WHERE id=$id LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        return mysqli_fetch_assoc($req);
    }
    public function getLastPostUser($usr)
    {
        $req = "SELECT * from posts WHERE author='$usr' ORDER BY id desc LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        return mysqli_fetch_assoc($req);
    }

    public function addPostLittel($author,$description,$cover)
    {
       $req = "insert into posts(author,description,covers,likeLen,commentLen,commentsToken,likesUsers) VALUES('$author','$description','$cover',0,0,'".base64_encode(random_bytes(24))."','bot , ')";
        $req = mysqli_query(conf::DB(),$req);
        return (bool)$req;
    }

    public function deletePost($id)
    {
       $req = "DELETE FROM posts WHERE id=$id LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        return (bool)$req;
    }

    public function is_userLikePost($usr,$id)
    {
        if (empty($usr)) {
            return false;
        }
        //likesUsers
        $req = "SELECT * from posts WHERE likesUsers LIKE '%$usr%' AND id=$id LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        return (bool)mysqli_num_rows($req);
    
    }

    public function likePostByID($usr,$id)
    {
        if (!$this->is_userLikePost($usr,$id)) {
            $req = "UPDATE posts SET likeLen=likeLen+1 WHERE id=$id LIMIT 1";
            $req = mysqli_query(conf::DB(),$req);

            $req = "UPDATE posts SET likesUsers=CONCAT(likesUsers, '$usr , ') WHERE id=$id";
            $req = mysqli_query(conf::DB(),$req);
            return (bool)$req;
        }
        return false;
    }

    public function dislikePostByID($usr,$id)
    {
        if ($this->is_userLikePost($usr,$id)) {
            $req = "UPDATE posts SET likeLen=likeLen-1 WHERE id=$id LIMIT 1";
            $req = mysqli_query(conf::DB(),$req);

            $req = "UPDATE posts SET likesUsers=SUBSTRING_INDEX(likesUsers,'$usr , ', 1) WHERE id=$id";
            $req = mysqli_query(conf::DB(),$req);
            return (bool)$req;
        }
        return false;
    }
}

$MGpost = new posts();