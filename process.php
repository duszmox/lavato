<?php 
function html_escape($html_escape) {
    $html_escape =  htmlspecialchars($html_escape, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return $html_escape;
}
$hash = html_escape($_GET['hash']);

mysql_connect("localhost", "duszmo", "ThanosPapa9?");
mysql_select_db("duszmo");

$result = mysql_query("select * from lavato_keys where hash = '$hash'")
     or die("Failed to connect query database ".mysql_error());

$row = mysql_fetch_array($result);


if ($row['hash'] == NULL)
{
    echo "nyet";
}elseif ($row['hash'] == $hash) {
    echo "Szavazz!";
    
}

?>