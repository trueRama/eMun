<?php
//Handling the Login Credentials
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = filter_input(INPUT_POST, 'username');
    $email = filter_input(INPUT_POST, 'email');
    $password = md5(filter_input(INPUT_POST, 'password'));
    $cpassword = md5(filter_input(INPUT_POST, 'confirm_password'));
    $account_type = "doctors";
    //generate emun doctor ID
    $sql_UID = "SELECT * FROM users order  by id DESC Limit 1";
    $query_UID = mysqli_query($conn, $sql_UID);
    $u_check_UID = mysqli_num_rows($query_UID);
    $userID = "EID".rand(1000,2000);
    if($u_check_UID > 0){
        $row = mysqli_fetch_array($query_UID);
        $ID = $row['id'];
        $userID = "EID".rand(1000,2000);
        $userID = $userID."".$ID;
    }
    // DUPLICATE DATA CHECKS USER
    $sql = "SELECT * FROM users WHERE username='$username' ";
    $query = mysqli_query($conn, $sql);
    $u_check = mysqli_num_rows($query);
    if($u_check > 0){
        $user_available  = "false";
        $message = "username taken";
    }else {
        // DUPLICATE DATA CHECKS USER
        $sql = "SELECT * FROM users WHERE email = '$email' ";
        $query = mysqli_query($conn, $sql);
        $u_check = mysqli_num_rows($query);
        if($u_check > 0){
            $user_available  = "false";
            $message = "email already in use";
        }else {
            //check if passwords much
            if($password == $cpassword){
               $message = "success";
               $messageInsertSQL = "INSERT INTO users (username, account_type, email, password)
               VALUES ('$username', '$account_type', '$email', '$password')";
                $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
                if($messageInsertQuery){
                    $sql = "SELECT * FROM users WHERE username='$username' ";
                    $query = mysqli_query($conn, $sql);
                    $u_check = mysqli_num_rows($query);
                    if($u_check > 0){
                        $row = mysqli_fetch_array($query);
                        $doctor_id = $row['id'];
                        $messageInsertSQL = "INSERT INTO emun_doctor (user_id, ed_code)
                        VALUES ('$doctor_id', '$userID')";
                        $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
                    }
                }
            } else {
                $user_available  = "false";
                $message = "passwords do not much";
            }
        }
    }
}
$user_details = array(
    'username' => $username,
    'password' => $password,
    'user' => $user_available,
    'message' => $message
);
if(isset($_GET['call'])) {
    echo json_encode($user_details);
}else{
    echo("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('$message')
        window.location.href='$BASEURL?page=emunDoctors'
    </SCRIPT>");
}