<?php
require_once("snippets.php");
?>
<html>

<head>

    <link rel="stylesheet" href="main_style.css">
    <link rel="stylesheet" href="assets/fonts/leaves/stylesheet.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/js/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Lavató</title>
</head>

<body class="bg">
    <?php
    require_once("navbar.php")
    ?>

    <div class="container main-container">
        <div class="container-title">
            <br>
            <h1  class="container-title-h1">Új szavazási rendszer a lúdavatón</h1>
            <hr class="container-title-hr" align="left">
            <?php if (is_admin()) {
                echo '<form method="post"><button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Új Poszt</button> </form>';
            } ?>


        </div>
        <div class="container-body">
            <br>
            <p>A Fazekas Lúdavató rendszere a 2020-as eseménytől kezdve elektronikusan fog működni. Erre több indokból került sor, először is azért, hogy iskolánk haladjon a korral, modernizálódjuk, másrészt pedig azért is hogy így lecsökkentsük vagy teljesen megszüntessük a csalásokat.</p>
            <br>

        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>