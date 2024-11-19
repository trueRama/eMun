<?php
//login of account
global $conn, $BASEURL;
if (isset($_POST['username'])){
    $username = $_POST['username'];
}
$checkAccount = mysqli_query($conn, ("select * from users WHERE username='$username'"));
$checkExistance = mysqli_num_rows($checkAccount);
if($checkExistance > 0){
    $fetchDetails = mysqli_fetch_array($checkAccount, MYSQLI_ASSOC);
    $user_id = $fetchDetails['id'];
    $username = $fetchDetails['username'];
    $account_type = $fetchDetails['account_type'];
    $_SESSION['user_id']= $user_id;
    $_SESSION['username']= $username;
    $_SESSION['account_type']= $account_type;
    echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=$BASEURL?page=dashbord' />";
}else {
    echo"<META HTTP-EQUIV='Refresh' CONTENT='0; URL=$BASEURL?page=login&message=Check your username or password are correct' />";
}

