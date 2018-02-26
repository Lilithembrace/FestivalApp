<!DOCTYPE html>
<?php
if(isset($_GET['update']) && $_GET['update'] == 'true'){
    header('Location: ../index.php');
}
session_start();
include_once('db_connection.php');
?>
<html>
    <?php require_once('head.php'); ?>
    <body>
        <?php
        if (isset($_POST['email_visitor']) && !empty($_POST['email_visitor']) &&
                isset($_POST['firstname']) && !empty($_POST['firstname']) &&
                isset($_POST['lastname']) && !empty($_POST['lastname']) && isset($_GET['id'])) {
            $email = $_POST['email_visitor'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $signup_time = 'NOW()';
            $id = $_GET['id'];
            
            $insert_visitors = "INSERT INTO visitors (festival_id, email, firstname, lastname, signup_time) VALUES ('".$id."', '".$email."', '".$firstname."', '".$lastname."', ".$signup_time.")";
            mysqli_query($conn, $insert_visitors);
        }
        ?>
        <div class="container">
            <form action="check_in.php?id=<?php echo $_GET['id']; ?>&update=true" method="POST">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email_visitor" placeholder="Enter email" required="">
                </div>
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control" name="firstname" placeholder="Firstname" required="">
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Lastname" required="">
                </div>
                <input type="submit" value="Check in" class="btn btn-primary"/>
            </form>
        </div>

    </body>
</html>