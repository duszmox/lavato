<?php

require_once("connect.php");
require_once("snippets.php");
display_errors();
?>
<html>


<head>

    <link rel="stylesheet" href="main_style.css">
    <link rel="stylesheet" href="assets/fonts/leaves/stylesheet.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Lavató - Szavazás</title>
    <script src="main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body class="bg">

    <?php
    require("navbar.php")

    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <?php
    if (isset($_GET['hash'])) {
        
        $hash = html_escape($_GET['hash']);

        
        $sql = "SELECT * FROM lavato_keys WHERE hash= '$hash'";

        $raw = mysqli_query($conn, $sql);

        $result = mysqli_fetch_array($raw);
        var_dump($result);

        if ($result['hash'] == NULL) {
            echo '<script> notRealCode(); </script>';
            ?>
            <script>visibleForm();</script>
            <?php
        } elseif ($result['hash'] == $hash) {
    ?>
    <script type="text/javascript">
        window.setTimeout(hideForm, 2);
        voteInfo();
    </script>
    <div id="main">
        <div class="choose-class-A" onclick="confirmVote(this.textContent, true)"><p class="choose-class-text">A</p></div>
        <div class="choose-class-B" onclick="confirmVote(this.textContent)"><p class="choose-class-text">B</p></div>
        <div class="choose-class-C" onclick="confirmVote(this.textContent)"><p class="choose-class-text">C</p></div>
        <div class="choose-class-D" onclick="confirmVote(this.textContent)"><p class="choose-class-text">D</p></div>
    </div>
    <?php
            }
        } else {
    ?>
        <div class="code-box">
            <form id="code-form" style="display: ;">
                <div class="form-group" id="form-group">
                    <label for="exampleInputEmail1">Code:</label>
                    <input type="text" class="form-control" name="hash" id="hash" placeholder="Enter code here" onkeyup="this.value = this.value.toLowerCase();">
                    <small id="emailHelp" class="form-text text-muted">A Szavazó lapkán található kódot írd be ide, vagy olvasd be a QR code-ot!</small>
                </div>
                <input type="submit" class="btn btn-primary" id="btn" value="Submit">
            </form>
        </div>
    <?php
        }
    ?>


</body>

</html>