<?php
session_start();
if(isset($_POST['logout'])){
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
    header('Location: ../../login.php');
}
?>

