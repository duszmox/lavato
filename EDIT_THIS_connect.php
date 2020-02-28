<?php
       $servername = "host";
       $username = "username";
       $password = "password";
       $db = "db";
// Create connection

    global $conn;
    $conn = new mysqli($servername, $username, $password, $db);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>