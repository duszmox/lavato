<?php
require_once("snippets.php");
require_once("navbar.php");
if (isset($_POST['submit']) && $_POST['submit'] == "LOGIN") {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $username = html_escape($_POST['username']);
        $password = html_escape($_POST['password']);

        if (validate_user($username, $password)) {
            if (login_user($username)) {
                echo "Logged in successfully";
            } else {
                echo "Error";
            };
        }
    }
}
if (isset($_POST['submit']) && $_POST['submit'] == "REGISTER") {
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

<form method="post" action="login.php">
    <label for="username">Username</label>
    <input type="text" name="username" id="username"><br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password"><br>
    <input type="submit" name="submit" value="LOGIN">
</form>
<hr>
<hr>
<hr>
<form method="post" action="login.php" style="display:<?php
if (!can_register()) {
    echo "none";
}
?>">
    <label for="username">Username</label>
    <input type="text" name="username" id="username"><br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password"><br>
    <label for="password_again">Password Again</label>
    <input type="password" name="password_again" id="password_again"><br>
    <input type="submit" name="submit" value="REGISTER">
</form>