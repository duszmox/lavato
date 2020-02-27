<?php
function html_escape($html_escape)
        {
            $html_escape =  htmlspecialchars($html_escape, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            return $html_escape;
        }

function swal_error($text){
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Hibás Kód',
        text: '$text',
    });
</script>";
}
function display_errors(){
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}
function verify_hash($conn,$hash){
    $sql = "SELECT * FROM lavato_keys WHERE 'hash' = '$hash'";
    $row = mysqli_query($conn, $sql);
    if(mysqli_num_rows($row) >0){
        swal_error("yolooooo");
    }else{
        swal_error("nem");
    }
}
function upload_vote($hash, $class){
     $sql = "";
}
        ?>