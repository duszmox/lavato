<?php
require_once("connect.php");
global $conn;
//todo nem tudom elérni a $conn var-t és ezt meg kéne tudni csinálni

function html_escape($html_escape)

        {
            $html_escape =  htmlspecialchars($html_escape, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            return $html_escape;
        }

function swal_error($text){
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Hibás Kód',
        text: '$text',
    });
</script>";
}
function display_errors(){
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}
function verify_hash($conn,$hash){
    $sql = "SELECT * FROM lavato_keys WHERE hash = '$hash'";
    echo  $sql;
    $row = mysqli_query($conn, $sql);
    if(mysqli_num_rows($row) >0){
        return true;
    }else{
        return false;
    }
}
function verify_class($class){
    if ($class == "A" or $class == "B" or $class == "C" or $class == "D"){
        return true;
    }else{
        return false;
    }
}
function log_action($action, $value){

    $sql = "INSERT INTO lavato_log (action, value, time) VALUES ('$action', '$value', ".date("Y:m:d H:m:s").")";
    //todo itt baszakszik

    //return mysqli_query($conn, $sql);

}
function upload_vote($class){
     $sql = "";
     echo "you voted for class " . $class;
}
        ?>