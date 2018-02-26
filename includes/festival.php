<!DOCTYPE html>
<?php
session_start();
include_once('db_connection.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Festival application 1.0</title>
        <!--fontawesome-->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <!--bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2hHLAoKfSIAFB1nqBZtuvdECCPj5zJwU&callback=initMap" type="text/javascript"></script>
        <script>
            function initMap() {
                //console.log(parseFloat(document.getElementById('show_lat').value));
                var uluru = {lat: parseFloat(document.getElementById('show_lat').value), lng: parseFloat(document.getElementById('show_lng').value)};
                var map = new google.maps.Map(document.getElementById('mapCanvas_show'), {
                    zoom: 16,
                    center: uluru
                });
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                });
            }

        </script>
        <style>
            #mapCanvas_show{
                width: 100%;
                height: 400px;
                /*overflow: auto !important;*/
            }
        </style>
    </head>
    <body>
        <?php
        require('db_connection.php');
        $list_festivals = "SELECT id, image, name, description, dateTime_start, dateTime_end, state, city, address, coordinates FROM festivals WHERE id = '" . $_GET['id'] . "'";
        $sql_info = mysqli_query($conn, $list_festivals);
        $results = mysqli_fetch_array($sql_info);
        $coordinates = explode(',', $results['coordinates']);
        ?>
        <div class="container">
            <div class="card" style="width: 40rem; margin:auto;" >
                <img class="card-img-top" src="../admin/images/<?php echo $results['image']; ?>" alt="festival">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $results['name']; ?></h5>
                    <p class="card-text">Time: <?php echo date('d.m.Y H:i:s', strtotime($results['dateTime_start'])) . ' - ' . date('d.m.Y H:i:s', strtotime($results['dateTime_end'])); ?></p>
                    <p class="card-text">Place: <?php echo $results['state'] . ',' . $results['city'] . ',' . $results['address']; ?></p>
                    <p class="card-text">Description: <?php echo $results['description']; ?></p>
                    <div id="mapCanvas_show"></div>
                    <input type="hidden" id="show_lat" value="<?php echo $coordinates[0]; ?>"/>
                    <input type="hidden" id="show_lng" value="<?php echo $coordinates[1]; ?>"/>
                </div>
            </div>
        </div>

    </body>
</html>