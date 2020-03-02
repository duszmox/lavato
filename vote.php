<?php

require_once("snippets.php");
display_errors();

?>
<html>


<head>

    
    <title>Lavató - Szavazás</title>
    
</head>

<body class="bg">


    <script src="assets/js/sweetalert2@9.js"></script>
    <?php
    if (isset($_GET['hash'])) {

        $hash = html_escape($_GET['hash']);



        if (!verify_hash($hash)) {
            echo '<script> notRealCode(); </script>';
    ?>
            <script>
                visibleForm();
            </script>
            <?php
        } elseif (verify_hash($hash)) {

            if (!hasBeenActivated($hash)) {
            ?><script>
                    codeAlreadyActivated();
                </script> <?php
                        } else {
                            ?>
                <script type="text/javascript">
                    window.setTimeout(hideForm, 2);
                    voteInfo();
                </script>
                <div id="main">
                    <div class="choose-class-A" onclick="confirmVote(this.textContent, true, '<?php echo $hash; ?>')"><p class="choose-class-text">A</p></div>
                    <div class="choose-class-B" onclick="confirmVote(this.textContent, false, '<?php echo $hash; ?>')"><p class="choose-class-text">B</p></div>
                    <div class="choose-class-C" onclick="confirmVote(this.textContent, false, '<?php echo $hash; ?>')"><p class="choose-class-text">C</p></div>
                    <div class="choose-class-D" onclick="confirmVote(this.textContent, false, '<?php echo $hash;?>')"><p class="choose-class-text">D</p></div>
                </div>
        <?php
                        }
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