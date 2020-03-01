<?php
    require_once("snippets.php");
    require_once("navbar.php");
    if (!is_admin()) {
        goBack();
    }
    else if (isset($_POST['submit']) && $_POST['submit'] == "XLS") {
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
        <form action="hashexport.php">
            <input type="submit" class="btn btn-success" value="XLS">
        </form>
    </div>
<script>
    function exportDataToExcel() {
        <?php exportDataToExcel(); ?>
    }
</script>
</body>
</html>