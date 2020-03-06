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
            // $background_url = "../assets/png/background.png";
            // $final_url = merge_two_photos($qr_core_url, $background_url);
            save_image_from_website($qr_code_url, "qr_codes/", "QR-Code-".$i);
            $i++;

        }
        $zipFile = download_folder_in_zip();
        delete_files("qr_codes/");
        unlink($zipFile);
    }
 
?>