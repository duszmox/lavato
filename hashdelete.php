<?php 
require_once('snippets.php');
require_once('navbar.php');
if(! is_admin()) {
    goBack();
} else if ($_POST['delete']) {
    delete_hashes();
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