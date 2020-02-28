<?php
require_once("connect.php");

//todo nem tudom elérni a $conn var-t és ezt meg kéne tudni csinálni

function html_escape($html_escape)

{
    $html_escape = htmlspecialchars($html_escape, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return $html_escape;
}

function swal_error($text)
{
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Hibás Kód',
        text: '$text',
    });
</script>";
}

function display_errors()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

function verify_hash($hash)
{
    global $conn;
    $sql = "SELECT * FROM lavato_keys WHERE hash = '$hash' AND hasBeenActivated=false";
    $row = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row) == 1)
    {
        log_action("hash_verification", "$hash _verified");
        return true;
    } else {
        return false;
    }
}

function verify_class($class)
{
    if ($class == "A" or $class == "B" or $class == "C" or $class == "D") {
        return true;
    } else {
        return false;
    }
}

function disable_hash($hash)
{
    global $conn;
    $sql = "UPDATE lavato_keys SET hasBeenActivated=true WHERE hash='$hash'";
    return mysqli_query($conn, $sql);
}

function log_action($action, $value)
{
    global $conn;
    $sql = "INSERT INTO lavato_log (action, value) VALUES ('$action', '$value')";

    return mysqli_query($conn, $sql);


}

function upload_vote($class, $hash)
{
    global $conn;
    $sql = "UPDATE lavato_keys SET class='$class' WHERE hash='$hash'";
    log_action("class_vote", "$class");
    return mysqli_query($conn, $sql);
}
function get_class_votes(){
    global $conn;
    $sql = "SELECT * FROM lavato_keys WHERE hasBeenActivated=1";
    $raw = mysqli_query($conn,$sql);
    $class_data = array("A" => 0, "B" => 0,"C" => 0,"D" => 0);
    while($res = mysqli_fetch_array($raw)){
        switch ($res["class"]){
            case 'A':
                $class_data['A'] += 1;
                break;
            case 'B':
                $class_data['B'] += 1;
                break;
            case 'C':
                $class_data['C'] += 1;
                break;
            case 'D':
                $class_data['D'] += 1;
                break;
        }

    }





    return $class_data;
}
function create_random_data($max, $hasBeenActivated){
    global $conn;
    $classes = array("A","B","C","D");
    for($i =0;$i<$max;$i++){
        $class = rand(0,3);
        $hash = bin2hex(random_bytes(32));
        $sql = "INSERT INTO lavato_keys (hash, hasBeenActivated,class) VALUES ('$hash', '$hasBeenActivated' ,'$classes[$class]')";
        mysqli_query($conn, $sql);
    }
}
?>