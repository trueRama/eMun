<?php
//Queries Summary
$em = "SELECT * FROM emun_er WHERE $ed_code status = 0 order  by id DESC";
$em = mysqli_query($conn, $em);
$em = mysqli_num_rows($em);
$ap = "SELECT * FROM emun_pr WHERE $ed_code status != 2 order  by id DESC";
$ap = mysqli_query($conn, $ap);
$ap = mysqli_num_rows($ap);
$ss = "SELECT * FROM emun_broadcast order  by id DESC";
$ss = mysqli_query($conn, $ss);
$ss = mysqli_num_rows($ss);
$cs = "SELECT * FROM emun_month order  by id DESC";
$cs = mysqli_query($conn, $cs);
$cs = mysqli_num_rows($cs);
$st = "SELECT * FROM emun_stories order  by id DESC";
$st_result = mysqli_query($conn, $st);
$st_no = mysqli_num_rows($st_result);
if($st_no > 0){
    $is = 0;
    while ($row = mysqli_fetch_array($st_result, MYSQLI_ASSOC)){
        $story_id = $row['id'];
        $sql_check_status = "SELECT * FROM delete_story WHERE story_id = '$story_id' and user_id = '$user_id' ";
        $query_check_status = mysqli_query($conn, $sql_check_status);
        $u_check_check_status = mysqli_num_rows($query_check_status);
        $status = 0;
        if($u_check_check_status == 0){
            $is ++;
        }
    }
    $st_no = $is;
}
$hb = "SELECT * FROM health_hub order  by id DESC";
$hb = mysqli_query($conn, $hb);
$hb = mysqli_num_rows($hb);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="statistics-details d-flex align-items-center justify-content-between">
            <div>
                <p class="statistics-title">Emergencies</p>
                <h3 class="rate-percentage text-danger"><?php echo $em; ?></h3>
            </div>
            <div>
                <p class="statistics-title">Appointments</p>
                <h3 class="rate-percentage text-success"><?php echo $ap; ?></h3>
            </div>
            <div>
                <p class="statistics-title">Sessions</p>
                <h3 class="rate-percentage"><?php echo $ss; ?></h3>
            </div>
            <div class="d-none d-md-block">
                <p class="statistics-title">Centers</p>
                <h3 class="rate-percentage"><?php echo $cs; ?></h3>
            </div>
            <div class="d-none d-md-block">
                <p class="statistics-title">Stories</p>
                <h3 class="rate-percentage"><?php echo $st_no; ?></h3>
            </div>
            <div class="d-none d-md-block">
                <p class="statistics-title">Health Options</p>
                <h3 class="rate-percentage"><?php echo $hb; ?></h3>
            </div>
        </div>
    </div>
</div>