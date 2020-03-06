<?php
require_once("connect.php");
function html_escape($html_escape)
{
    $html_escape = htmlspecialchars($html_escape, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return $html_escape;
}

function swal_error($title, $text)
{
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: '$title',
        text: '$text',
    });
</script>";
}

function display_errors()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

function verify_hash($hash)
{
    global $conn;
    $sql = "SELECT * FROM lavato_keys WHERE hash = '$hash'";
    $row = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row) == 1) {
        log_action("hash_verification", "$hash _verified");
        return true;
    } else {
        return false;
    }
}

function verify_class($class)
{
    if ($class == "A" or $class == "B" or $class == "C" or $class == "D") {
        return true;
    } else {
        return false;
    }
}

function disable_hash($hash)
{
    global $conn;
    $sql = "UPDATE lavato_keys SET hasBeenActivated=1 WHERE hash='$hash'";
    return mysqli_query($conn, $sql);
}

function log_action($action, $value)
{
    global $conn;
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO lavato_log (action, value, date) VALUES ('$action', '$value', '$date')";

    return mysqli_query($conn, $sql);
}

function upload_vote($class, $hash)
{
    global $conn;
    $sql = "UPDATE lavato_keys SET class='$class' WHERE hash='$hash'";
    log_action("class_vote", "$class");
    return mysqli_query($conn, $sql);
}
function get_class_votes()
{
    global $conn;
    $sql = "SELECT * FROM lavato_keys WHERE hasBeenActivated=1";
    $raw = mysqli_query($conn, $sql);
    $class_data = array("A" => 0, "B" => 0, "C" => 0, "D" => 0);
    while ($res = mysqli_fetch_array($raw)) {
        switch ($res["class"]) {
            case 'A':
                $class_data['A'] += 1;
                break;
            case 'B':
                $class_data['B'] += 1;
                break;
            case 'C':
                $class_data['C'] += 1;
                break;
            case 'D':
                $class_data['D'] += 1;
                break;
        }
    }





    return $class_data;
}

function gen_uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}


function create_random_data($max, $hasBeenActivated, $classes)
{
    global $conn;
    for ($i = 0; $i < $max; $i++) {
        // $token = openssl_random_pseudo_bytes(32);
        // $token = bin2hex($token);
        $token = gen_uuid();
        $sql = "INSERT INTO lavato_keys (hash, hasBeenActivated, class) VALUES ('$token', '$hasBeenActivated' ,'$classes')";
        mysqli_query($conn, $sql);
        //todo ellenorize, hogy van-e mar ilyen hash

    }
    return true;
}

function hasBeenActivated($hash)
{
    global $conn;
    $sql = "SELECT * FROM lavato_keys WHERE hash='$hash' AND hasBeenActivated=0";
    $row = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row) == 1) {
        log_action("hash_activated", "$hash _activated");
        return true;
    } else {
        return false;
    }
}
function validate_user($username, $password)
{
    global $conn;
    $sql = "SELECT * FROM lavato_users WHERE username='$username'";
    $row = mysqli_query($conn, $sql);
    if (mysqli_num_rows($row) == 1) {
        $result = mysqli_fetch_assoc($row);
        if ($result['password'] == hash("sha256", $password)) {

            return true;
        }
    } else {
        return false;
    }
}
function get_userdata($username)
{
    global $conn;
    return mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM lavato_users WHERE username='$username'"));
}
function login_user($username)
{
    log_action("login", $username);
    $userdata = get_userdata($username);

    $_SESSION['username'] = $username;
    $_SESSION['admin'] = $userdata["admin"];
    $_SESSION['logged_in'] = 1;

    return true;
}
function logout_user($username)
{
    log_action("logout", $username);

    $_SESSION['username'] = "";
    $_SESSION['admin'] = "";
    $_SESSION['logged_in'] = 0;
}
function user_logged_in()
{
    return $_SESSION['logged_in'];
}
function is_admin()
{
    return $_SESSION['admin'];
}
function register_user($username, $password)
{

    global $conn;
    if (!empty(get_userdata($username))) {
        echo "Már foglalt felhaszálónév";
        return false;
    }
    $sql = "INSERT INTO lavato_users (username, password) VALUES ('$username', '" . hash("sha256", $password) . "')";
    log_action("register_user", $username);
    return mysqli_query($conn, $sql);
}

function get_log()
{
    global $conn;
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = 'SELECT action, value, date, id FROM lavato_log';
    $retval = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
?>
        <tr>
            <th scope="row"><?php echo "{$row['id']}" ?></th>
            <td><?php echo "{$row['action']}" ?> </td>
            <td> <?php echo "{$row['value']}" ?></td>
            <td> <?php echo "{$row['date']}" ?></td>
        </tr>
    <?php
    }
}

function goBack()
{
    ?>
    <script>
        window.history.back()
    </script>
<?php
}
function exportDataToExcel()
{
    global $conn;
    $sql = "SELECT `id`,`hash` FROM `lavato_keys`";
    $setRec = mysqli_query($conn, $sql);
    $columnHeader = '';
    $columnHeader = "Id" . "\t" . "Hash" . "\t";
    $setData = '';
    while ($rec = mysqli_fetch_row($setRec)) {
        $rowData = '';
        foreach ($rec as $value) {
            $value = '"' . $value . '"' . "\t";
            $rowData .= $value;
        }
        $setData .= trim($rowData) . "\n";
    }

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=User_Detail.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo ucwords($columnHeader) . "\n" . $setData . "\n";
}
function displayErrors()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

function create_googlechart_from_url($url)
{
    return "https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=" . urlencode($url) . "&choe=UTF-8";
}

function save_image_from_website($url, $dest, $name)
{
    $img = file_get_contents($url);
    file_put_contents($dest . substr(($name . ".png"), strrpos($name, '/')), $img);
}
function merge_two_photos($qr_code_url, $background_url)
{
    $dest = imagecreatefrompng($background_url);
    $src = imagecreatefrompng($qr_code_url);

    imagealphablending($dest, false);
    imagesavealpha($dest, true);

    imagecopymerge($dest, $src, 500, 500, 0, 0, 500, 500, 100); 

    header('Content-Type: image/png');
    

    imagedestroy($dest);
    imagedestroy($src);
    return $dest;
    
}
function download_folder_in_zip()
{
    $zipFile = "codes.zip";
    $zip = new ZipArchive;
    if ($zip->open('codes.zip', ZipArchive::OVERWRITE) === TRUE) {
        if ($handle = opendir('qr_codes')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && !is_dir('qr_codes/' . $entry)) {
                    $zip->addFile('qr_codes/' . $entry);
                }
            }
            closedir($handle);
        }
        $zip->close();
    }

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename=' . basename($zipFile));
    readfile($zipFile);
    return $zipFile;
}

function get_hashes_from_database($table, $column, $conn)
{
    $sql = "SELECT $column FROM $table";

    $data = array();
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row[$column];
    }
    return $data;
}
function delete_files($target)
{
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK);
        foreach ($files as $file) {
            delete_files($file);
        }
    } elseif (is_file($target)) {
        unlink($target);
    }
}
function get_hash_row_number()
{
    global $conn;
    $sql = "SELECT * from lavato_keys";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    return $num_rows;
}
