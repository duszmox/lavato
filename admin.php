<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavato - Admin</title>
</head>

<body>
    <?php
    require_once("snippets.php");
    require_once("navbar.php");
    if( ! is_admin()) {
        goBack();
    };
    ?>

    <div class="main-container container">
        <h1 class="admin-h1">Admin</h1>
        <hr class="admin-hr">
        <ul class="admin-ul">
            <li class="admin-li"><a href="log.php" class="admin-li-a">Esemény lista</a></li>
            <li class="admin-li"><a href="register.php" class="admin-li-a">Segítő regisztrálása</a></li>
            <li class="admin-li"><a href="hashgen.php" class="admin-li-a">Kódok generálása</a></li>
            <li class="admin-li"><a href="hashexport.php" class="admin-li-a">Kódok exportálása</a></li>


        </ul>


    </div>


</body>

</html>