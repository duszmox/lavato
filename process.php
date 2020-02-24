<?php 
$hash = $_GET['hash'];

$hash = stripcslashes($hash);
$hash = mysql_real_escape_string($hash);

mysql_connect("localhost", "duszmo", "ThanosPapa9?");
mysql_select_db("duszmo");

$result = mysql_query("select * from lavato_keys where hash = '$hash'")
     or die("Failed to connect query database ".mysql_error());

$row = mysql_fetch_array($result);

echo $row;
if ($row['hash'] == $hash) {
    echo "Szavazz!";
    
} else {
    echo "nyet";
}


?>