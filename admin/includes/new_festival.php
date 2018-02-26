<?php
date_default_timezone_set("Europe/Belgrade");
if(!isset($_GET['update'])){
    if(isset($_POST['name']) && !empty($_POST['name']) ||
        isset($_POST['startDateTime']) && !empty($_POST['startDateTime']) ||
        isset($_POST['endDateTime']) && !empty($_POST['endDateTime']) ||
        isset($_POST['state']) && !empty($_POST['state']) ||
        isset($_POST['city']) && !empty($_POST['city']) ||
        isset($_POST['street']) && !empty($_POST['street']) ||
        isset($_POST['lat']) && !empty($_POST['lat']) ||
        isset($_POST['lng']) && !empty($_POST['lng']) ||
        isset($_POST['description']) && !empty($_POST['description']) ||
        isset($_POST['created_festival']) && !empty($_POST['created_festival']) ||
        isset($_POST['edited_festival']) && !empty($_POST['edited_festival']) ||
        isset($_FILES["uploaded_image"]["name"])
      ){
        $name = $_POST['name'];
        $date_start = $_POST['startDateTime'];
        $date_end = $_POST['endDateTime'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $address = $_POST['street'];
        $coordinates = $_POST['lat'].','.$_POST['lng'];
        $image = $_FILES["uploaded_image"]["name"];
        $description = $_POST['description'];
        $created = 'NOW()';
        $edited = 'NOW()';
        $insert_festival_query = "INSERT INTO festivals (name, dateTime_start, dateTime_end, state, city, address, coordinates, image, description, created, edited)
                                  VALUES ('".$name."','".$date_start."','".$date_end."','".$state."','".$city."','".$address."','".$coordinates."','".$image."','".$description."',".$created.",".$edited.")";
        mysqli_query($conn, $insert_festival_query);

    }
}



