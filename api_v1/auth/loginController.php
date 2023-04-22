<?php
$message = "Provide Correct Username or Password";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //login of account
    $checkAccount = mysqli_query($conn, ("select * from users WHERE username='$username' && password ='$password'"));
    $checkExistance = mysqli_num_rows($checkAccount);
    if($checkExistance > 0){
        $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
        $user_id = $fetchDetails['id'];
        $username = $fetchDetails['username'];
        $account_type = $fetchDetails['account_type'];
        if($account_type == "doctor"){
            //Update data
            $messageinsertSQL = "UPDATE emun_doctor SET status = 1 WHERE user_id = '$user_id'";
            $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
        }
        $message = "success";
        if(!isset($_GET['call'])) {
            $message = "Account Verification Complete, You are Good To Go";
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['account_type'] = $account_type;
        }
    }
}
$user_details = array(
    'user_id' => $user_id,
    'username' => $username,
    'password' => $password,
    'message' =>  $message
);
if(isset($_GET['call'])){
    echo json_encode($user_details);
}else{
    echo("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('$message')
            window.location.href='$BASEURL'
        </SCRIPT>");
}