<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavató - Segítő Regisztrálása</title>
</head>

<body>
    <?php
    require_once('snippets.php');
    require_once('navbar.php');
    if (!is_admin()) {
        goBack();
    };
    if (isset($_POST['submit']) && $_POST['submit'] == "Regisztrálás") {
        if (isset($_POST['username']) and isset($_POST['password'])) {
            if ($_POST['password'] == $_POST['password_again']) {
                $username = html_escape($_POST['username']);
                $password = html_escape($_POST['password']);
                if (register_user($username, $password)) {
                    echo "Sikeres regisztráció";
                }
            }
        }
    }
    ?>

    <div class="main-container container">
        <h1 class="register-h1">Segítő Regisztrálása</h1>
        <hr class="register-hr">
        <form method="post" action="register.php">
        <div class="form-group login-form" id="form-group">    
            <label for="username"><strong>Felhasználónév:</strong></label>
            <input type="text" class="form-control" placeholder="Felhasználónév" name="username" id="username"><br>
            <label for="password"><strong>Jelszó:</strong></label>
            <input type="password" class="form-control" placeholder="Jelszó" name="password" id="password"><br>
            <label for="password_again"><strong>Jelszó Megerősítése:</strong></label>
            <input type="password" class="form-control" placeholder="Jelszó Megerősítése" name="password_again" id="password_again"><br>
            <input type="submit" name="submit" class="btn btn-primary" value="Regisztrálás">
        </div>
        </form>
    </div>


</body>

</html>