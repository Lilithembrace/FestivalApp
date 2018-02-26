<?php

if(isset($_GET['action'])){
    $action = $_GET['action'];
    switch ($action){
        case 'edit':
            require_once('includes/edit_festival.php');
            die();
            break;
        case 'show':
            require_once('includes/show_visitors.php');
            die();
            break;
        case 'delete':
            $sql = "DELETE FROM festivals WHERE id = '".(int)$_GET['id']."'";
            mysqli_query($conn, $sql);
            break;
    }
}
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

$sql = "SELECT id, name FROM festivals LIMIT $offset, $rowsperpage";
$result = mysqli_query($conn, $sql);
echo '<h2 class="display-4"> List of all festivals </h2><br />';
echo '<ul class="list-group">';
while ($list = mysqli_fetch_assoc($result)) {
   echo '<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info">'. 
           $list['name']
        .'<span class="badge badge-primary badge-pill"><a href="start.php?action=edit&id='.(int)$list['id'].'" style="color:white;">Edit</a> | <a href="start.php?action=show&id='.(int)$list['id'].'" style="color:white;">Show</a> | <a href="start.php?action=delete&id='.(int)$list['id'].'" style="color:white;">Delete</a> </span>';
} 
echo '</ul>';

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
    echo  "<a class='page-link' href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Next</a>";
    echo '</li>';
   
} 
echo '</ul></nav>'
?>

