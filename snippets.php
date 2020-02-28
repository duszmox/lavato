<?php
require_once("connect.php");

function html_escape($html_escape){
    $html_escape = htmlspecialchars($html_escape, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return $html_escape;
}

function swal_error($title,$text)
{
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: '$title',
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
    $sql = "SELECT * FROM lavato_keys WHERE hash = '$hash'";
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
    $sql = "UPDATE lavato_keys SET hasBeenActivated=1 WHERE hash='$hash'";
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
        //todo ellenorize, hogy van-e mar ilyen hash
    }
}

function hasBeenActivated($hash) {
    global $conn;
    $sql = "SELECT * FROM lavato_keys WHERE hash='$hash' AND hasBeenActivated=0";
    $row = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row) == 1)
    {
        log_action("hash_activated", "$hash _activated");
        return true;
    } else {
        return false;
    }
}
function validate_user($username, $password){
    global $conn;
    $sql = "SELECT * FROM lavato_users WHERE username='$username'";
    $row = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row) == 1)
    {
        $result = mysqli_fetch_assoc($row);
        if($result['password'] == hash("sha256", $password)){

            return true;

        }
    } else {
        return false;
    }
}
function get_userdata($username){
    global $conn;
    return mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM lavato_users WHERE username='$username'"));
}
function login_user($username){
    log_action("login", $username);
    $userdata = get_userdata($username);

    $_SESSION['username'] = $username;
    $_SESSION['admin'] = $userdata["admin"];
    $_SESSION['logged_in'] = 1;

    return true;
}
function logout_user($username){
    log_action("logout", $username);

    $_SESSION['username'] = "";
    $_SESSION['admin'] = "";
    $_SESSION['logged_in'] = 0;
}
function user_logged_in(){
    return $_SESSION['logged_in'];
}
function is_admin(){
    return $_SESSION['admin'];
}
function register_user($username, $password){
    if(!can_register()){return false;}
    global $conn;
    if(!empty(get_userdata($username))){
        echo "Már foglalt felhaszálónév";
        return false;
    }
    $sql = "INSERT INTO lavato_users (username, password) VALUES ('$username', '".hash("sha256", $password)."')";
    echo $sql;
    log_action("register_user", $username);
    return mysqli_query($conn, $sql);
}


?>