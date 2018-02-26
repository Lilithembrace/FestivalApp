<?php
date_default_timezone_set("Europe/Belgrade");
if (isset($_GET['update'])) {
    if ($_GET['update'] == 'true' && isset($_GET['id']) && $_GET['action'] == 'edit') {
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
            $image = $_FILES["uploaded_image"]["name"];
            $coordinates_update = $_POST['lat'].','.$_POST['lng'];
            $description = $_POST['description'];
            $created = date('Y-m-d H:i:s', strtotime($_POST['created_festival']));
            $edited = 'NOW()';
            if($image == ''){
                $image_query = mysqli_query($conn, "SELECT image FROM festivals WHERE id = '".$_GET['id']."'");
                $image_array = mysqli_fetch_array($image_query);
                $image = $image_array['image'];
            }
            var_dump($image);
            $update_festival_query = "UPDATE festivals SET name='" . $name . "' ,
                                                   dateTime_start='" . $date_start . "' ,
                                                   dateTime_end='" . $date_end . "' ,
                                                   state='" . $state . "' ,
                                                   city='" . $city . "' ,
                                                   address='" . $address . "' ,
                                                   coordinates='".$coordinates_update."',
                                                   image='" . $image . "' ,
                                                   description='" . trim($description) . "' ,
                                                   created='" . $created . "' ,
                                                   edited=" . $edited . " WHERE id = '".$_GET['id']."'";

            mysqli_query($conn, $update_festival_query);
        }
    }
}

$sql = "SELECT * FROM festivals WHERE id = '" . $_GET['id'] . "'";
$result = mysqli_query($conn, $sql);
$festivals = mysqli_fetch_array($result);
$coordinates = explode(',', $festivals['coordinates']);
$lat = $coordinates[0];
$lng = $coordinates[1];
?>
<div class="container" style = "background-color: ivory; border:1px solid #f3f3f3;">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-4"> Edit festival "<?php echo $festivals['name']; ?>"</h1>
            <form action="start.php?update=true&action=edit&id=<?php echo (int) $_GET['id'] ?>" method="POST" enctype="multipart/form-data" name="edit_festival">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $festivals['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="start-date-time">Start date/time:</label>
                    <input type="datetime-local" class="form-control" id="start-date-time" name="startDateTime" data-date-format="DD MM YYYY" value="<?php echo str_replace(" ", "T", $festivals['dateTime_start']) ?>">
                </div>
                <div class="form-group">
                    <label for="end-date-time">End date/time:</label>
                    <input type="datetime-local" class="form-control" id="end-date-time" name="endDateTime" data-date-format="DD MM YYYY" value="<?php echo str_replace(" ", "T", $festivals['dateTime_end']) ?>">
                </div>

                <div class="form-group">
                    <label for="state">State:</label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="Enter state" value="<?php echo $festivals['state']; ?>">
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" value="<?php echo $festivals['city']; ?>">
                </div>
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Enter street" value="<?php echo $festivals['address']; ?>">
                </div>
                <div id="mapCanvas_edit"></div>
                <input type="hidden" name="lat" id="lat_1" value = "<?php echo $lat;?>"/>
                <input type="hidden" name="lng" id="lng_1" value = "<?php echo $lng;?>"/>
                <div class="form-group">
                    <label for="image">Upload image:</label>
                    <input type="file" id="image" name="uploaded_image" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="descr">Description:</label>
                    <textarea class="form-control" id="descr" rows="3" name="description" style="resize: none;" ><?php echo trim($festivals['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="created">Time of creation:</label>
                    <input type="time" class="form-control" id="start-created-time" name="created_festival" value="<?php $created = $festivals['created'];
echo $created = date("H:i", strtotime($created)); ?>">
                </div>
                <div class="form-group">
                    <label for="edited">Time of edition:</label>
                    <input type="time" class="form-control" id="edited" name="edited_festival"  value="<?php echo date("H:i"); ?>">
                </div>

                <input type="submit" value="Edit" class="btn btn-primary"/>
            </form>
        </div>
    </div>
</div>