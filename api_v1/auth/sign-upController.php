<?php
//Handling the Login Credentials
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = filter_input(INPUT_POST, 'username');
    if(isset($_POST['account_type'])){
        $account_type = filter_input(INPUT_POST, 'account_type');
    }
    $email = filter_input(INPUT_POST, 'email');
    $contact = filter_input(INPUT_POST, 'contact');
    $password = filter_input(INPUT_POST, 'password');
    $cpassword = filter_input(INPUT_POST, 'confirm_password');
    // DUPLICATE DATA CHECKS USER
    $sql = "SELECT * FROM users WHERE username='$username' ";
    $query = mysqli_query($conn, $sql);
    $u_check = mysqli_num_rows($query);
    if($u_check > 0){
        $user_available  = "false";
        $message = "username taken";
    }else {
        // DUPLICATE DATA CHECKS USER
        $sql = "SELECT * FROM users WHERE contact = '$contact' ";
        $query = mysqli_query($conn, $sql);
        $u_check = mysqli_num_rows($query);
        if($u_check > 0){
            $user_available  = "false";
            $message = "Contact already in use";
        }else {
            //check if passwords much
            if($password == $cpassword){
                //Check password Strength
                //check password strength
                // Validate password strength
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                    $message = "Password should be at least 8 characters in length and should include at least one upper case letter, one lower case letter, one number, and one special character";
                }else{
                    $message = "success";
                    $password = md5($password);
                    $messageInsertSQL = "INSERT INTO users (username, account_type, email, contact, password)
                    VALUES ('$username', '$account_type', '$email', '$contact', '$password')";
                    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
                }
            } else {
                $user_available  = "false";
                $message = "passwords do not much";
            }
        }
    }
    if(!isset($_GET['call'])) {
        backHome($message, $BASEURL);
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
}
function backHome($message,$BASEURL){
    echo("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('$message')
            window.location.href='$BASEURL?page=login'
        </SCRIPT>");
}