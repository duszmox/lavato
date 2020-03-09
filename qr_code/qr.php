<?php
    require_once("../snippets.php");

    display_errors();
    global $page_url; 
    if (!is_admin()) {
        header("Location: ../");
    } else if(isset($_GET["url"])){
        
        global $conn;
        $data = get_hashes_from_database("lavato_keys","hash", $conn);
        $i = 1;
        foreach($data as $key => $value){
            $url = $page_url . "vote.php?hash=".$value;
            $qr_core_url = create_googlechart_from_url($url);
            save_image_from_website($qr_core_url, "qr_codes/", "QR-Code-".$i);
            $i++;

        }
        $folder = "qr_codes/";
        old_download_folder_in_zip();
        delete_files("qr_codes/");
        unlink($zipFile);
    }
 
?>