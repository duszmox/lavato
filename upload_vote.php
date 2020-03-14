 <?php

 require_once("snippets.php");
 display_errors();

 $hash = $_GET['hash'];
 $class = $_GET['class'];

 if(verify_hash($hash) and verify_class($class)){
     disable_hash($hash);
     upload_vote($class, $hash);
     header("Location: vote.php?vote=1");
 }else{
     echo '<script> notRealCode(); </script>';
 }
 ?>