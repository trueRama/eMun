<?php
//get all user details and bio
global $conn;
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}elseif (isset($_POST['username'])){
    $username = $_POST['username'];
}
$checkAccount = mysqli_query($conn, ("select * from users WHERE username='$username'"));
$checkExistance = mysqli_num_rows($checkAccount);
if($checkExistance > 0){
    //user details
    $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
    $user_id = $fetchDetails['id'];
    $first_name = $fetchDetails['first_name'];
    $last_name = $fetchDetails['last_name'];
    $username = $fetchDetails['username'];
    $email = $fetchDetails['email'];
    $number = $fetchDetails['contact'];
    $account_type = $fetchDetails['account_type'];
    $supper_admin = $fetchDetails['supper_admin'];
    $profile_pic = $fetchDetails['profile_pic'];
    if($profile_pic == NULL){
        $profile_pic = "appStyle/logo.png";
    }
    $address = $fetchDetails['address'];
    $message = "success";
}
//Queries
$ed_code = "";
$recode_data_doctor = "";
if($account_type == 'doctors'){
    //check user
    $sql_checks= "SELECT * FROM emun_doctor WHERE user_id = '$user_id' ";
    $query_checks= mysqli_query($conn, $sql_checks);
    $u_check_checks = mysqli_num_rows($query_checks);
    if($u_check_checks > 0){
        $row_checks = mysqli_fetch_array($query_checks, MYSQLI_ASSOC);
        $ed_code = "ed_code = '".$row_checks['ed_code']."' and ";
        $recode_data_doctor = $row_checks['ed_code'];
    }
}elseif ($account_type == 'user'){
    $ed_code = "user_id = '$user_id' and ";
}
//app notification
$recode_data = "";
//if logged-in user
if($account_type == "user"){
    $recode_data = " AND user_id = '$user_id'";
}
//if logged-in Doctor
if($account_type == "doctor"){
    $recode_data = " AND ed_code = '$recode_data_doctor'";
}
//emergencies
$not_er = "SELECT * FROM emun_er WHERE status = 0 order  by id DESC";
if($account_type != "admin"){
    $not_er = "SELECT * FROM emun_er WHERE $ed_code status = 0 order  by id DESC";
}
$query_not_er = mysqli_query($conn, $not_er);
$u_check_not_er = mysqli_num_rows($query_not_er);
//not color
$not_er_color = "";
if($u_check_not_er > 0){
    $not_er_color = "color:red; font-weight:bold";
}
//appointments
$not_pr = "SELECT * FROM emun_pr WHERE status != 2 order  by id DESC";
if($account_type != "admin"){
    $not_pr = "SELECT * FROM emun_pr WHERE $ed_code status != 2 order  by id DESC";
}
$query_not_pr = mysqli_query($conn, $not_pr);
$u_check_not_pr = mysqli_num_rows($query_not_pr);
//not color
$not_pr_color = "";
if($u_check_not_pr > 0){
    $not_pr_color = "color:red; font-weight:bold";
}
//mobile api return calls
$user_details = array(
    'username' => $username,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'contact' => $number,
    'account_type' => $account_type,
    'supper_admin' => $supper_admin,
    'profile_pic' => $profile_pic,
    'address' => $address,
    'message' =>  $message
);
if (isset($_GET['call'])){
    echo json_encode($user_details);
}