<?php
require_once('snippets.php');
require_once('navbar.php');
$number_of_rows = get_hash_row_number();
if (!is_admin()) {
    goBack();
} else if ($_POST['delete']) {
    if ($number_of_rows < 1) {
        no_hashes_detected();
    } else if ($number_of_rows >= 1) {
        delete_hashes();
    }
} elseif ($_GET["delete"] && $_GET["delete"]=="yes") {
    global $conn;
    $sql = 'TRUNCATE TABLE lavato_keys';
    mysqli_query($conn, $sql);
    log_action("deleted_hashes", $_SESSION['username'])
?>
    <script>
        Swal.fire({
            title: 'Sikeresen kitörölted a kódokat',
            icon: 'success',
            confirmButtonText: 'Rendben'
        }).then((result) => {
            if (result.value) {
                window.location.replace("admin.php");
            }
        });
    </script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hash Törlés - Lavató</title>
</head>

<body>

    <div class="main-container container">
        <h1 class="hashdelete-h1">Kódok exportálása</h1>
        <hr class="hashdelete-hr">
        <div class="hashdelete-div">
            <form class="hashdelete-form" method="POST">
                <label for="xls" class="hash-export-label">Kódok törlése: </label>
                <input type="submit" name="delete" class="btn btn-danger hashdelete-button" value="Törlés">
            </form>
        </div>

    </div>
</body>

</html>