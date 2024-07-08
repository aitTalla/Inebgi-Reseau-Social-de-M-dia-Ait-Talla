<?php

if (!session_start()) 
{session_start();}

if (isset($_SESSION["login"])) 
{
    header("location: index.php");
    die();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login To Inebgi</title>

    <link rel="stylesheet" type="text/css" href="/app/libs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/app/libs/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="/app/libs/css/semantic.min.css">
    
    <link rel="stylesheet" type="text/css" href="/app/libs/css/style.light.css">

</head>
<body>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-lg-6">
        <h2 class="text-center pink mb-5" style="font-size: 130px;"><i class="fa fa-chess"></i> Inebgi</h2>
        <div class="row ui p-2" style="border-radius: 5px;">

            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <div class="ui form">
                          <div class="field">

                            <div class="col-lg-12 d-flex align-items-center justify-content-center" id="usersCmzaejojcovijh" style="min-height: 40px;">
                            
                            <!-- <i class="fa fa-circle-notch fa-spin"></i>-->
                            </div>

                            <label>username</label>
                            <input type="text" id="usrqsdqsd" onkeyup="getUserForloginControle(this.value,$('#usersCmzaejojcovijh'))" placeholder="First Name">
                          </div>
                          <div class="field">
                            <label>password</label>
                            <input type="password" id="upswqsdqsd" placeholder="password">
                          </div>

                          <div class="d-flex justify-content-between">
                          <button class="ui button primary" type="submit" onclick="loginIntoWeb($('#usrqsdqsd')[0].value,$('#upswqsdqsd')[0].value,$(this))">login</button>
                          <a class="ui button dark" href="/pages/register.php">Register</a>
                          </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
</div>


</body>
<script type="text/javascript" src="/app/libs/js/jquery.min.js"></script>
<script type="text/javascript" src="/app/libs/js/semantic.min.js"></script>
<script type="text/javascript" src="/app/libs/js/app.js"></script>