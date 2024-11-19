<?php
global $api;
if($api != ""){
    //application api calls
    include ("pages/api_routs.php");
}else{
    //application view calls
    include ("pages/view_routs.php");
}
