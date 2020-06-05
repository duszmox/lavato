<?php
require_once("snippets.php");
logout_user($_SESSION["username"]);
header("Location: index.php");
