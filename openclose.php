<?php
require_once('snippets.php');
require_once('navbar.php');
if (!is_admin()) {
    goBack();
} elseif (isset($_POST["openclose"])) {
    if (is_vote_open() == 1) {
        close_vote();
    } else {
        open_vote();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php if (is_vote_open() == 1) {
                echo "Szavazás lezárása";
            } else {
                echo "Szavazás megnyitása";
            } ?> - Lavató</title>
</head>

<body>

    <div class="main-container container">
        <h1 class="hashdelete-h1"><?php if (is_vote_open() == 1) {
                                        echo "Szavazás lezárása";
                                    } else {
                                        echo "Szavazás megnyitása";
                                    } ?></h1>
        <hr class="hashdelete-hr">
        <div class="hashdelete-div">
            <form class="hashdelete-form" method="POST">
                <label for="xls" class="hash-export-label"><?php if (is_vote_open() == 1) {
                                                                echo "Szavazás lezárása: ";
                                                            } else {
                                                                echo "Szavazás megnyitása: ";
                                                            } ?> </label>
                <input type="submit" name="openclose" class="btn btn-warning hashdelete-button" value="<?php if (is_vote_open() == 1) {
                                                                                                            echo "Lezárás";
                                                                                                        } else {
                                                                                                            echo "Megnyitás";
                                                                                                        } ?>">
            </form>
        </div>

    </div>
</body>

</html>