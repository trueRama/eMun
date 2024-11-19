<?php
//login api
global $api;
if($api == "login_user"){
    include ("api_v1/auth/loginController.php");
}
//sign_up api
elseif ($api == "signUp_user"){
    include ("api_v1/auth/sign-upController.php");
}
//get_user details api
elseif($api == "get_user"){
    include ("api_v1/auth/session_manager.php");
}
//login user web api