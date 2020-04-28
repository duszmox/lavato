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
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}


function get_hash_row_number()
{
    global $conn;
    $sql = "SELECT * from lavato_keys";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    return $num_rows;
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
        if (get_hash_row_number() >= 600) {
            break;
        }
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
?>
        <script>
            alreadyUsedUsername()
        </script>
    <?php
        return false;
    }
    $sql = "INSERT INTO lavato_users (username, password) VALUES ('$username', '" . hash("sha256", $password) . "')";
    log_action("register_user", $username);
    return mysqli_query($conn, $sql);
}
function register_admin($username, $password)
{

    global $conn;
    if (!empty(get_userdata($username))) {
    ?>
        <script>
            alreadyUsedUsername()
        </script>
    <?php
        return false;
    }
    $sql = "INSERT INTO lavato_users (username, password, admin) VALUES ('$username', '" . hash("sha256", $password) . "', '1')";
    log_action("register_user", $username);
    return mysqli_query($conn, $sql);
}
function is_admin_table($username)
{
    global $conn;
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = "SELECT username, id, admin FROM lavato_users WHERE username='$username'";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
    return $row["admin"];
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
function get_users()
{
    global $conn;
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = 'SELECT username, password, id, admin FROM lavato_users';
    $retval = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
    ?>
        <tr>
            <th scope="row">
                <p><?php echo "{$row['id']}" ?></p>
            </th>
            <td>
                <p><?php echo "{$row['username']}" ?></p>
            </td>
            <td>
                <p><?php if ($row['admin'] == "1") {
                        echo "Igen";
                    } else {
                        echo "Nem";
                    } ?></p>
            </td>
            <td>
                <form action="users.php" method="POST">
                    <input type="hidden" name="username" value="<?php echo "{$row['username']}" ?>">
                    <input type="submit" name="passwordChange" class="btn btn-warning" value="Jelszó megváltoztatása">
                    <?php if ($row["admin"] != "1") {
                        echo '<input type="submit" name="adminRightChanger" class="btn btn-dark" value="Adminná tétel">';
                    } else {
                        echo '<input type="submit" name="adminRightChanger" class="btn btn-dark" value="Admin jog törlése">';
                    } ?>
                    <input type="submit" class="btn btn-danger" name="deleteUser" value="Felhasználó törlése">
                </form>
            </td>
        </tr>
    <?php
    }
}

function goBack()
{
    ?>
    <script>
        window.location.replace("login.php");
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
    return "https://api.qrserver.com/v1/create-qr-code/?size=375x375&data=" . urlencode($url);
}

function save_image_from_website($url, $dest, $name)
{
    $img = file_get_contents($url);
    file_put_contents($dest . substr(($name . ".png"), strrpos($name, '/')), $img);
}
function merge_two_photos($qr_code_url, $background_url, $i)
{
    $dest = imagecreatefrompng($background_url);
    $src = imagecreatefrompng($qr_code_url);
    imagealphablending($dest, false);
    imagesavealpha($dest, true);
    imagecopymerge($dest, $src, 45, 40, 0, 0, 375, 375, 100);
    imagedestroy($src);
    ob_start();
    header('Content-Type: image/png');
    imagepng($dest);
    $image_data = ob_get_contents();
    ob_end_clean();
    $file = "final_images/QR-Code-" . $i . ".png";
    file_put_contents($file, $image_data);
    return true;
}
function download_folder_in_zip($folder)
{
    $zipFile = "codes.zip";
    $zip = new ZipArchive;
    if ($zip->open('codes.zip', ZipArchive::OVERWRITE) === TRUE) {
        if ($handle = opendir($folder)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && !is_dir($folder . '/' . $entry)) {
                    $zip->addFile($folder . '/' . $entry);
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
function old_download_folder_in_zip()
{
    $zipFile = "codes.zip";
    $zip = new ZipArchive;
    if ($zip->open($zipFile, ZipArchive::OVERWRITE) === TRUE) {
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
function delete_hashes()
{
?>
    <script>
        Swal.fire({
            title: "Biztos ki szeretnéd törölni az összes kódot?",
            text: "Döntésedet nem tudod majd visszavonni!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Nem, mégsem",
            confirmButtonText: "Igen, biztos"
        }).then(result => {
            if (result.value) {
                        <?php
                        global $conn;
                        $sql = 'TRUNCATE TABLE lavato_keys';
                        mysqli_query($conn, $sql);
                        log_action("deleted_hashes", $_SESSION['username'])
                        ?>
                        Swal.fire({
                            title: 'Sikeresen kitörölted a kódokat',
                            icon: 'success',
                            confirmButtonText: 'Rendben'
                        }).then((result) => {
                            if (result.value) {
                                window.location.replace("admin.php");
                            }
                        });
            }
        });
    </script>
<?php
}
function no_hashes_detected()
{
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Hupsz...',
            text: 'Egy kód sincs a rendszerben',
        }).then((result) => {
            if (result.value) {
                window.location.replace("admin.php");
            }
        });
    </script>
<?php
}
function no_hashes_detected_export()
{
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Egy kód sincs a rendszerben',
            text: 'Generálj, pár kódot, hogy ki tudd exportálni őket!',
        }).then((result) => {
            if (result.value) {
                window.location.replace("admin.php");
            }
        });
    </script>
<?php
}
function change_user_password($username, $password)
{
    global $conn;
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = "UPDATE lavato_users SET password='" . hash("sha256", $password) . "' WHERE username='$username' ";
    return mysqli_query($conn, $sql);
}
function not_same_password()
{
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'A két jelszó nem ugyanaz!',
            text: 'Próbáld újra!',
        })
    </script>
<?php
}
function make_admin($username)
{
    global $conn;
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = "UPDATE lavato_users SET admin = 1 WHERE username='$username' ";
    return mysqli_query($conn, $sql);
}
function remove_admin($username)
{
    global $conn;
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = "UPDATE lavato_users SET admin = 0 WHERE username='$username' ";
    return mysqli_query($conn, $sql);
}
function delete_user($username)
{
    global $conn;
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = "DELETE FROM lavato_users WHERE username='$username'";
    return mysqli_query($conn, $sql);
}
function max_number()
{
    $num_rows = get_hash_row_number();
    if ($num_rows <= 600 || $num_rows == 0) {
        return $final_number = 600 - $num_rows;
    } else {
        return $final_number = 0;
    }
    return $final_number;
}
function already_max_codes()
{
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'A maximum számú kód le lett generálva már!',
            text: 'Újabb generálás előtt töröld az előző kódokat!',
        }).then((result) => {
            if (result.value) {
                window.location.replace("admin.php");
            }
        });
    </script>
<?php
}
function is_vote_open()
{
    global $conn;
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = "SELECT is_vote_open, id FROM lavato_general WHERE id = '1'";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
    return $row["is_vote_open"];
}
function open_vote()
{
    global $conn;
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = "UPDATE lavato_general SET is_vote_open = 1 WHERE id = '1'";
    $retval = mysqli_query($conn, $sql);
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sikeresen megnyitottad a szavazást!',
            text: '',
        }).then((result) => {
            if (result.value) {
                window.location.replace("admin.php");
            }
        });
    </script>

<?php
}
function close_vote()
{
    global $conn;
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = "UPDATE lavato_general SET is_vote_open = 0 WHERE id = '1'";
    $retval = mysqli_query($conn, $sql);
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sikeresen lezártad a szavazást!',
            text: '',
        }).then((result) => {
            if (result.value) {
                window.location.replace("admin.php");
            }
        });
    </script>

<?php
}
