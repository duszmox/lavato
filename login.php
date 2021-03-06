<?php
require_once("snippets.php");
require_once("navbar.php");
if (user_logged_in()) {
    header("Location: /lavato/");
} else if (isset($_POST['submit']) && $_POST['submit'] == "Login") {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $username = html_escape($_POST['username']);
        $password = html_escape($_POST['password']);
        if (validate_user($username, $password)) {
            if (login_user($username)) {
?><script>
                    successfulLogin()
                </script><?php
                        } 
                    }else {
                        ?>
            <script>
                cannotLogin();
            </script>
<?php
                    }
                }
            }



?>

<head>
    <title>Lavató - Login</title>
</head>
<div class="main-container container">
    <h1 class='login-h1'>Login</h1>
    <div class="login-div-form ">
        <form method="post" action="login.php" class="login-form">
            <div class="form-group login-form" id="form-group">
                <label for="username" class="login-label-username"><strong>Felhasználónév:</strong></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Felhasználónév..." onkeyup="this.value = this.value.toLowerCase();">
                <label for="password" class="login-label-password"><strong>Jelszó:</strong> </label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Jelszó...">
                <input type="submit" class="btn btn-primary login-submit-button" name="submit" value="Login">
            </div>
        </form>
    </div>
</div>