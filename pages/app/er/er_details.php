<?php
//save changes
$er_Id = "";
$emergency = "";
$er_image = "";
$p_id = "";
$ed_code = "";
$date_created = date('y/m/d');
$assign_date = date('y/m/d');
$status = 0;
$statusMessage = "Not Worked on";
$error = "";
if(isset($_POST['eId'])){
    $er_Id = filter_input(INPUT_POST, 'eId');
}elseif (isset($_GET['eId'])){
    $er_Id = filter_input(INPUT_GET, 'eId');
    $error = filter_input(INPUT_GET, 'message');
}
$recode_data = "";
//if logged-in user
if($account_type == "user"){
    $recode_data = " AND user_id = '$user_id'";
}
//if logged-in Doctor

//get detail
$sql_farms = "SELECT * FROM emun_er WHERE id = '$er_Id' $recode_data";
$query_farms = mysqli_query($conn, $sql_farms);
$u_check_farms = mysqli_num_rows($query_farms);
//get records
$sql_records = "SELECT * FROM er_records WHERE er_id = '$er_Id' $recode_data";
$query_records = mysqli_query($conn, $sql_records);
$u_check_records = mysqli_num_rows($query_records);
//select doctors
$sql_doctor = "SELECT * FROM emun_doctor order by  id DESC";
$query_doctor = mysqli_query($conn, $sql_doctor);
$u_check_doctor = mysqli_num_rows($query_doctor);
//details
if($u_check_farms > 0){
    $row = mysqli_fetch_array($query_farms, MYSQLI_ASSOC);
    $emergency = $row['emergency'];
    $er_image = $row['er_image'];
    $p_id = $row['user_id'];
    $ed_code = $row['ed_code'];
    $date_created = $row['date_created'];
    $assign_date = $row['assign_date'];
    $status = $row['status'];
    if($status > 0){
        $statusMessage = "Completed";
    }
}
//assign doctor
if(isset($_POST['assign'])){
    $emun_doctor = $_POST['emun_doctor'];
    //update emergency
    mysqli_query($conn, "update emun_er set ed_code ='$emun_doctor' where id='$er_Id' ")or die(mysqli_query($conn));
}
//mark emergency as complete
if(isset($_POST['complete'])){
    //update emergency
    mysqli_query($conn, "update emun_er set status = 1 where id='$er_Id' ")or die(mysqli_query($conn));
}
//upload records
if(isset($_POST['send'])){
    $er_record = getimagesize($_FILES["er_image"]["tmp_name"]);
    $target_dir = "uploads/documents/";
    //generate emun doctor ID
    $sql_UID = "SELECT * FROM er_records order  by id DESC Limit 1";
    $query_UID = mysqli_query($conn, $sql_UID);
    $u_check_UID = mysqli_num_rows($query_UID);
    $ER = "REC".rand(1000,2000);
    if($u_check_UID > 0){
        $row = mysqli_fetch_array($query_UID);
        $ID = $row['id'];
        $ER = "REC".rand(1000,2000);
        $ER = $ER.$ID;
    }
    $target_file = $target_dir.$ER.".png";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is actual image or fake image
    if($er_record) {
        $error = "File is an image - " . $er_record["mime"] . ".";
    } else {
        $error = "File is not an image.<br/>";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["er_image"]["size"] > 5000000) {
        $error = $error." & Sorry, your file is too large.<br/>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $error = $error." & Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error = $error." & Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["er_image"]["tmp_name"], $target_file)) {
            $error = "Record Added Successfully";
            $messageInsertSQL = "INSERT INTO er_records (user_id, record_upload, ed_code, er_id)
            VALUES ('$p_id', '$target_file', '$ed_code', '$er_Id')";
            $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
        } else {
            $error = $error." & Sorry, there was an error uploading your file.";
        }
    }
}
//delete record
//
//if(isset($_POST['delete_Id'])){
//    $delete_Id = $_POST['delete_Id'];
//    mysqli_query($conn, "update emun_er set status = 1 where id='$er_Id' ")or die(mysqli_query($conn));
//}
if($_SERVER['REQUEST_METHOD']=='POST'){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.location.href='$BASEURL?page=er_details&eId=$er_Id&message=$error'
     </SCRIPT>");
}
?>
<div class="row" style="margin-top: 25px;">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start my_card_button">
                    <div>
                        <h4 class="card-title card-title-dash">eMUN Emergency</h4>
                    </div>
                    <div>
                        <?php if($account_type == 'admin'){ if($ed_code == ""){?>
                            <button class="btn btn-primary btn-sm text-white mb-0 me-0"
                                     type="button" data-bs-toggle="modal" data-bs-target="#assign">
                                <i class="mdi mdi-account-plus"></i>Assign eMun Doctor
                            </button>
                        <?php  } }else{ ?>
                            <button class="btn btn-primary btn-sm text-white mb-0 me-0"
                                    type="button" data-bs-toggle="modal" data-bs-target="#myRecord">
                                <i class="mdi mdi-apps"></i>Attach record
                            </button>
                        <?php  } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="row">
                            <div class="col-md-6 grid-margin stretch-card">
                                <img src="<?php echo $er_image; ?>" class="my_logo"/></div>
                            <div class="col-md-6 grid-margin stretch-card">
                                <span class="text-secondary"><h6 class="card-title">Emergency Details</h6><br/>
                                Emergency: <?php echo $emergency; ?><br/>
                                eMun Doctor: <?php echo $ed_code; ?><br/>
                                Date & Time: <?php echo $date_created; ?><br/>
                                Status: <?php echo $statusMessage; if($status == 0) { ?><br/>
                                 <?php if($account_type == 'user'){ ?>
                                <form method="post" action="<?php echo $BASEURL; ?>?page=er_details">
                                    <input type="hidden"  name="eId" value="<?php echo $er_Id; ?>" >
                                    <button type="submit" style="border: 0px; " class="badge badge-opacity-danger" name="complete">Click here to Set as Complete</button>
                                </form><?php } } ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="table-responsive  mt-1">
                            <table class="table select-table">
                                <thead>
                                <tr>
                                    <th colspan="4">
                                        <h6 class="card-title">Emergency Records: <?php echo $error; ?></h6>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                        </div>
                                    </th>
                                    <th>No.</th>
                                    <th>Record</th>
                                    <th>Date Added</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($u_check_records > 0){
                                    $i = 0;
                                    while ($row = mysqli_fetch_array($query_records, MYSQLI_ASSOC)){
                                        $i = ++$i;
                                        $eId = $row['id'];
                                        //emergency details
                                        $er_pic = $row['record_upload'];
                                        $er_time = $row['date_uploaded'];
                                        if($er_pic == NULL){
                                            $er_pic = "appStyle/logo.png";
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
                                                    <a href="<?php echo $er_pic; ?>">
                                                        <img src="<?php echo $er_pic; ?>" alt="">
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <p>Time and Date: <?php echo $er_time; ?></p>
<!--                                                <form method="post" action="--><?php //echo $BASEURL; ?><!--?page=er_details">-->
<!--                                                    <input type="hidden"  name="eId" value="--><?php //echo $er_Id; ?><!--" >-->
<!--                                                    <input type="hidden"  name="delete_Id" value="--><?php //echo $eId; ?><!--" >-->
<!--                                                    <button type="submit" style="border: 0px; " class="badge badge-opacity-danger" name="delete">Delete</button>-->
<!--                                                </form>-->
                                            </td>
                                        </tr>
                                    <?php } }else{ ?>
                                    <tr>
                                        <td colspan="5">No data Added Yet</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- model assign doctor -->
<div class="modal" id="assign">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Assign Doctor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="forms-sample" action="<?php echo $BASEURL; ?>?page=er_details" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Assign Doctor</label>
                        <input type="hidden"  name="eId" value="<?php echo $er_Id; ?>" >
                        <select name="emun_doctor" class="form-control" required>
                            <option>Select Doctor</option>
                            <?php if($u_check_doctor > 0){
                                while ($row_doctor = mysqli_fetch_array($query_doctor, MYSQLI_ASSOC)){
                                    $doc_code = $row_doctor['ed_code'];
                                    $doc_id = $row_doctor['user_id'];
                                    //get doc name
                                    $sql_check = "SELECT * FROM users WHERE id = '$doc_id' ";
                                    $query_check= mysqli_query($conn, $sql_check);
                                    $u_check_check = mysqli_num_rows($query_check);
                                    $doc_username = "";
                                    if($u_check_check > 0){
                                        $row_check = mysqli_fetch_array($query_check, MYSQLI_ASSOC);
                                        $doc_username = $row_check['username'];
                                    }
                            ?>
                                    <option value="<?php echo $doc_code; ?>"><?php echo $doc_username; ?></option>
                            <?php }}?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2" name="assign">Assign</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
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
                <h4 class="modal-title">Add Diagnostic Record</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="forms-sample" action="<?php echo $BASEURL; ?>?page=er_details" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <p>Take a picture and Upload</p>
                        <input type="hidden"  name="eId" value="<?php echo $er_Id; ?>" >
                        <label for="exampleInputEmail1">Attach a Picture</label>
                        <input type="file" class="form-control" name="er_image" id="exampleInputEmail1" required>
                    </div>
                    <button type="submit" class="btn btn-primary me-2" name="send">Send Details</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

