<?php
//add new schedule
if(isset($_POST['sub'])){
    $dUsername = filter_input(INPUT_POST, 'sub_health');
    $error = "";
    //Queries
    $sql_check_sub = "SELECT * FROM hub_subs WHERE user_id = '$user_id' order  by id DESC";
    //set page pagination
    $query_check_sub = mysqli_query($conn, $sql_check_sub);
    $u_check_subs = mysqli_num_rows($query_check_sub);
    if($u_check_subs > 0){
        //update health schedule
        $error = "Health Schedule Updated";
        mysqli_query($conn, "update hub_subs set hub_id = '$dUsername' where user_id='$user_id' ")or die(mysqli_query($conn));
    }else{
        //create health schedule
        $error = "Health Schedule Created";
        $messageInsertSQL = "INSERT INTO hub_subs (hub_id, user_id)VALUES ('$dUsername', '$user_id')";
        $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
    }
    echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.alert('$error')
        window.location.href='$BASEURL'
    </SCRIPT>");
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                        <!-- live sessions section -->
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="col-12 grid-margin stretch-card">
                                <a href="<?php  echo $BASEURL.'?page=liveSessions'; ?>" class="col-12 grid-margin stretch-card slick" >
                                    <div class="card card-rounded"
                                         style="background:linear-gradient(0deg, rgba(255, 255, 255, 0.5), rgba(20, 255, 100, 0.3)), url('appStyle/emun_live2.jpg');
                                         background-size: contain;" >
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="add-items d-flex mb-0">
                                                    <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p">
                                                        <i class="mdi mdi-access-point-network" style=""></i>
                                                    </button>
                                                </div>
                                                <h4 class="card-title card-title-dash"
                                                    style="color: #590D07;">
                                                    Live Session</h4>
                                            </div>
                                            <div class="list-wrapper no-mobile">
                                                <ul class="todo-list todo-list-rounded">
                                                    <?php
                                                    $sql_farms = "SELECT * FROM emun_broadcast order  by id DESC Limit 1";
                                                    $query_farms = mysqli_query($conn, $sql_farms);
                                                    $u_check_farms = mysqli_num_rows($query_farms);
                                                    $result = mysqli_query($conn, $sql_farms);
                                                    if($u_check_farms > 0){
                                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                            $er_time = strtotime($row['airing_time']);
                                                            ?>
                                                            <li class="d-block">
                                                                <div class="form-check w-100">
                                                                    <div class="d-flex mt-2" style="margin-bottom: 100px;">
                                                                        <div class="badge badge-opacity-warning me-3"><?php echo date('d-M-Y h:i:s a', $er_time); ?></div>
                                                                    </div>
                                                                    <label class="form-check-label">
                                                                        Sessions Available
                                                                        <i class="input-helper rounded"></i><br/>
                                                                        Click Here
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php } }else { ?>
                                                        <li class="d-block">
                                                            <div class="form-check w-100">
                                                                <div class="d-flex mt-2" style="margin-bottom: 100px;">
                                                                    <div class="badge badge-opacity-warning me-3">
                                                                        <?php echo date('d-M-Y h:i:s a'); ?>
                                                                    </div>
                                                                </div>
                                                                <label class="form-check-label" >
                                                                    No Sessions Yet
                                                                    <i class="input-helper rounded"></i><br/>
                                                                    Click Here
                                                                </label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- live sessions section -->
                        <!-- Monthly sessions section -->
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="col-12 grid-margin stretch-card">
                                <a href="<?php  echo $BASEURL.'?page=centers'; ?>" class="col-12 grid-margin stretch-card slick">
                                    <div class="card card-rounded" style="background: linear-gradient(0deg, rgba(255, 255, 255, 0.2), rgba(25, 100, 255, 0.3)), url('appStyle/month.jpg'); background-size: contain;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="add-items d-flex mb-0">
                                                    <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p">
                                                        <i class="mdi mdi-account-card-details"></i>
                                                    </button>
                                                </div>
                                                <h4 class="card-title card-title-dash" style="color: #590D07;">Monthly Check Program</h4>
                                            </div>
                                            <div class="list-wrapper">
                                                <ul class="todo-list todo-list-rounded">
                                                    <li class="d-block">
                                                        <div class="form-check w-100">
                                                            <div class="d-flex mt-2" style="margin-bottom: 100px;">
                                                                <div class="badge badge-opacity-warning me-3">
                                                                    <?php echo date('d-M-Y h:i:s a'); ?>
                                                                </div>
                                                            </div>
                                                            <label class="form-check-label">
                                                                Checks this Month
                                                                <i class="input-helper rounded"></i><br/>
                                                                Click Here
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- Monthly sessions section -->
                        <!-- Health hub sessions section -->
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="col-12 grid-margin stretch-card">
                                <a href="<?php if($account_type != 'user'){ echo $BASEURL.'?page=health_hub'; } ?>"
                                   <?php if($account_type == "user"){ ?>data-bs-toggle="modal" data-bs-target="#myHealth"<?php } ?>
                                   class="col-12 grid-margin stretch-card slick">
                                    <div class="card card-rounded" style="background: linear-gradient(0deg, rgba(255, 100, 200, 0.8), rgba(255, 255, 255, 0.5)), url('appStyle/hub2.png'); background-size: contain;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="add-items d-flex mb-0">
                                                    <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p">
                                                        <i class="mdi mdi-account-network"></i>
                                                    </button>
                                                </div>
                                                <h4 class="card-title card-title-dash" style="color: #590D07;">My Health Hub</h4>
                                            </div>
                                            <div class="list-wrapper">
                                                <ul class="todo-list todo-list-rounded">
                                                    <?php
                                                    $sql_stories = "SELECT * FROM hub_subs WHERE user_id = '$user_id' order  by id DESC Limit 1";
                                                    $query_stories= mysqli_query($conn, $sql_stories);
                                                    $u_check_stories = mysqli_num_rows($query_stories);
                                                    if($u_check_stories > 0){
                                                        ?>
                                                        <li class="d-block">
                                                            <div class="form-check w-100">
                                                                <div class="d-flex mt-2" style="margin-bottom: 100px;">
                                                                    <div class="badge badge-opacity-warning me-3"><?php echo date('d-M-Y h:i:s a'); ?></div>
                                                                </div>
                                                                <label class="form-check-label">Package Selected<i class="input-helper rounded"></i><br/>
                                                                    Care to Select?
                                                                </label>
                                                            </div>
                                                        </li>
                                                    <?php }else { ?>
                                                        <li class="d-block">
                                                            <div class="form-check w-100">
                                                                <div class="d-flex mt-2" style="margin-bottom: 100px;">
                                                                    <div class="badge badge-opacity-warning me-3"><?php echo date('d-M-Y h:i:s a'); ?></div>
                                                                </div>
                                                                <label class="form-check-label">No Package Selected<i class="input-helper rounded"></i><br/>
                                                                    Care to Select?
                                                                </label>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- health sessions section -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Model request doctors -->
<div class="modal" id="myHealth">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Select Health Schedule</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="forms-sample" action="<?php echo $BASEURL; ?>" method="post" enctype="multipart/form-data">
                    <select name="sub_health" class="form-control" required>
                        <option>Select Package</option>
                        <?php
                        $sql_doctor = "SELECT * FROM health_hub order by  id DESC";
                        $query_doctor = mysqli_query($conn, $sql_doctor);
                        $u_check_doctor = mysqli_num_rows($query_doctor);
                        if($u_check_doctor > 0){
                            while ($row_doctor = mysqli_fetch_array($query_doctor, MYSQLI_ASSOC)){
                                $doc_code = $row_doctor['id'];
                                $doc_username = $row_doctor['health_type'];
                                ?>
                                <option value="<?php echo $doc_code; ?>"><?php echo $doc_username; ?></option>
                            <?php }}?>
                    </select>
                    <br/>
                    <button type="submit" class="btn btn-primary me-2" name="sub">Subscribe</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>