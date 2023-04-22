<?php
//edite farm
$farmButton = "Create";
$farmSubmit= "create";
$farmLink = "health_hub";
$DId = 0;
$valueForm = 'placeholder="Schedule Name"';
$valueForm2 = 'placeholder="Schedule Details"';
//redirect after Update
$redirect = ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='$BASEURL?page=$page'
    </SCRIPT>");
//Queries
$sql_farms = "SELECT * FROM health_hub order  by id DESC";
//search doctors
if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql_farms = "SELECT * FROM health_hub WHERE health_type = '$search' order  by id DESC";
}
//set page pagination
$query_farms = mysqli_query($conn, $sql_farms);
$u_check_farms = mysqli_num_rows($query_farms);
$number_of_pages = ceil($u_check_farms/$results_per_page);
$sql_farms = "SELECT * FROM health_hub order  by id DESC LIMIT $this_page_first_result , $results_per_page";
if(isset($_POST['search'])) {
    $sql_farms = "SELECT * FROM health_hub WHERE health_type = '$search' order  by id DESC LIMIT $this_page_first_result , $results_per_page";
}
//add new schedule
if(isset($_POST['create'])){
    $dUsername = filter_input(INPUT_POST, 'schedule');
    $dEmail = filter_input(INPUT_POST, 'story');
    $messageInsertSQL = "INSERT INTO health_hub (health_type, description)
            VALUES ('$dUsername', '$dEmail')";
    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
    echo $redirect;
}
//edit doctor
if(isset($_POST['editId'])){
    $DId = $_POST['eId'];
    $farmButton = "Save Changes";
    $farmSubmit= "Save";
    //get doctor to edit
    $sql_farms = "SELECT * FROM health_hub WHERE id = '$DId' order  by id DESC";
    $result = mysqli_query($conn, $sql_farms);
    $u_check_farm = mysqli_num_rows($result);
    $valueData = "";
    if($u_check_farm > 0){
        $result_data = mysqli_query($conn, $sql_farms);
        $row_data = mysqli_fetch_array($result_data, MYSQLI_ASSOC);
        $doctor = $row_data['health_type'];
        $valueForm = "value='$doctor'";
        $demail= $row_data['description'];
        $valueForm2 = "value='$demail'";
    }
}
//save changes
if(isset($_POST['Save'])){
    $dUsername = filter_input(INPUT_POST, 'schedule');
    $dEmail = filter_input(INPUT_POST, 'story');
    $DId = $_POST['DId'];
    $message = "Updated Successfully";
    //Update schedule
    $messageInsertSQL = ("UPDATE health_hub Set 
         health_type = '$dUsername', 
         description = '$dEmail' 
        WHERE  id = '$DId' ");
    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL) or die(mysqli_error($conn));
    echo $redirect;
}
//delete doctor accounts
if(isset($_POST['delete_schedule'])){
    //DELETE FROM table_name WHERE condition;
    $DId = $_POST['eId'];
    $sql_farms = "DELETE FROM health_hub WHERE id = '$DId'";
    $result = mysqli_query($conn, $sql_farms);
    //delete subs
    $sql_farms = "DELETE FROM hub_subs WHERE hub_id = '$DId'";
    $result = mysqli_query($conn, $sql_farms);
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
                                                    <h4 class="card-title card-title-dash">eMUN Health Schedule</h4>
                                                </div>
                                                <div>
                                                    <button class="btn btn-primary btn-lg text-white mb-0 me-0"
                                                            type="button" data-bs-toggle="modal" data-bs-target="#myModal">
                                                        <i class="mdi mdi-account-plus"></i>
                                                        <?php if(isset($_POST['editId'])){ echo "Edit Schedule"; }else{ ?>
                                                        Add new Schedule
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
                                                                    <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <th>No.</th>
                                                        <th>Schedule</th>
                                                        <th>Description</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if($u_check_farms > 0){
                                                        $i = 0;
                                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                            $i = ++$i;
                                                            $eId = $row['id'];
                                                            $doctor = $row['health_type'];
                                                            $doctor_email = $row['description'];
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
                                                                    <form method="post" action="<?php echo $BASEURL; ?>?page=<?php echo $page; ?>">
                                                                        <input type="hidden"  name="eId" value="<?php echo $eId; ?>" >
                                                                        <button type="submit" style="border: 0px; " class="badge badge-opacity-danger" name="editId">Edit</button>
                                                                    </form>
                                                                    <form method="post" action="<?php echo $BASEURL; ?>?page=<?php echo $page; ?>">
                                                                        <input type="hidden"  name="eId" value="<?php echo $eId; ?>" >
                                                                        <button type="submit" style="border: 0px; " class="badge badge-opacity-danger" name="delete">Delete</button>
                                                                    </form>
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
                        <label for="exampleInputUsername1">Schedule Name</label>
                        <input type="text" class="form-control" name="schedule" id="exampleInputUsername1" <?php echo $valueForm; ?>>
                        <input type="hidden"  name="DId" value="<?php echo $DId; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Schedule Details</label>
                        <textarea name="story" class="form-control" <?php echo $valueForm2 ?>
                        oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
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