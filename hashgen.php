<?php
require_once("snippets.php");
require_once("navbar.php");
if (!is_admin()) {
    goBack();
}
else if (isset($_POST['submit']) && $_POST['submit'] == "Generálás") {
    if (isset($_POST['max-character'])) {
        $number = html_escape($_POST['max-character']);
        if (create_random_data($number, '0', '0')) {
            ?>
            <script>successfulCodeGen(<?php echo $number?>)</script>
            <?php
        }
    } 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavató - Hash Generátor</title>
</head>

<body>
    <div class="main-container container">
        <h1 class="hash-h1">Hash Generátor</h1>
        <hr class="hash-hr">
        <div class="form-group login-form">
            <form action="hashgen.php" method="POST">
                <label for="max-character"><strong>Generálandó kódot száma:</strong></label>
                <input type="number" class="form-control" placeholder="Generálandó kódok száma" name="max-character" max="750" min="1" id="max-character"> 
                <input type="submit" class="btn hash-submit-button btn-primary" name="submit" value="Generálás">
            </form>
        </div>
    </div>
</body>

</html>