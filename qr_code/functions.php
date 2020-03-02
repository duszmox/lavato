<?php


function display_errors()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
    function create_googlechart_from_url($url)
    {
        return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".urlencode($url)."&choe=UTF-8";
    }

    function save_image_from_website($url, $dest, $name){
        $img=file_get_contents($url);
        file_put_contents($dest.substr(($name.".png"), strrpos($name,'/')), $img);

    }
    function download_folder_in_zip($download){ 
        $zipFile = "test_dir.zip";
        $zip = new ZipArchive;
        if ($zip->open('test_dir.zip', ZipArchive::OVERWRITE) === TRUE)
        {
            if ($handle = opendir('qr_codes'))
            {
                while (false !== ($entry = readdir($handle)))
                {
                    if ($entry != "." && $entry != ".." && !is_dir('qr_codes/' . $entry))
                    {
                        $zip->addFile('qr_codes/' . $entry); 
                    }
                }
                closedir($handle);
            }
            $zip->close();
        }

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename='.basename($zipFile));
readfile($zipFile);
    
}
    
    function get_hashes_from_database($table, $column, $conn){
        $sql = "SELECT $column FROM $table";

        $data = array();
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row[$column];
        }
        return $data;
    }

