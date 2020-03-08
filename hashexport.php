<?php
require_once("snippets.php");
require_once("navbar.php");
displayErrors();

if (!is_admin()) {
    goBack();
} ?>
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
        <div class="hash-export-div">
            <form action="export.php" class="hash-export-form-1" method="POST">
                <label for="xls" class="hash-export-label">Kódok exportálása excel táblába: </label>
                <input type="submit" name="submit" class="btn btn-success hash-export-button" value="XLS">
            </form>
            <form action="qr_code/qr.php" class="hash-export-form-1" method="get">
                <label for="qrCodes" class="hash-export-label">Kódok exportálása QR code-okba: </label>
                <input type="submit" name="url" class="btn btn-warning hash-export-button" value="QR code">
            </form>
            <form action="qr_code/" class="hash-export-form-2" method="get">
                <label for="qrCodes" class="hash-export-label">Kódok exportálása kártyákra (Maximum 430): </label>
                <input type="submit" name="url" class="btn btn-primary hash-export-button" value="Kártyák">
            </form>
        </div>
    </div>
</body>

</html>

</div>

</body>

</html>