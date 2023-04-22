<?php
$target_dir = "uploads/profiles/";
$target_file = $target_dir . $username_up.".png";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$check = getimagesize($_FILES["file"]["tmp_name"]);
// Check if image file is a actual image or fake image
if($check != false) {
    $error = "File is an image - " . $check["mime"];
    $uploadOk = 1;
} else {
    $error = "File is not an image.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 5000000) {
    $error = $error." & Sorry, your file is too large";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $error = $error." & Sorry, only JPG, JPEG, PNG & GIF files are allowed";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error = $error." & Sorry, your file was not uploaded";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $error = $error." & The file ". basename( $_FILES["file"]["name"]). " has been uploaded";
    } else {
        $error = $error." & Sorry, there was an error uploading your file";
    }
}
