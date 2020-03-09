<?php
//to use edit the parameters and rename the file to connect.php
$servername = "localhost";
$username = "root";
$password = "";
$db = "lavato";
// Create connection
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == "") {
    $_SESSION['username'] = "";
    $_SESSION['admin'] = "";
    $_SESSION['logged_in'] = 0;
}
function can_register(){
    return false;
}

global $page_url;
$page_url = "http://duszmo.f.fazekas.hu/lavato/";

global $conn;
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>