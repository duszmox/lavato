<link rel="stylesheet" href="main_style.css">
<link rel="stylesheet" href="assets/fonts/leaves/stylesheet.css">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/bootstrap.css">
<script src="https://kit.fontawesome.com/e8464711df.js" crossorigin="anonymous"></script>
<script src="main.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
<script src="assets/js/popper.min.js" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="assets/js/core.js"></script>
<script src="assets/js/charts.js"></script>
<script src="assets/js/animated.js"></script>
<script src="assets/js/sweetalert2@9.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand nav-title" href="/lavato/">LUDAVATO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/lavato/">Főoldal <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="vote.php">Szavazás<span class="sr-only">(current)</span></a>
            </li>
            <?php if (user_logged_in()) {
            ?>
                <li class="nav-item active">
                    <a class="nav-link" href="status.php">Helyezések<span class="sr-only">(current)</span></a>
                </li>

            <?php
            }
            if (is_admin() && user_logged_in()) {
            ?>
                <li class="nav-item active">
                    <a class="nav-link" href="admin.php">Admin<span class="sr-only">(current)</span></a>
                </li>

            <?php
            }
            if (user_logged_in()) {
            ?>
                <li class="nav-item active">
                    <a class="nav-link" href="logout.php">Kijelentkezés (<?php echo $_SESSION['username']; ?>)<span class="sr-only">(current)</span></a>
                </li>
            <?php

            }
            ?>
        </ul>
    </div>
</nav>