<?php

/**
 * Users
 */
class users
{
    
    function __construct()
    {
        /*if (!class_exists(conf)) {
            die("the script user need conf.php include !");
        }*/
    }

    public function getUserById(int $id)
    {
        $req = "SELECT * FROM users WHERE id=$id LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        if (!$req) {
            conf::setLog("function getUserById() fails to requests !");
        }
        return $req;
    }

    public function isUserExiste($usr)
    {
        $req = "SELECT * FROM users WHERE username='$usr' LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        return (bool) mysqli_num_rows($req);
    }
    public function searchUserByUsername($usr)
    {
        $req = "SELECT * FROM users WHERE username='$usr' LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        if (!$req) {
            conf::setLog("function getUserById() fails to requests !");
        }
        return mysqli_fetch_assoc($req);
    }

    public function userLoginCheks($usr,$psw)
    {
        $req = "SELECT * FROM users WHERE username='$usr' AND password='$psw' LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        if (!$req) {
            conf::setLog("function getUserById() fails to requests !");
        }
        return (bool)mysqli_num_rows($req);
    }

    public function registerLitel($usr,$psw,$gender)
    {       
        $req = "INSERT INTO users(username,password,gender,folowerLen,avatar,coverImg,token) VALUES ('$usr','$psw',$gender,0,'elyse.png','mycover.png','".base64_encode(random_bytes(24))."')";
        $req = mysqli_query(conf::DB(),$req);
        return (bool)$req;
    }
    public function updateAvatar($usr,$img)
    {
        $req = "UPDATE users SET avatar='$img' WHERE username='$usr' LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        return (bool)$req;
    }
    public function updateCover($usr,$img)
    {
        $req = "UPDATE users SET coverImg='$img' WHERE username='$usr' LIMIT 1";
        $req = mysqli_query(conf::DB(),$req);
        return (bool)$req;
    }

}

$MGuser = new users();
?>
