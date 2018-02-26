<?php
if(isset($_GET['update'])){
    header('Location: start.php');
}
require('../includes/db_connection.php');
include_once('includes/upload_images.php');
include_once('includes/new_festival.php');
require_once('includes/logout.php');
?>
<html>
    <?php require_once('../includes/head.php');?>
    <body>
        
        <?php 
        $hidden = '';
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            $hidden = 'style="display: none;"';
        }
?>
        <div class="container">
            <form action="../index.php" method="post">
            <input type="submit" value="Logout" name="logout" class="btn btn-default pull-right"/>
            </form>
            <div class="row">
                <div class="col-sm-6" <?php echo $hidden; ?>>
                    <h1 class="display-4"> Enter new festival </h1>
                    <form action="start.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="start-date-time">Start date/time:</label>
                            <input type="datetime-local" class="form-control" id="start-date-time" name="startDateTime" data-date-format="DD MM YYYY" value = "">
                        </div>
                        <div class="form-group">
                            <label for="end-date-time">End date/time:</label>
                            <input type="datetime-local" class="form-control" id="end-date-time" name="endDateTime" data-date-format="DD MM YYYY" value = "">
                        </div>
                        
                        <div class="form-group">
                            <label for="state">State:</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter state">
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                        </div>
                        <div class="form-group">
                            <label for="street">Street:</label>
                            <input type="text" class="form-control" id="street" name="street" placeholder="Enter street">
                        </div>
                        
                        <div id="mapCanvas"></div>
                        <input type="hidden" name="lat" id="lat"/>
                        <input type="hidden" name="lng" id="lng"/>
                        
                        <div class="form-group">
                            <label for="image">Upload image:</label>
                            <input type="file" id="image" name="uploaded_image" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="descr">Description:</label>
                            <textarea class="form-control" id="descr" rows="3" name="description" style="resize: none;"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="created">Time of creation:</label>
                            <input type="time" class="form-control" id="start-created-time" name="created_festival" value="<?php echo date("H:i");?>">
                        </div>
                        <div class="form-group">
                            <label for="edited">Time of edition:</label>
                            <input type="time" class="form-control" id="edited" name="edited_festival" value="<?php echo date("H:i");?>">
                        </div>
                            <input type="submit" value="Enter new" name="new_festival" class="btn btn-primary"/>
                            
                    </form>
                </div>
                <div class="col-sm-6">
                    <?php include('includes/festivals_list.php');?>
                </div>
            </div>
        </div>
    </body>
</html>