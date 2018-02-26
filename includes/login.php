<?php

$email = 'admin@admin.com';
$password = 'password123';

$_SESSION['user'] = $email;
$_SESSION['pass'] = $password;

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
   if ($_POST['email'] == $email && $_POST['password'] == $password) {
      header('Location: admin/start.php');
   }else {
      echo '<div class="alert alert-danger" role="alert"> Wrong username or password </div>';
   }
}
?>

