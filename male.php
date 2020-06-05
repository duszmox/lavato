<?php
require_once("snippets.php");
if (isset($_POST["editTitle"])) {
    edit_post($_POST["id"], $_POST["editTitle"], $_POST["editContent"]);
}
?>

<form method="POST">
    <input type="submit" value="sda" name="editTitle">
    <input type="text" value="sda" name="editContent">
    <input type="text" value="8" name="id">
</form>