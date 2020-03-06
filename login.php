<?php
require_once("snippets.php");
require_once("navbar.php");
if (user_logged_in()) {
    header("Location: /lavato/");
} else if (isset($_POST['submit']) && $_POST['submit'] == "LOGIN") {
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
    <div class="login-div-form card">
        <form method="post" action="login.php" class="login-form">
            <div class="form-group login-form" id="form-group">
                <label for="username" class="login-label-username"><strong>Username:</strong></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" onkeyup="this.value = this.value.toLowerCase();">
                <label for="password" class="login-label-password"><strong>Password:</strong> </label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                <input type="submit" class="btn btn-primary login-submit-button" name="submit" value="LOGIN">
            </div>
        </form>
    </div>
</div>