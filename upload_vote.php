 <?php

 require_once("snippets.php");
 display_errors();

 $hash = $_GET['hash'];
 $class = $_GET['class'];
 var_dump($hash);
 var_dump($class);
 if(verify_hash($conn, $hash) and verify_class($class)){
     upload_vote($class);
 }

 ?>