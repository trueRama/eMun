<?php
$sql_farms = "SELECT * FROM emun_er WHERE $ed_code status = 0 order  by id DESC";
//search doctors
if($account_type != 'user') {
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        //check user
        $sql_check = "SELECT * FROM users WHERE username = '$search' ";
        $query_check = mysqli_query($conn, $sql_check);
        $u_check_check = mysqli_num_rows($query_check);
        $my_search = "";
        if ($u_check_check > 0) {
            $row_check = mysqli_fetch_array($query_check, MYSQLI_ASSOC);
            $my_search = $row_check['id'];
        }
        //search
        $sql_farms = "SELECT * FROM emun_er WHERE $ed_code user_id = '$my_search' and status = 0 order  by id DESC";
    }
}
//set page pagination
$query_farms = mysqli_query($conn, $sql_farms);
$u_check_farms = mysqli_num_rows($query_farms);
$number_of_pages = ceil($u_check_farms/$results_per_page);
$sql_farms = "SELECT * FROM emun_er WHERE $ed_code status = 0 order  by id DESC LIMIT $this_page_first_result , $results_per_page";
if($account_type != 'user') {
    if (isset($_POST['search'])) {
        //check user
        $sql_check = "SELECT * FROM users WHERE username = '$search' ";
        $query_check = mysqli_query($conn, $sql_check);
        $u_check_check = mysqli_num_rows($query_check);
        $my_search = "";
        if ($u_check_check > 0) {
            $row_check = mysqli_fetch_array($query_check, MYSQLI_ASSOC);
            $my_search = $row_check['id'];
        }
        //search
        $sql_farms = "SELECT * FROM emun_er WHERE $ed_code user_id = '$my_search' and status = 0 order  by id DESC LIMIT $this_page_first_result , $results_per_page";
    }
}
$as_label = "Patient Name";
if($account_type == "user"){
    $view_details = 1;
}elseif ($account_type == "admin"){
    $view_details = 1;
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
                                                    <h4 class="card-title card-title-dash">
                                                        EMUN Emergencies
                                                    </h4>
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
                                                        <th>Emergency</th>
                                                        <th class="mmHide">eMUN Code</th>
                                                        <?php if($account_type != "user"){ ?>
                                                        <th class="mmHide"><?php echo $as_label; ?></th>
                                                        <th class="mmHide">Contact</th>
                                                        <?php } ?>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if($u_check_farms > 0){
                                                        $i = 0;
                                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                                            $i = ++$i;
                                                            $eId = $row['id'];
                                                            //emergency details
                                                            $ed_er = $row['emergency'];
                                                            $er_pic = $row['er_image'];
                                                            $er_time = $row['date_created'];
                                                            if($er_pic == NULL){
                                                                $er_pic = "appStyle/logo.png";
                                                            }
                                                            //doctor details
                                                            $er_user_id = $row['user_id'];
                                                            $ed_code = $row['ed_code'];
                                                            if($ed_code == NULL){
                                                                $ed_code = "Not Assigned";
                                                            }
                                                            if($account_type != 'doctor') {
                                                                if($recode_data_doctor == $ed_code){
                                                                    $view_details = 1;
                                                                }
                                                                //assigned to
                                                                $sql_doc= "SELECT * FROM emun_doctor WHERE ed_code = '$ed_code' ";
                                                                $query_doc= mysqli_query($conn, $sql_doc);
                                                                $u_check_doc= mysqli_num_rows($query_doc);
                                                                if($u_check_doc > 0){
                                                                    $row_check_doc = mysqli_fetch_array($query_doc, MYSQLI_ASSOC);
//                                                                    $er_user_id = $row_check_doc['user_id'];
//                                                                    $as_label = "Assigned to";
                                                                }
                                                            }
                                                            //patient Details
                                                            $sql_check = "SELECT * FROM users WHERE id = '$er_user_id' ";
                                                            $query_check= mysqli_query($conn, $sql_check);
                                                            $u_check_check = mysqli_num_rows($query_check);
                                                            $p_username = "";
                                                            $p_email = "";
                                                            $p_contact = "";
                                                            if($u_check_check > 0){
                                                                $row_check = mysqli_fetch_array($query_check, MYSQLI_ASSOC);
                                                                $p_username = $row_check['username'];
                                                                $p_email = $row_check['email'];
                                                                $p_contact = $row_check['contact'];
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
                                                                        <div>
                                                                            <h6><?php echo $ed_er; ?></h6>
                                                                            <p>
                                                                                Time and Date: <?php echo $er_time; ?><br/>
                                                                                <h6 class="mmShow">eMun Doctor: <?php echo $ed_code; ?></h6>
                                                                                <h6 class="mmShow"><?php echo $as_label; ?>: <?php echo $p_username; ?></h6>
                                                                            </p>
                                                                            <?php if($view_details != 0){ ?>
                                                                            <form method="post" action="<?php echo $BASEURL; ?>?page=er_details">
                                                                                <input type="hidden"  name="eId" value="<?php echo $eId; ?>" >
                                                                                <button type="submit" style="border: 0px; " class="badge badge-opacity-danger" name="editId">
                                                                                    View Details
                                                                                </button>
                                                                            </form>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="mmHide">
                                                                    <h6><?php echo $ed_code; ?></h6>
                                                                </td>
                                                                <?php if($account_type != "user"){ ?>
                                                                    <td class="mmHide">
                                                                        <h6><?php echo $p_username; ?></h6>
                                                                    </td>
                                                                    <td class="mmHide">
                                                                        <p><?php echo $p_email; ?></p>
                                                                        <p><?php echo $p_contact; ?></p>
                                                                    </td>
                                                                <?php } ?>
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
