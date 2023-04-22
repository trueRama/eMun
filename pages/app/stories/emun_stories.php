<script>
    const delayInMilliseconds = 120000; //2 min
    setTimeout(function() {
        // window.alert('Changing Screen')
        window.location.href='<?php echo $BASEURL; ?>?page=<?php echo $page; ?>'
    }, delayInMilliseconds);
</script>
<?php
//story query
$sql_farms = "SELECT * FROM emun_stories order  by id DESC";
//set page pagination
$query_farms = mysqli_query($conn, $sql_farms);
$u_check_farms = mysqli_num_rows($query_farms);
//set page results
$result = mysqli_query($conn, $sql_farms);
//post story
if(isset($_POST['post_story'])){
    $story = $_POST['story'];
    $file = $_FILES["er_image"]["size"];
    if($file != 0){
        //generate emun doctor ID
        $sql_UID = "SELECT * FROM emun_stories order  by id DESC Limit 1";
        include_once ("upload_file.php");
        $file = $target_file;
    }else{
        $file = "";
    }
    //Insert Story
    $error = "Record Added Successfully";
    $messageInsertSQL = "INSERT INTO emun_stories (story_text, story_image, user_id)
            VALUES ('$story', '$file', '$user_id')";
    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
}
//reply
if(isset($_POST['reply'])){
    $main_id = $_POST['story_id'];
    echo "$main_id <br/>";
    $story = $_POST['story'];
    echo "$story <br/>";
    $file = $_FILES["er_image"]["size"];
    if($file != 0){
        //generate emun doctor ID
        $sql_UID = "SELECT * FROM story_reactions order  by id DESC Limit 1";
        include_once ("upload_file.php");
        $file = $target_file;
         echo "$main_id <br/>";
    }else{
        $file = "";
    }
    //Insert Story
    $error = "Record Added Successfully";
    $messageInsertSQL = "INSERT INTO story_reactions (story_id, reply_text, reply_image, user_id)
            VALUES ('$main_id', '$story', '$file', '$user_id')";
    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
}
//delete story from my chart
if(isset($_POST['clear'])) {
    $clear_chat = $_POST['clear_chat'];
    $error = "Record Added Successfully";
    $messageInsertSQL = "INSERT INTO delete_story (story_id, user_id)
            VALUES ('$clear_chat', '$user_id')";
    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
}
//delete story from my chart
if(isset($_POST['clear_reply'])) {
    $clear_chat = $_POST['clear_chat'];
    $messageInsertSQL = "INSERT INTO delete_reply (reply_id, user_id)
            VALUES ('$clear_chat', '$user_id')";
    $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.location.href='$BASEURL?page=stories'
     </SCRIPT>");
}
?>
<style>
    .my_charts{
        margin-left:100px;
        margin-bottom: 15px;
        margin-right: 50px;
        border-bottom: solid 2px goldenrod;
    }
    .my_charts_replies{
        padding: 10px;
        margin-left:120px; margin-bottom: 15px; margin-right: 50px;
        /*background-color: lightpink;*/
        border-radius: 45px 10px 50px 10px;
    }
    .list-wrapper ul li {
        padding: 10px;
        border-bottom: solid 2px goldenrod;
    }
    .my_user{
        padding: 10px;
        margin-left:50px; margin-bottom: 15px;
        background-color: lightskyblue;
        border-radius: 45px 10px 50px 10px;
        margin-right: 50px;
    }
    .my_admin{
        padding: 10px;
        background-color: rgba(211,211,211,0.2);
        border-radius: 45px 10px 50px 10px;
        margin-left:25px; margin-bottom: 15px; margin-right: 50px;
    }
    @media (max-width: 991px){
        .my_charts{
            margin-left:10px;
            margin-right: 10px;
        }
        .my_charts_replies{
            margin-left:10px;
            margin-right: 10px;
        }
        .my_user{
            margin-left:10px;
            margin-right: 10px;
        }
        .my_admin{
            margin-left:10px;
            margin-right: 10px;
        }
    }
</style>
<div class="row flex-grow" style="margin-top: 25px;">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title card-title-dash">eMun Chat</h4>
                            <div class="add-items d-flex mb-0">
                                <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p" data-bs-toggle="modal" data-bs-target="#myModal">
                                    <i class="mdi mdi-share-variant"></i>
                                </button>
                            </div>
                        </div>
                        <div class="list-wrapper" style="padding-top: 20px;">
                            <ul class="todo-list todo-list-rounded"
                                style="height: 650px; overflow-y: auto; display: flex;
                                flex-direction: column-reverse;">
                                <?php if($u_check_farms > 0){ ?>
                                    <li class="d-block completed" style="padding: 10px; margin: 10px; background-color: lightskyblue; border-radius: 10px 10px 10px 10px;">
                                        <div class="form-check w-100">
                                            <label style="width: 100%">
                                                <p>Continue Sharing</p>
                                                <div class="badge badge-opacity-warning me-3">
                                                    <?php echo date('d-M-Y h:i:s a'); ?></div>
                                            </label>
                                        </div>
                                    </li>
                                    <?php
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        //get story variables
                                        $story_img = $row['story_image'];
                                        if($story_img != ""){
                                            $story_img = "<img src='$story_img' style='right: 100px; width: 100px;'/><br/>";
                                        }else{
                                            $story_img = "";
                                        }
                                        $story_body = $row['story_text'];
                                        $story_date = $row['date_created'];
                                        $story_id = $row['id'];
                                        //story account status
                                        $sql_check_status = "SELECT * FROM delete_story WHERE story_id = '$story_id' and user_id = '$user_id' ";
                                        $query_check_status = mysqli_query($conn, $sql_check_status);
                                        $u_check_check_status = mysqli_num_rows($query_check_status);
                                        $status = 0;
                                        if($u_check_check_status > 0){
                                            $row_check_status = mysqli_fetch_array($query_check_status, MYSQLI_ASSOC);
                                            $status = $row_check_status['status'];
                                        }
                                        $reply_button = '
                                        <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"
                                         data-bs-toggle="modal" data-bs-target="#reply'.$story_id.'" style="padding:0px; width: 20px; height: 20px;">
                                            <i class="mdi mdi-reply"></i>
                                        </button>';
                                        $button_clear = '
                                            <form method="post" action="'.$BASEURL.'?page=stories">
                                                <input type="hidden" name="clear_chat" value="'.$story_id.'">
                                                <button type="submit" name="clear" class="add btn btn-icons btn-rounded btn-primary text-white me-0 pl-12p"
                                                    style="float: right; padding:0px; width: 30px; height: 30px;">
                                                    <i class="mdi mdi-delete-circle"></i>
                                                </button>
                                            </form>
                                            ';
                                        //get the storyteller
                                        $story_post_id = $row['user_id'];
                                        //get username and account type
                                        $story_poster = "";
                                        $story_account = "";
                                        //get user table
                                        $sql_check = "SELECT * FROM users WHERE id = '$story_post_id' ";
                                        $query_check= mysqli_query($conn, $sql_check);
                                        $u_check_check = mysqli_num_rows($query_check);
                                        if($u_check_check > 0){
                                            $row_check = mysqli_fetch_array($query_check, MYSQLI_ASSOC);
                                            $story_poster = $row_check['username'];
                                            $story_account = $row_check['account_type'];
                                        }
                                        //if me owner
                                        if($story_post_id == $user_id) {
                                            $story_poster = $username;
                                        }
                                        //if account is admin
                                        if($story_account == "admin"){
                                            $story_poster = "admin";
                                        }
                                        include ("replies.php");
                                        //set displays
                                        if($status == 0){
                                            if($story_poster == $username){
                                    ?>
                                    <li class="d-block completed my_charts">
                                        <div class="form-check w-100">
                                            <label style="width: 100%">
                                                Posted by Me, <br/>
                                                <?php echo $story_img; ?>
                                                <p><?php echo $story_body; ?></p>
                                                <div class="badge badge-opacity-warning me-3"><?php echo $story_date; ?></div>
                                                <?php echo $reply_button; ?>
                                            </label>
                                            <?php echo $button_clear; ?>
                                        </div>
                                    </li>
                                <?php } elseif ($story_poster == "admin") { ?>
                                <li class="d-block completed my_admin" style="border-bottom: solid 2px lightblue;">
                                    <div class="form-check w-100">
                                        <label style="width: 100%">
                                            Posted by eMun Doctor, <br/>
                                            <?php echo $story_img; ?>
                                            <p><?php echo $story_body; ?></p>
                                            <div class="badge badge-opacity-warning me-3"><?php echo $story_date; ?></div>
                                            <?php echo $reply_button; ?>
                                        </label>
                                        <?php echo $button_clear; ?>
                                    </div>
                                </li>
                                <?php }else{ ?>
                                <li class="d-block completed my_user" style="border-bottom: solid 2px yellowgreen;">
                                    <div class="form-check w-100">
                                        <label style="width: 100%">
                                            Posted by <?php echo $story_poster; ?>, <br/>
                                            <?php echo $story_img; ?>
                                            <p><?php echo $story_body; ?></p>
                                            <div class="badge badge-opacity-warning me-3"><?php echo $story_date; ?></div>
                                            <?php echo $reply_button; ?>
                                        </label>
                                        <?php echo $button_clear; ?>
                                    </div>
                                </li>
                                <?php } ?>
                                <!-- replay -->
                                <div class="modal" id="reply<?php echo $story_id; ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Reply to this Story <?php echo $story_id; ?></h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo $BASEURL; ?>?page=stories" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="exampleInputUsername1">Story Box</label>
                                                        <textarea name="story" class="form-control" placeholder="Type Your Story here"
                                                                  oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Attach a Picture</label>
                                                        <input type="file" class="form-control" name="er_image" id="exampleInputEmail1">
                                                        <input type="hidden" name="story_id" value="<?php echo $story_id; ?>">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-sm" name="reply" style="padding:10px;">Post Story</button>
                                                </form>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } } } else{  ?>
                                <li class="d-block completed" style="padding: 10px; margin: 10px; background-color: lightskyblue; border-radius: 10px 10px 10px 10px;">
                                    <div class="form-check w-100">
                                        <label style="width: 100%">
                                            <p>No stories for you Yet</p>
                                            <div class="badge badge-opacity-warning me-3">
                                                <?php echo date('d-M-Y h:i:s a'); ?></div>
                                        </label>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Model add doctors -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Share Store With eMun Community</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form class="forms-sample" action="<?php echo $BASEURL; ?>?page=stories" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Story Box</label>
                        <textarea name="story" class="form-control" placeholder="Type Your Story here" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Attach a Picture</label>
                        <input type="file" class="form-control" name="er_image">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" name="post_story" style="padding:10px;">Post Story</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
