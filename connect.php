<?php
$servername = "localhost";
$username = "duszmo";
$password = "ThanosPapa9?";
$db = "duszmo";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo("<script>alert('We are gooing.')</script>");
}


?>