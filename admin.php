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
    if (!is_admin()) {
        goBack();
    };
    ?>

    <div class="main-container container">
        <h1 class="admin-h1">Admin</h1>
        <hr class="admin-hr">
        <ul class="admin-ul">
            <li class="admin-li"><a href="openclose.php" class="admin-li-a"><?php if (is_vote_open() == 1) {
                                                                                echo "Szavazás lezárása";
                                                                            } else {
                                                                                echo "Szavazás megnyitása";
                                                                            } ?></a></li> <br>
            <li class="admin-li"><a href="register.php" class="admin-li-a">Felhasználó regisztrálása</a></li>
            <li class="admin-li"><a href="users.php" class="admin-li-a">Felhasználók kezelése</a></li><br>
            <li class="admin-li"><a href="log.php" class="admin-li-a">Esemény lista</a></li> <br>
            <li class="admin-li"><a href="hashgen.php" class="admin-li-a">Kódok generálása</a></li>
            <li class="admin-li"><a href="hashexport.php" class="admin-li-a">Kódok exportálása</a></li>
            <li class="admin-li"><a href="changecardbg.php" class="admin-li-a">Kártya háttérkép módósítása</a></li>
            <li class="admin-li"><a href="hashdelete.php" class="admin-li-a">Kódok törlése</a> - <p class="admin-li-delete-p">Szigorúan csak az esemény után!</p>
            </li>
        </ul>




    </div>


</body>

</html>