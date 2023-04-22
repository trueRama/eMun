<?php
//Handling the Login Credentials
if($_SERVER['REQUEST_METHOD']=='POST'){
    $emergency = filter_input(INPUT_POST, 'er');
    $er_image = getimagesize($_FILES["er_image"]["tmp_name"]);
    $target_dir = "uploads/documents/";
    $error = "";
    //generate emun doctor ID
    $sql_UID = "SELECT * FROM emun_er order  by id DESC Limit 1";
    $query_UID = mysqli_query($conn, $sql_UID);
    $u_check_UID = mysqli_num_rows($query_UID);
    $ER = "ER".rand(1000,2000);
    if($u_check_UID > 0){
        $row = mysqli_fetch_array($query_UID);
        $ID = $row['id'];
        $ER = "ER".rand(1000,2000);
        $ER = $ER.$ID;
    }
    $target_file = $target_dir.$ER.".png";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is actual image or fake image
    if($er_image) {
        $error = "File is an image - " . $er_image["mime"] . ".";
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
            $error = "Emergency has been Sent";
            $messageInsertSQL = "INSERT INTO emun_er (emergency, er_image, user_id)
            VALUES ('$emergency', '$target_file', '$user_id')";
            $messageInsertQuery = mysqli_query($conn, $messageInsertSQL);
        } else {
            $error = $error." & Sorry, there was an error uploading your file.";
        }
    }
    echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.alert('$error')
         window.location.href='$BASEURL?page=unassigned_ers'
     </SCRIPT>");
}