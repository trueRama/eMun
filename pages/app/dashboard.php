<style>
    .home-tab .btn.btn-icons i, .home-tab .ajax-upload-dragdrop .btn-icons.ajax-file-upload i, .ajax-upload-dragdrop .home-tab .btn-icons.ajax-file-upload i, .home-tab .swal2-modal .swal2-buttonswrapper .btn-icons.swal2-styled i, .swal2-modal .swal2-buttonswrapper .home-tab .btn-icons.swal2-styled i {
        font-size: 2rem;
    }
    .home-tab .btn.btn-icons, .home-tab .ajax-upload-dragdrop .btn-icons.ajax-file-upload, .ajax-upload-dragdrop .home-tab .btn-icons.ajax-file-upload, .home-tab .swal2-modal .swal2-buttonswrapper .btn-icons.swal2-styled, .swal2-modal .swal2-buttonswrapper .home-tab .btn-icons.swal2-styled {
        width: 50px;
        height: 50px;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
        <?php include_once ("notifications/dashboard_notifications.php"); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                        <!-- Start Emergency Section -->
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="col-12 grid-margin stretch-card">
                                <a href="<?php if($account_type != 'user'){ echo $BASEURL.'?page=unassigned_ers'; } ?>"
                                   <?php if($account_type == "user"){ ?>data-bs-toggle="modal" data-bs-target="#myModal"<?php } ?>
                                   class="col-12 grid-margin stretch-card slick">
                                    <div class="card card-rounded"
                                         style="background: linear-gradient(0deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.5)),  url('appStyle/bg.png');
                                         background-size: contain;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="add-items d-flex mb-0">
                                                    <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p">
                                                        <i class="mdi mdi-ambulance" style=""></i>
                                                    </button>
                                                </div>
                                                <h4 class="card-title card-title-dash"
                                                    style="color: #590D07;">
                                                    Emergency Room</h4>
                                            </div>
                                            <div class="list-wrapper no-mobile">
                                                <ul class="todo-list todo-list-rounded">
                                                    <?php
                                                        if($account_type == "user"){
                                                            $sql_farms = "SELECT * FROM emun_er WHERE user_id = '$user_id' and status = 0 order  by id DESC Limit 1";
                                                        }elseif ($account_type == "doctors"){
                                                            //check user
                                                            $sql_check = "SELECT * FROM emun_doctor WHERE user_id = '$user_id' ";
                                                            $query_check= mysqli_query($conn, $sql_check);
                                                            $u_check_check = mysqli_num_rows($query_check);
                                                            $my_search = "";
                                                            if($u_check_check > 0){
                                                                $row_check = mysqli_fetch_array($query_check, MYSQLI_ASSOC);
                                                                $my_search = $row_check['ed_code'];
                                                            }
                                                            $sql_farms = "SELECT * FROM emun_er WHERE ed_code = '$my_search' and status = 0 order  by id DESC Limit 1";
                                                        }else{
                                                            $sql_farms = "SELECT * FROM emun_er WHERE status = 0 order  by id DESC Limit 1";
                                                        }
                                                        $query_farms = mysqli_query($conn, $sql_farms);
                                                        $u_check_farms = mysqli_num_rows($query_farms);
                                                        $result = mysqli_query($conn, $sql_farms);
                                                        if($u_check_farms > 0){
                                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                            $ed_er = $row['emergency'];
                                                            $er_time = strtotime($row['date_created']);
                                                    ?>
                                                    <li class="d-block">
                                                        <div class="form-check w-100">
                                                            <div class="d-flex mt-2" style="margin-bottom: 100px;">
                                                                <div class="badge badge-opacity-warning me-3"><?php echo date('d-M-Y h:i:s a', $er_time); ?></div>
                                                            </div>
                                                            <label class="form-check-label" style="color: red">
                                                                Emergencies Available<i class="input-helper rounded"></i><br/>
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
                                                            <label class="form-check-label">
                                                                <?php if($account_type != 'user'){ ?>
                                                                    No Emergency Yet
                                                                <?php }else { ?>
                                                                    No Emergency By you Yet
                                                                <?php } ?>
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
                        <!-- End Emergency Section -->
                        <!-- Start Story Section -->
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="col-12 grid-margin stretch-card">
                                <a href="<?php echo $BASEURL; ?>?page=stories" class="col-12 grid-margin stretch-card slick">
                                    <div class="card card-rounded" style="
                                    background: linear-gradient(0deg, rgba(100, 255, 25, 0.2), rgba(255, 255, 255, 0.3)), url('appStyle/emun2.png');
                                    background-size: contain; ">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="add-items d-flex mb-0">
                                                    <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p">
                                                        <i class="mdi mdi-account-network"></i>
                                                    </button>
                                                </div>
                                                <h4 class="card-title card-title-dash" style="color: #590D07;">Share Your Story</h4>
                                            </div>
                                            <div class="list-wrapper">
                                                <ul class="todo-list todo-list-rounded">
                                                    <?php
                                                    $sql_stories = "SELECT * FROM emun_stories order  by id DESC Limit 1";
                                                    $query_stories= mysqli_query($conn, $sql_stories);
                                                    $u_check_stories = mysqli_num_rows($query_stories);
                                                    if($u_check_stories > 0){
                                                    ?>
                                                        <li class="d-block">
                                                            <div class="form-check w-100">
                                                                <div class="d-flex mt-2" style="margin-bottom: 100px;">
                                                                    <div class="badge badge-opacity-warning me-3"><?php echo date('d-M-Y h:i:s a'); ?></div>
                                                                </div>
                                                                <label class="form-check-label">
                                                                    Stories Available<i class="input-helper rounded"></i><br/>
                                                                    Care to share?
                                                                </label>
                                                            </div>
                                                        </li>
                                                    <?php }else { ?>
                                                    <li class="d-block">
                                                        <div class="form-check w-100">
                                                            <div class="d-flex mt-2" style="margin-bottom: 100px;">
                                                                <div class="badge badge-opacity-warning me-3">
                                                                    <?php echo date('d-M-Y h:i:s a'); ?>
                                                                </div>
                                                            </div>
                                                            <label class="form-check-label">No Stories Yet<i class="input-helper rounded"></i><br/>
                                                                Care to share?
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
                        <!-- End Story Section -->
                        <!-- Doctor Appointment Section -->
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="col-12 grid-margin stretch-card">
                                <a href="<?php if($account_type != 'user'){ echo $BASEURL.'?page=appointments'; } ?>"
                                   <?php if($account_type == "user"){ ?>data-bs-toggle="modal" data-bs-target="#myAppointments"<?php } ?>
                                   class="col-12 grid-margin stretch-card"
                                   style="
                                        border-bottom: solid 2px goldenrod;
                                        border-radius: 0px 0px  15px 15px;">
                                    <div class="card card-rounded"
                                         style="background: linear-gradient(0deg, rgba(255, 255, 255, 0.2), rgba(25, 100, 255, 0.3));">
                                        <div class="card-body" style="background:  url('appStyle/doctor.png'); background-size: contain;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="add-items d-flex mb-0">
                                                    <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p">
                                                        <i class="mdi mdi-account-card-details"></i>
                                                    </button>
                                                </div>
                                                <h4 class="card-title card-title-dash" style="color: #590D07;">Request Doctor</h4>
                                            </div>
                                            <div class="list-wrapper">
                                                <ul class="todo-list todo-list-rounded">
                                                    <?php
                                                        if($account_type == "user"){
                                                            $sql_app= "SELECT * FROM emun_pr WHERE user_id = '$user_id' and status != 2 order  by id DESC Limit 1";
                                                        }elseif ($account_type == "doctors"){
                                                            //check user
                                                            $sql_check = "SELECT * FROM emun_doctor WHERE user_id = '$user_id' ";
                                                            $query_check= mysqli_query($conn, $sql_check);
                                                            $u_check_check = mysqli_num_rows($query_check);
                                                            $my_search = "";
                                                            if($u_check_check > 0){
                                                                $row_check = mysqli_fetch_array($query_check, MYSQLI_ASSOC);
                                                                $my_search = $row_check['ed_code'];
                                                            }
                                                            $sql_app = "SELECT * FROM emun_pr WHERE ed_code = '$my_search' and status != 2 order  by id DESC Limit 1";
                                                        }else{
                                                            $sql_app = "SELECT * FROM emun_pr WHERE ed_code = NULL and status != 2 order  by id DESC Limit 1";
                                                        }
                                                        $query_app = mysqli_query($conn, $sql_app);
                                                        $u_check_app = mysqli_num_rows($query_app);
                                                        $result_app = mysqli_query($conn, $sql_app);
                                                        if($u_check_app > 0){
                                                        while ($row_app = mysqli_fetch_array($result_app, MYSQLI_ASSOC)){
                                                            $ed_er = $row_app['complication'];
                                                            $er_time = $row_app['appointment_date'];
                                                    ?>
                                                    <li class="d-block">
                                                        <div class="form-check w-100">
                                                            <div class="d-flex mt-2" style="margin-bottom: 100px;">
                                                                <div class="badge badge-opacity-warning me-3"><?php echo date('d-M-Y h:i:s a', $er_time); ?></div>
                                                            </div>
                                                            <label class="form-check-label">Appointments Available<i class="input-helper rounded"></i><br/>
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
                                                            <label class="form-check-label">No Appointments Pending<i class="input-helper rounded"></i><br/>
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
                        <!-- End Appointment Section -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include_once ("er/dashboard_widget.php");
?>
<!-- Model add doctors -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Send Emergency</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="forms-sample" action="<?php echo $BASEURL; ?>?page=send_er" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Emergency</label>
                        <input type="text" class="form-control" name="er" id="exampleInputUsername1" placeholder="Type Your Emergency" required>
                    </div>
                    <div class="form-group">
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
<!-- Model request doctors -->
<div class="modal" id="myAppointments">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Request for eMun Doctor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="forms-sample" action="<?php echo $BASEURL; ?>?page=send_pr" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Emergency</label>
                        <input type="text" class="form-control" name="er" id="exampleInputUsername1" placeholder="Type Your Emergency" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Contact Used on Merchant Pay</label>
                        <input type="tel" class="form-control" name="contact" id="exampleInputUsername1" placeholder="Contact" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Appointment Date & Time in 24hrs format</label>
                        <input type="datetime-local" class="form-control" name="appointment" id="date" placeholder="Appointment Date"
                               style="padding-bottom: 5px;" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Attach Payment Confirmation</label>
                        <input type="file" class="form-control" name="pr_image" id="exampleInputEmail1" required>
                    </div>
                    <button type="submit" class="btn btn-primary me-2" name="send">Send Request</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>