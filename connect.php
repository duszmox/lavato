<?php

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



?>