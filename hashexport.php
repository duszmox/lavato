<?php
require_once("snippets.php");
require_once("navbar.php");
if (!is_admin()) {
    goBack();
} elseif ($_POST['submit']) {
    exportDataToExcel();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavató - Kódok Exportálása</title>
</head>

<body>
    <div class="main-container container">
        <h1 class="hashexport-h1">Kódok exportálása</h1>
        <hr class="hashexport-hr">
        <form action="export.php" class=" hash-export-form"method="POST">
            <label for="xls" class="hash-export-label">Kódok exportálása excel táblába: </label>
            <button type="submit" class="btn btn-success hash-export-button" name="submit">
                <i class="fas fa-file-excel"></i> XLS
            </button>
            
            
        </form>
    </div>
</body>

</html>

</div>

</body>

</html>