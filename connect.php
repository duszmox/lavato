<?php
<<<<<<< HEAD

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "lavato";

// Create connection

    global $conn;
    $conn = new mysqli($servername, $username, $password, $db);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        //echo("<script>alert('We are gooing.')</script>");
    }

=======
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
>>>>>>> e3b0459eb6c321d48a919af2aae971b99370940e


?>