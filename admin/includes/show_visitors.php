<?php
date_default_timezone_set("Europe/Belgrade");
if (isset($_GET['action'])) {
    if (isset($_GET['id']) && $_GET['action'] == 'show') {
        
        echo '<h2 class="display-4"> List of visitors </h2><br />';
        echo '<ul class="list-group">';
        $visitors_query = "SELECT email, firstname, lastname, signup_time FROM visitors WHERE festival_id = '".$_GET['id']."'";
        $sql = mysqli_query($conn, $visitors_query);
        while($result = mysqli_fetch_array($sql)){
            $time = date('H:i:s', strtotime($result['signup_time']));
            echo '<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info">'.$result['firstname'].' '.$result['lastname'].' '.$result['email'].' '.$time.'</li>';
        }
    }
}
?>


