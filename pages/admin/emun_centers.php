<?php
//edite farm
$farmButton = "Create";
$farmSubmit= "create";
$farmLink = "centers";
$DId = 0;
$valueForm = 'placeholder="Center Name"';
$valueForm2 = 'placeholder="Center Details"';
$valueForm3 = 'placeholder="Center Location"';
//redirect after Update
$redirect = ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='$BASEURL?page=$page'
    </SCRIPT>");
//Queries
$sql_farms = "SELECT * FROM emun_month order  by airing_time DESC";
//search doctors
if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql_farms = "SELECT * FROM emun_month WHERE center = '$search' order  by airing_time DESC";
}
//set page pagination
$query_farms = mysqli_query($conn, $sql_farms);
$u_check_farms = mysqli_num_rows($query_farms);
$number_of_pages = ceil($u_check_farms/$results_per_page);
$sql_farms = "SELECT * FROM emun_month order  by airing_time DESC LIMIT $this_page_first_result , $results_per_page";
if(isset($_POST['search'])) {
    $sql_farms = "SELECT * FROM emun_month WHERE center = '$search' order  by airing_time DESC LIMIT $this_page_first_result , $results_per_page";
}
//select doctors
$sql_doctor = "SELECT * FROM emun_doctor order by  id DESC";
$query_doctor = mysqli_query($conn, $sql_doctor);
$u_check_doctor = mysqli_num_rows($query_doctor);
//add new schedule
if(isset($_POST['create'])){
    $dUsername = filter_input(INPUT_POST, 'schedule');
    $dEmail = filter_input(INPUT_POST, 'story');
    $session_time = date('y-m-d h:i:s a',strtotime(filter_input(INPUT_POST, 'appointment')));
    $session_location = filter_input(INPUT_POST, 'location');
    $emun_doctor = $_POST['emun_doctor'];
    //create record
    $messageInsertSQL = "INSERT INTO emun_month (center, description, airing_time, center_location, check_code)
            VALUES ('$dUsername', '$dEmail','$session_time','$session_location','$emun_doctor')";
    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
    echo $redirect;
}
//edit doctor
if(isset($_POST['editId'])){
    $DId = $_POST['eId'];
    $farmButton = "Save Changes";
    $farmSubmit= "Save";
    //get doctor to edit
    $sql_farms = "SELECT * FROM emun_month WHERE id = '$DId' order  by id DESC";
    $result = mysqli_query($conn, $sql_farms);
    $u_check_farm = mysqli_num_rows($result);
    $valueData = "";
    if($u_check_farm > 0){
        $result_data = mysqli_query($conn, $sql_farms);
        $row_data = mysqli_fetch_array($result_data, MYSQLI_ASSOC);
        $doctor = $row_data['center'];
        $valueForm = "value='$doctor'";
        $demail= $row_data['description'];
        $valueForm2 = "value='$demail'";
        $center_location= $row_data['center_location'];
        $valueForm3 = "value='$center_location'";
    }
}
//save changes
if(isset($_POST['Save'])){
    $dUsername = filter_input(INPUT_POST, 'schedule');
    $dEmail = filter_input(INPUT_POST, 'story');
    $session_time = date('y-m-d h:i:s a',strtotime(filter_input(INPUT_POST, 'appointment')));
    $session_location = filter_input(INPUT_POST, 'location');
    $emun_doctor = $_POST['emun_doctor'];
    $DId = $_POST['DId'];
    $message = "Updated Successfully";
    //Update schedule
    $messageInsertSQL = ("UPDATE emun_month Set 
         center = '$dUsername', 
         description = '$dEmail',
         airing_time = '$session_time',
         center_location = '$session_location',
         check_code = '$emun_doctor'
        WHERE  id = '$DId' ");
    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL) or die(mysqli_error($conn));
    echo $redirect;
}
//delete doctor accounts
if(isset($_POST['delete'])){
    //DELETE FROM table_name WHERE condition;
    $DId = $_POST['eId'];
    $sql_farms = "DELETE FROM emun_month WHERE id = '$DId'";
    $result_delete = mysqli_query($conn, $sql_farms);
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
                                                    <h4 class="card-title card-title-dash">eMUN Monthly Centers</h4>
                                                </div>
                                                <div>
                                                    <?php if($account_type == 'admin'){ ?>
                                                        <button class="btn btn-primary btn-lg text-white mb-0 me-0"
                                                                type="button" data-bs-toggle="modal" data-bs-target="#myModal">
                                                            <i class="mdi mdi-account-plus"></i>
                                                            <?php if(isset($_POST['editId'])){ echo "Edit Center"; }else{ ?>
                                                                Add new Center
                                                            <?php } ?>
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="table-responsive  mt-1">
                                                <table class="table select-table">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="form-check form-check-flat mt-0">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <th>No.</th>
                                                        <th>Center</th>
                                                        <th>Details</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if($u_check_farms > 0){
                                                        $i = 0;
                                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                            $i = ++$i;
                                                            $eId = $row['id'];
                                                            $doctor = $row['center'];
                                                            $doctor_email = $row['description'];
                                                            $time = $row['airing_time'];
                                                            $location = $row['center_location'];
                                                            $code = $row['check_code'];
                                                            $doctor_pic = "appStyle/logo.png";
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check form-check-flat mt-0">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i>
                                                                        </label>
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
                                                                            <?php if($account_type == 'admin'){ ?>
                                                                                <form method="post" action="<?php echo $BASEURL; ?>?page=<?php echo $page; ?>">
                                                                                    <input type="hidden"  name="eId" value="<?php echo $eId; ?>" >
                                                                                    <button type="submit" style="border: 0px; " class="badge badge-opacity-danger" name="editId">Edit</button>
                                                                                </form>
                                                                                <form method="post" action="<?php echo $BASEURL; ?>?page=<?php echo $page; ?>">
                                                                                    <input type="hidden"  name="eId" value="<?php echo $eId; ?>" >
                                                                                    <button type="submit" style="border: 0px; " class="badge badge-opacity-danger" name="delete">Delete</button>
                                                                                </form>
                                                                            <?php } ?>
                                                                            <br/>
                                                                            <a href="#" target=”_blank”>Date & Time: <?php echo $time; ?></a><br/>
                                                                            <a href="#" target=”_blank”>Location: <?php echo $location; ?></a><br/>
                                                                            <a href="#" target=”_blank”>Center Code: <?php echo $code; ?></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h6><?php echo $doctor_email; ?></h6>
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
                <h4 class="modal-title">Create Schedule</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="forms-sample" method="post" action="<?php echo $BASEURL; ?>?page=<?php echo $farmLink; ?>">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Center Name</label>
                        <input type="text" class="form-control" name="schedule" id="exampleInputUsername1" <?php echo $valueForm; ?> required>
                        <input type="hidden"  name="DId" value="<?php echo $DId; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Center Details</label>
                        <textarea name="story" class="form-control" <?php echo $valueForm2 ?>
                        oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Center Date & Time</label>
                        <input type="datetime-local" class="form-control" name="appointment" id="date" placeholder="Session Date"
                               style="padding-bottom: 5px;" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Center Location</label>
                        <input type="text" class="form-control" name="location" id="date" <?php echo $valueForm3; ?>
                               style="padding-bottom: 5px;" required>
                    </div>
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