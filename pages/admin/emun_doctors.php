<?php
//edite farm
$farmButton = "Register";
$farmSubmit= "reg";
$farmLink = "addDoctors";
$DId = 0;
$valueForm = 'placeholder="Assign username"';
$valueForm2 = 'placeholder="Enter Email"';
$valueForm3 = 'placeholder="Enter password"';
$valueForm4 = 'placeholder="Confirm Password"';
//Queries
$sql_farms = "SELECT * FROM users WHERE account_type = 'doctors' order  by id DESC";
//search doctors
if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql_farms = "SELECT * FROM users WHERE username = '$search' and account_type = 'doctors' order  by id DESC";
}
//set page pagination
$query_farms = mysqli_query($conn, $sql_farms);
$u_check_farms = mysqli_num_rows($query_farms);
$number_of_pages = ceil($u_check_farms/$results_per_page);
$sql_farms = "SELECT * FROM users WHERE account_type = 'doctors' order  by id DESC LIMIT $this_page_first_result , $results_per_page";
if(isset($_POST['search'])) {
    $sql_farms = "SELECT * FROM users WHERE username = '$search' and account_type = 'doctors' order  by id DESC LIMIT $this_page_first_result , $results_per_page";
}
//delete doctor accounts
//edit doctor
if(isset($_POST['editId'])){
    $DId = $_POST['eId'];
    $farmButton = "Save Changes";
    $farmSubmit= "Save";
    $farmLink = $page;
    //get doctor to edit
    $sql_farms = "SELECT * FROM users WHERE id = '$DId' order  by id DESC";
    $result = mysqli_query($conn, $sql_farms);
    $u_check_farm = mysqli_num_rows($result);
    $valueData = "";
    if($u_check_farm > 0){
        $result_data = mysqli_query($conn, $sql_farms);
        $row_data = mysqli_fetch_array($result_data, MYSQLI_ASSOC);
        $doctor = $row_data['username'];
        $valueForm = "value='$doctor'";
        $demail= $row_data['email'];
        $valueForm2 = "value='$demail'";
    }
}
//save changes
if(isset($_POST['Save'])){
    $dUsername = filter_input(INPUT_POST, 'username');
    $dEmail = filter_input(INPUT_POST, 'email');
    $password = md5(filter_input(INPUT_POST, 'password'));
    $cpassword = md5(filter_input(INPUT_POST, 'confirm_password'));
    $DId = $_POST['DId'];
    $message = "Updated Successfully";
    if($password != $cpassword){
        $message = "Passwords do not much";
    }else{
        //Update Doctor
        $messageInsertSQL = ("UPDATE users Set 
         username = '$dUsername', 
         email = '$dEmail', 
         password = '$password' 
        WHERE  id = '$DId' ");
        $messageInsertQuery = mysqli_query($conn, $messageInsertSQL) or die(mysqli_error($conn));
    }
    echo("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('$message')
        window.location.href='$BASEURL?page=$page'
    </SCRIPT>");
}
//set page results
$result = mysqli_query($conn, $sql_farms);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                        <div class="col-lg-12 d-flex flex-column">
                            <div class="row flex-grow">
                                <div class="col-12 grid-margin">
                                    <div class="card card-rounded">
                                        <div class="card-body">
                                            <div class="d-sm-flex justify-content-between align-items-start">
                                                <div>
                                                    <h4 class="card-title card-title-dash">EMUN Registered Doctors</h4>
                                                </div>
                                                <div>
                                                    <button class="btn btn-primary btn-lg text-white mb-0 me-0"
                                                            type="button" data-bs-toggle="modal" data-bs-target="#myModal">
                                                        <i class="mdi mdi-account-plus"></i>
                                                        <?php if(isset($_POST['editId'])){ echo "Edit Doctor"; }else{ ?>
                                                        Add new member
                                                        <?php } ?>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="table-responsive  mt-1">
                                                <table class="table select-table">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="form-check form-check-flat mt-0">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                                            </div>
                                                        </th>
                                                        <th>No.</th>
                                                        <th>Doctor</th>
                                                        <th>EMUN Code</th>
                                                        <th>Email</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if($u_check_farms > 0){
                                                        $i = 0;
                                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                            $i = ++$i;
                                                            $eId = $row['id'];
                                                            $doctor = $row['username'];
                                                            $doctor_email = $row['email'];
                                                            $doctor_pic = $row['profile_pic'];
                                                            if($doctor_pic == NULL){
                                                                $doctor_pic = "appStyle/logo.png";
                                                            }
                                                            //get doctor code
                                                            $sql_code = "SELECT * FROM emun_doctor WHERE user_id = '$eId' order  by id DESC";
                                                            $result_code = mysqli_query($conn, $sql_code);
                                                            $row_code = mysqli_fetch_array($result_code, MYSQLI_ASSOC);
                                                            $ed_code = $row_code['ed_code'];
                                                            $ed_status = $row_code['status'];
                                                            $status = '<div class="badge badge-opacity-warning">Offline</div>';
                                                            if($ed_status != 0){
                                                                $status = '<div class="badge badge-opacity-success">Online</div>';
                                                            }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check form-check-flat mt-0">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex ">
                                                                <div>
                                                                    <p><?php echo $i; ?></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex ">
                                                                <img src="<?php echo $doctor_pic; ?>" alt="">
                                                                <div>
                                                                    <h6><?php echo $doctor; ?></h6>
                                                                    <form method="post" action="<?php echo $BASEURL; ?>?page=<?php echo $page; ?>">
                                                                        <input type="hidden"  name="eId" value="<?php echo $eId; ?>" >
                                                                        <button type="submit" style="border: 0px; " class="badge badge-opacity-danger" name="editId">Edit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h6><?php echo $ed_code; ?></h6>
                                                        </td>
                                                        <td>
                                                            <h6><?php echo $doctor_email; ?></h6>
                                                        </td>
                                                        <td>
                                                            <?php echo $status; ?>
                                                        </td>
                                                    </tr>
                                                    <?php } }else{ ?>
                                                    <tr>
                                                        <td colspan="5">No data Added Yet</td>
                                                    </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                                <?php include_once ("appConfig/pagination_footer.php"); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Model add doctors --->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Register Doctor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="forms-sample" method="post" action="<?php echo $BASEURL; ?>?page=<?php echo $farmLink; ?>">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input type="text" class="form-control" name="username" id="exampleInputUsername1" <?php echo $valueForm; ?>>
                        <input type="hidden"  name="DId" value="<?php echo $DId; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" <?php echo $valueForm2; ?>>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" <?php echo $valueForm3; ?>>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="exampleInputConfirmPassword1" <?php echo $valueForm4; ?>>
                    </div>
                    <button type="submit" class="btn btn-primary me-2" name="<?php echo $farmSubmit; ?>"><?php echo $farmButton; ?></button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>