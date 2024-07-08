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
                        <h3>register</h3>
                    </div>
                    <div class="card-body">
                        <form class="ui form register">
                          <div class="field">
                            <label>username</label>
                            <input type="text" name="regusr" placeholder="First Name">
                          </div>
                          <div class="field">
                            <label>password</label>
                            <input type="password" name="regpsw" id="pswqsdjv" placeholder="password">
                          </div>
                          <div class="field">
                            <label>repeat password</label>
                            <input type="password" name="reregpsw" placeholder="password">
                          </div>

                          <div class="field">
                              <label>Gender</label>
                              <div class="ui selection dropdown">
                                  <input type="hidden" name="gender">
                                  <i class="dropdown icon"></i>
                                  <div class="default text">Gender</div>
                                  <div class="menu">
                                      <div class="item" data-value="1">Male</div>
                                      <div class="item" data-value="0">Female</div>
                                  </div>
                              </div>
                          </div>

                          <div class="field">
                            <div class="ui checkbox">
                              <input type="checkbox" tabindex="0">
                              <label>I agree to the Terms and Conditions</label>
                            </div>
                          </div>

                          <div class="d-flex justify-content-between">
                          <div class="ui primary button" onclick="registerNewUsers($('#vubcoidfg'),$(this))">Register</div>
                          <a class="ui button dark" href="/pages/login.php">login</a>
                          </div>
                          <div class="col-12 p-2 d-flex flex-column" id="vubcoidfg">
                              
                          </div>

                          </form>
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