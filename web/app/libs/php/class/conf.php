<?php
if (!session_start()) 
{session_start();}

/**
 * conf
 */
class conf
{
    
    public static $name     = "inebgi";
    public static $nameCorp = "aitTalla";
    public static $authors  = "aitTalla";


    public static $BlockDB = false;


    public static function DB()
    {
        $con = mysqli_connect("127.0.0.1","admin","admin","inebgiDB");
        if (!$con) 
        {die("Conection To dataBase Fails !");}
        
        return $con;

    }
    public static function login($usr)
    {
        if (!session_start()) {
            session_start();
        }
        $_SESSION['login'] = true;
        $_SESSION['username'] = $usr;
        $_SESSION['account'] = $usr;


    }
}

$isConnected = false;
if (isset($_SESSION["username"])) {
    $isConnected = true;
}else{
    $isConnected = false;
}
?>
