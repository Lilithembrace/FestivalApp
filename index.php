<!DOCTYPE html>
<?php
session_start();
include_once('includes/db_connection.php');
include_once('includes/login.php');
?>
<html>
    <?php require_once('includes/head.php'); ?>
    <body>
        <h1 class="display-2"> Festivals </h1>
        <div class="list-group">
            <?php
            $sql = "SELECT COUNT(*) FROM festivals";
            $result = mysqli_query($conn, $sql);
            $r = mysqli_fetch_row($result);
            $numrows = $r[0];

            $rowsperpage = 10;

            $totalpages = ceil($numrows / $rowsperpage);
            if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
                $currentpage = (int) $_GET['currentpage'];
            } else {
                $currentpage = 1;
            }
            if ($currentpage > $totalpages) {
                $currentpage = $totalpages;
            }
            if ($currentpage < 1) {
                $currentpage = 1;
            }
            $offset = ($currentpage - 1) * $rowsperpage;


            $list_festivals = "SELECT id, image, name, description, dateTime_start, dateTime_end, state, city, address, coordinates FROM festivals ORDER BY id DESC LIMIT $offset, $rowsperpage";
            $sql_info = mysqli_query($conn, $list_festivals);
            while ($results = mysqli_fetch_array($sql_info)) {
                $coordinates = explode(',', $results['coordinates']);
                echo '<li class="list-group-item">
                          <img src="admin/images/' . $results['image'] . '" alt="festival" class="img-responsive" style="height: 200px;"/> 
                          <h4>' . $results['name'] . '</h4> Start date: ' . date('d.m.Y H:i', strtotime($results['dateTime_start'])) . ' <br /> End date: ' . date('d.m.Y H:i', strtotime($results['dateTime_end'])) . '<br /> Place: ' . $results['state'] . ',' . $results['city'] . ',' . $results['address'] . '
                         <br />
                         <br />
                         <a href="includes/festival.php?id='.$results['id'].'" class="btn btn-info">View festival</a>
                         
                         <a href="includes/check_in.php?id='.$results['id'].'" class="btn btn-primary">Check in</a>
                         </li>';
            }
            $range = 3;
            echo '<br /><nav aria-label="pagination">
              <ul class="pagination justify-content-center">';

            if ($currentpage > 1) {
                $prevpage = $currentpage - 1;

                echo '<li class="page-item">';
                echo "<a class='page-link' tabindex='-1' href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>Previous</a> ";
                echo '</li>';
            }


            for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {

                if (($x > 0) && ($x <= $totalpages)) {

                    if ($x == $currentpage) {

                        echo "<li class='page-item disabled'><a class='page-link' href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></li>";
                    } else {

                        echo "<li class='page-item'><a class='page-link' href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></li>";
                    }
                }
            }
            if ($currentpage != $totalpages && $numrows != '0') {
                $nextpage = $currentpage + 1;
                echo '<li class="page-item">';
                echo "<a class='page-link' href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Next</a>";
                echo '</li>';
            }
            echo '</ul></nav>'
            ?>

        </div>
        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#login-modal">Admin Login</button>

        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="login-label">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <h1 class="display-4"> Login </h1>
                                <div class="col-sm-12">
                                    <form action="index.php" method="POST">
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
                                        </div>
                                        <input type="submit" value="Login" class="btn btn-primary"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
