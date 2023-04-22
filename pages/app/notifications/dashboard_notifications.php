<?php
//select Health
$my_health = "none";
$sql_health = "SELECT * FROM hub_subs WHERE user_id = '$user_id'order by  id DESC";
$query_health = mysqli_query($conn, $sql_health);
$u_check_health = mysqli_num_rows($query_health);
if($u_check_health > 0) {
    $row = mysqli_fetch_array($query_health, MYSQLI_ASSOC);
    $health_id = $row['hub_id'];
    //get health sub
    $sql_health = "SELECT * FROM health_hub WHERE id = '$health_id'order by  id DESC";
    $query_health = mysqli_query($conn, $sql_health);
    $u_check_health = mysqli_num_rows($query_health);
    if($u_check_health > 0) {
        $row = mysqli_fetch_array($query_health, MYSQLI_ASSOC);
        $my_health = $row['health_type'];
    }
}
//select centers
$my_centers = "none";
$sql_centers = "SELECT * FROM emun_month order by  id DESC";
$query_centers = mysqli_query($conn, $sql_centers);
$u_check_centers = mysqli_num_rows($query_centers);
if($u_check_centers > 0) {
    $row_center = mysqli_fetch_array($query_centers, MYSQLI_ASSOC);
    $my_centers = $row_center['center']." --||-- Date & Time: ".$row_center['airing_time']." --||-- Location: ".$row_center['center_location'];
}
//select programs
$my_program = "none";
$sql_programs = "SELECT * FROM emun_broadcast order by  id DESC";
$query_programs = mysqli_query($conn, $sql_programs);
$u_check_programs = mysqli_num_rows($query_programs);
if($u_check_programs > 0) {
    $row_program = mysqli_fetch_array($query_programs, MYSQLI_ASSOC);
    $my_program = $row_program['title']." --||-- Airing Date & Time: ".$row_program['airing_time'];
}
?>
<div class="d-sm-flex align-items-center justify-content-between border-bottom" >
    <ul class="nav nav-tabs" role="tablist" >
        <li class="nav-item" >
            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview"
               role="tab" aria-controls="overview" aria-selected="true" style="padding-left: 10px;">--->Overview</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab" aria-selected="false">Health Schedule</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab" aria-selected="false">eMun Centers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">Current Program</a>
        </li>
    </ul>
    <div>
        <div class="btn-wrapper">
            <a href="<?php echo $BASEURL; ?>?page=stories" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
        </div>
    </div>
</div>
<div class="tab-content tab-content-basic">
    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
        <?php include_once ("dashboard_summary.php"); ?>
    </div>
    <div class="tab-pane fade" id="audiences" role="tabpanel" aria-labelledby="audiences">
        Current Health Schedule: <?php echo $my_health; ?>
    </div>
    <div class="tab-pane fade" id="demographics" role="tabpanel" aria-labelledby="demographics">
        Last Open Center: <?php echo $my_centers; ?>
    </div>
    <div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more">
        Last Aired Program: <?php echo $my_program; ?>
    </div>
</div>