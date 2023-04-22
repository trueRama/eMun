<?php
//update profile
if(isset($_POST['save'])){
    $error = "Update Check: yes";
    $fname = filter_input(INPUT_POST, 'fname');
    if(empty($fname)){
        $fname = $first_name;
    }
    $lname = filter_input(INPUT_POST, 'lname');
    if(empty($lname)){
        $lname = $last_name;
    }
    $username_up = filter_input(INPUT_POST, 'username');
    if(empty($username_up)){
        $username_up = $username;
    }else{
        //check for username duplicates
        $sql = "SELECT * FROM users WHERE username ='$username_up' ";
        $query = mysqli_query($conn, $sql);
        $u_check = mysqli_num_rows($query);
        if($u_check > 0) {
            $username_up = $username;
            $error = $error.", Username taken";
        }
    }
    $contact = filter_input(INPUT_POST, 'number');
    if(empty($contact)){
        $contact = $number;
    }else{
        //check Contacts duplicates
        $sql = "SELECT * FROM users WHERE contact = '$contact' ";
        $query = mysqli_query($conn, $sql);
        $u_check = mysqli_num_rows($query);
        if($u_check > 0) {
            $contact = $number;
            $error = $error.", Contact already in use";
        }
    }
    $email_up = filter_input(INPUT_POST, 'email');
    if(empty($email_up)){
        $email_up = $email;
    }else{
        //check email duplicates
        $sql = "SELECT * FROM users WHERE email = '$email_up' ";
        $query = mysqli_query($conn, $sql);
        $u_check = mysqli_num_rows($query);
        if($u_check > 0) {
            $email_up = $email;
            $error = $error.", Email already in use";
        }
    }
    $address_up = filter_input(INPUT_POST, 'address');
    if(empty($address_up)){
        $address_up = $address;
    }
    $image = $_FILES["file"]["size"];
    $target_file = $profile_pic;
    if ( $image > 0)
    {
        $image = $_FILES["file"]["name"];
        include_once('upload_images.php');
    }
    //Update data
    $messageInsertSQL = "UPDATE users SET username= '$username_up', profile_pic='$target_file', first_name = '$fname', last_name= '$lname',  email= '$email_up', "
        . "contact= '$contact', address = '$address_up' WHERE id='$user_id'";
    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
    if($messageInsertQuery){
        $error = $error.", Profile Update Successful";
        echo ("<SCRIPT LANGUAGE='JavaScript'>
             window.alert('$error')
             window.location.href='$BASEURL?page=profile'
         </SCRIPT>");
    }
}
//update Password
if(isset($_POST['password_update'])){
    $password_up = md5(filter_input(INPUT_POST, 'password'));
    $cpassword_up = md5(filter_input(INPUT_POST, 'cpassword'));
    $error = "passwords do not much";
    if($password_up == $cpassword_up){
        //Update data
        $messageInsertSQL = "UPDATE users SET  password= '$password_up' WHERE id='$user_id'";
        $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
        if($messageInsertQuery){
            $error = "Password Update Successful";
        }
    }
    echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.alert('$error')
         window.location.href='$BASEURL?page=profile'
     </SCRIPT>");
}
//delete Account
if(isset($_POST['delete'])){
    $sql_farms = "DELETE FROM story_reactions WHERE user_id = '$user_id'";
    $result_delete = mysqli_query($conn, $sql_farms);
    $sql_farms = "DELETE FROM pr_records WHERE user_id = '$user_id'";
    $result_delete = mysqli_query($conn, $sql_farms);
    $sql_farms = "DELETE FROM hub_subs WHERE user_id = '$user_id'";
    $result_delete = mysqli_query($conn, $sql_farms);
    $sql_farms = "DELETE FROM er_records WHERE user_id = '$user_id'";
    $result_delete = mysqli_query($conn, $sql_farms);
    $sql_farms = "DELETE FROM emun_stories WHERE user_id = '$user_id'";
    $result_delete = mysqli_query($conn, $sql_farms);
    $sql_farms = "DELETE FROM emun_pr WHERE user_id = '$user_id'";
    $result_delete = mysqli_query($conn, $sql_farms);
    $sql_farms = "DELETE FROM emun_er WHERE user_id = '$user_id'";
    $result_delete = mysqli_query($conn, $sql_farms);
    $sql_farms = "DELETE FROM delete_reply WHERE user_id = '$user_id'";
    $result_delete = mysqli_query($conn, $sql_farms);
    $sql_farms = "DELETE FROM delete_story WHERE user_id = '$user_id'";
    $result_delete = mysqli_query($conn, $sql_farms);
    $sql_farms = "DELETE FROM users WHERE id = '$user_id'";
    $result_delete = mysqli_query($conn, $sql_farms);
    //logout user
    session_destroy();
    echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.alert('Account Successfully Deleted')
         window.location.href='$BASEURL'
     </SCRIPT>");
}
?>
<div class="row" style="margin-top: 25px;">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start my_card_button">
                    <div>
                        <h4 class="card-title card-title-dash">Edit Profile</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="row">
                            <div class="col-12">
                                <img class="rounded-circle" src="<?php echo $profile_pic; ?>" alt="" style="width:100%; object-fit: contain; height: 250px;">
                                <?php if($account_type == "user"){ ?>
                                    <button class="mt-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#myRecord">Delete Your Account</button>
                                <?php } ?>
                            </div>
                            <div class="col-12">
                                <h5 class="card-title">Change Account Password</h5>
                                <form action="<?php echo $BASEURL; ?>?page=profile" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">
                                                        Password
                                                    </label>
                                                    <input name="password" id="Password"
                                                           placeholder = "password"
                                                           type="password"
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">
                                                        Confirm Password
                                                    </label>
                                                    <input name="cpassword" id="cpassword"
                                                           placeholder = "Confirm your password"
                                                           type="password"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <button class="mt-2 btn btn-primary" name="password_update" type="submit">Update Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <form action="<?php echo $BASEURL; ?>?page=profile" method="post" enctype="multipart/form-data" class="forms-sample">
                            <div class="row">
                                <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">First Name</label>
                                            <input name="fname" id="fname"  placeholder = "<?php echo $first_name; ?>" type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Last Name</label>
                                            <input name="lname" id="lname"
                                                   placeholder = "<?php echo $last_name; ?>"
                                                   type="text"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Email</label>
                                            <input name="email" id="email"
                                                   placeholder = "<?php echo $email; ?>"
                                                   type="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">
                                                    Phone Number
                                            </label>
                                            <input name="number" id="number"
                                                   placeholder ="<?php echo $number; ?>"
                                                   type="tel"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">
                                                    Username
                                            </label>
                                            <input name="username" id="username"
                                                   placeholder ="<?php echo $username; ?>"
                                                   type="text" class="form-control" <?php
                                            if($account_type == "admin"){

                                                echo "readonly";
                                            }
                                            ?> >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">
                                                    Address
                                            </label>
                                            <input name="address" id="username"
                                                <?php if(empty($address)){?>
                                                    placeholder = "e.g. Kampala"
                                                <?php }else{echo 'placeholder = "'.$address.'"';}?>
                                                   type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">
                                                Profile Photo
                                            </label>
                                            <input type="file" name="file" id="file" >
                                        </div>
                                    <label for="examplePassword11" class="">
                                        <?php
                                        $login = '';
                                        if(!empty($_GET["username"])){
                                            $login = $_GET["username"];
                                            echo $login;
                                        }
                                        ?>
                                    </label>
                                    <button class="mt-2 btn btn-primary" name="save" type="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- model add records -->
<div class="modal" id="myRecord">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Are You Sure?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="forms-sample" action="<?php echo $BASEURL; ?>?page=profile" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">All Data for this Account Will be wipe out of the system</label>
                    </div>
                    <button type="submit" class="btn btn-primary me-2" name="delete">Delete Account</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>