<?php 
if ($_POST['submit']) {
    require_once("connect.php");
    global $conn;
    $sql = "SELECT `id`,`hash` FROM `lavato_keys`";
    header("Content-Disposition: attachment; filename=tables.xls");
    header("Content-Type: application/vnd.ms-excel");
    $user_query = mysqli_query($conn, $sql);
    $flag = false;
    while ($row = mysqli_fetch_assoc($user_query)) {
        if (!$flag) {
            echo implode("\t", array_keys($row)) . "\r\n";
            $flag = true;
        }
        echo implode("\t", array_values($row)) . "\r\n";
    }
}




?>