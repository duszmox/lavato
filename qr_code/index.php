<?php
require_once("../snippets.php");

display_errors();
global $page_url;
if (!is_admin()) {
    header("Location: ../");
} else if (isset($_GET["url"])) {

    global $conn;
    $data = get_hashes_from_database("lavato_keys", "hash", $conn);
    $i = 1;
    $background_url = "../assets/png/background.png";
    foreach ($data as $key => $value) {
        $url = $page_url . "vote.php?hash=" . $value;
        $qr_core_url = create_googlechart_from_url($url);
        $final_url = merge_two_photos($qr_core_url, $background_url, $i);

        $i++;
    }
    header("Content-Type: text/html");
    $folder = "final_images";
    $zipFile = download_folder_in_zip($folder);
    delete_files("final_images/");
    unlink("codes.zip");
}
