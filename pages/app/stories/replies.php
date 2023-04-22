<?php
//get Story replies
$sql_reply = "SELECT * FROM story_reactions WHERE story_id = '$story_id' order  by id ASC";
//set page pagination
$query_reply = mysqli_query($conn, $sql_reply);
$u_check_reply = mysqli_num_rows($query_reply);
//set page results
$result_reply = mysqli_query($conn, $sql_reply);
if($u_check_reply > 0){
    while ($row_reply = mysqli_fetch_array($result_reply, MYSQLI_ASSOC)){
        //get story variables
        $story_img_reply = $row_reply['reply_image'];
        if($story_img_reply != ""){
            $story_img_reply = "<img src='$story_img_reply' style='right: 100px; width: 100px;'/><br/>";
        }else{
            $story_img_reply = "";
        }
        $story_body_reply = $row_reply['reply_text'];
        $story_date_reply = $row_reply['date_created'];
        $story_id_reply = $row_reply['id'];
        //story account status
        $sql_check_status_reply = "SELECT * FROM delete_reply WHERE reply_id = '$story_id_reply' and user_id = '$user_id' ";
        $query_check_status_reply = mysqli_query($conn, $sql_check_status_reply);
        $u_check_check_status_reply = mysqli_num_rows($query_check_status_reply);
        $status_reply = 0;
        if($u_check_check_status_reply > 0){
            $row_check_status_reply = mysqli_fetch_array($query_check_status_reply, MYSQLI_ASSOC);
            $status_reply = $row_check_status_reply['statu'];
        }
        //get the storyteller
        $story_post_id_reply = $row_reply['user_id'];
        //get username and account type
        $story_poster_reply = "";
        //get user table
        $sql_check_reply = "SELECT * FROM users WHERE id = '$story_post_id_reply' ";
        $query_check_reply = mysqli_query($conn, $sql_check_reply);
        $u_check_check_reply = mysqli_num_rows($query_check_reply);
        if($u_check_check_reply > 0){
            $row_check_reply = mysqli_fetch_array($query_check_reply, MYSQLI_ASSOC);
            $story_poster_reply = $row_check_reply['username'];
        }
        $button_clear2 = '
            <form method="post" action="'.$BASEURL.'?page=stories">
                <input type="hidden" name="clear_chat" value="'.$story_id_reply.'">
                <button type="submit" name="clear_reply" 
                class="add btn btn-icons btn-rounded btn-primary text-white me-0 pl-12p"
                    style="float: right; padding:0px; width: 30px; height: 30px;">
                    <i class="mdi mdi-delete-circle"></i>
                </button>
            </form>
        ';
        if($status_reply == 0){
?>
<li class="d-block completed my_charts_replies" style="border-bottom: solid 2px yellowgreen;">
    <div class="form-check w-100">
        <label style="width: 100%">
            reply by <?php echo $story_poster_reply; ?>, <br/>
            <?php echo $story_img_reply; ?>
            <p><?php echo $story_body_reply; ?></p>
            <div class="badge badge-opacity-warning me-3"><?php echo $story_date_reply; ?></div>
        </label>
        <?php echo $button_clear2; ?>
    </div>
</li>
<?php } } }