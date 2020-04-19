<?php

require_once("snippets.php");
display_errors();

?>
<html>


<head>

 
    <title>Lavató - Szavazás</title>

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


</head>

<body class="bg">


    <script src="assets/js/sweetalert2@9.js"></script>
    <?php
    if (isset($_GET['hash'])) {
        if (is_vote_open() == 1) {
            
        $hash = html_escape($_GET['hash']);



        if (!verify_hash($hash)) {
            echo '<script> notRealCode(); </script>';
            require_once("navbar.php");

    ?>
            <div class="main-container container">
                <div class="code-padding">
                    <h1 class="vote-h1">Szavazás</h1>
                    <div class="code-box">
                        <form id="code-form">
                            <div class="form-group" id="form-group">
                                <label for="exampleInputEmail1">Kód:</label>
                                <input type="text" class="form-control" name="hash" id="hash" placeholder="Írd be a kódod" onkeyup="this.value = this.value.toLowerCase();">
                                <small id="emailHelp" class="form-text text-muted">A Szavazó lapkán található kódot írd be ide, vagy
                                    olvasd be a QR code-ot!
                                </small>
                            </div>
                            <input type="submit" class="btn btn-primary" id="btn" value="Beküldés">
                        </form>
                    </div>
                </div>
            </div> <?php
                } else if (verify_hash($hash)) {

                    if (!hasBeenActivated($hash)) {
                    ?><script>
                    codeAlreadyActivated();
                </script>
                <?php require_once("navbar.php") ?>
                <div class="main-container container">
                    <div class="code-padding">
                        <h1 class="vote-h1">Szavazás</h1>
                        <div class="code-box">
                            <form id="code-form">
                                <div class="form-group" id="form-group">
                                    <label for="exampleInputEmail1">Kód:</label>
                                    <input type="text" class="form-control" name="hash" id="hash" placeholder="Írd be a kódod" onkeyup="this.value = this.value.toLowerCase();">
                                    <small id="emailHelp" class="form-text text-muted">A Szavazó lapkán található kódot írd be ide, vagy
                                        olvasd be a QR code-ot!
                                    </small>
                                </div>
                                <input type="submit" class="btn btn-primary" id="btn" value="Beküldés">
                            </form>
                        </div>
                    </div>


                </div><?php
                    } else {
                        ?>
                <script type="text/javascript">
                    voteInfo();
                </script>
                <div id="main">
                    <div class="choose-class-A" onclick="confirmVote(this.textContent, true, '<?php echo $hash; ?>')"><p class="choose-class-text">A</p></div>
                    <div class="choose-class-B" onclick="confirmVote(this.textContent, false, '<?php echo $hash; ?>')"><p class="choose-class-text">B</p></div>
                    <div class="choose-class-C" onclick="confirmVote(this.textContent, false, '<?php echo $hash; ?>')"><p class="choose-class-text">C</p></div>
                    <div class="choose-class-D" onclick="confirmVote(this.textContent, false, '<?php echo $hash; ?>')"><p class="choose-class-text">D</p></div>
                </div>
        <?php
                    }
                }
        } else {
            
            require_once("navbar.php");

    ?>
            <script> vote_is_not_open() </script>
            <div class="main-container container">
                <div class="code-padding">
                    <h1 class="vote-h1">Szavazás</h1>
                    <div class="code-box">
                        <form id="code-form">
                            <div class="form-group" id="form-group">
                                <label for="exampleInputEmail1">Kód:</label>
                                <input type="text" class="form-control" name="hash" id="hash" placeholder="Írd be a kódod" onkeyup="this.value = this.value.toLowerCase();">
                                <small id="emailHelp" class="form-text text-muted">A Szavazó lapkán található kódot írd be ide, vagy
                                    olvasd be a QR code-ot!
                                </small>
                            </div>
                            <input type="submit" class="btn btn-primary" id="btn" value="Beküldés">
                        </form>
                    </div>
                </div>
            </div> <?php
        }
            } else {

                require_once("navbar.php");

        ?>
        <div class="main-container container">
            <div class="code-padding">
                <h1 class="vote-h1">Szavazás</h1>
                <div class="code-box">
                    <form id="code-form">
                        <div class="form-group" id="form-group">
                            <label for="exampleInputEmail1">Kód:</label>
                            <input type="text" class="form-control" name="hash" id="hash" placeholder="Írd be a kódod" onkeyup="this.value = this.value.toLowerCase();">
                            <small id="emailHelp" class="form-text text-muted">A Szavazó lapkán található kódot írd be ide, vagy
                                olvasd be a QR code-ot!
                            </small>
                        </div>
                        <input type="submit" class="btn btn-primary" id="btn" value="Beküldés">
                    </form>
                </div>
            </div>


        </div>

        <?php
            }


            if (isset($_GET['vote'])) {
                if ($_GET['vote'] == 1) {
        ?>
            <script>
                successfulVote();
            </script>
    <?php
                }
            }
    ?>


</body>

</html>