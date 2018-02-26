<?php

$target_dir = "images/";
if(isset($_FILES["uploaded_image"]["name"])){
    $target_file = $target_dir . basename($_FILES["uploaded_image"]["name"]);
    $no_error = 1;

    if ($no_error == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        move_uploaded_file($_FILES["uploaded_image"]["tmp_name"], $target_file);
    }
    
}
?>
