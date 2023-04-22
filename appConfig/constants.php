<?php
$BASEURL = "https://emun.keberaorganics.com/";
$user_id = 0;
$user_details = array();
$first_name = "Provide firstname";
$last_name = "Provide lastname";
$username  = "Provide Username";
$password  = "Provide Password";
$email = "Provide email";
$number = "Provide contact";
$supper_admin = "";
$profile_pic = "";
$address = "Provide address";
$message = "error";
$account_type = "user";
$user_available  = "true";
$page = "";
$search = "";
if(isset($_GET["page"])){
    $page = $_GET["page"];
}
$api = "";
if(isset($_GET["call"])){
    $api = $_GET["call"];
}
//pagination page number
$results_per_page = 80;
// determine which page number visitor is currently on
if (!isset($_GET['pageNumber'])) {
    $pageNumber = 1;
} else {
    $pageNumber = $_GET['pageNumber'];
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($pageNumber-1)*$results_per_page;

