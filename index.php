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
    <script src="assets/js/jquery-3.3.1.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

</head>

<body class="bg">
    <?php
    require_once("navbar.php");
    if (is_admin()) {
        if (isset($_POST["delete"])) {
    ?>
            <script>
                Swal.fire({
                    title: "Biztos ki szeretnéd törölni a hírt?",
                    text: "Választásodat nem tudod majd visszavonni!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Nem, mégsem",
                    confirmButtonText: "Igen, biztos",
                }).then((result) => {
                    if (result.value) {
                        window.location.replace("index.php?deleted=yes&id=" + <?php echo $_POST["id"] ?>)
                    }
                });
            </script>
        <?php
        } else if (isset($_GET["deleted"])) {
            delete_post($_GET["id"])
        ?>
            <script>
                Swal.fire({
                    title: "Sikeresen törölted a hírt!",
                    text: "",
                    icon: "success",
                    confirmButtonColor: "#28a745",
                    confirmButtonText: "Ok",
                }).then((result) => {
                    if (result.value) {
                        window.location.replace("index.php");
                    }
                });
            </script>
        <?php
        } else if (isset($_POST["edit"])) {
            // get_post_details($_POST["id"])
        ?>
            <script src="assets/js/jquery-3.3.1.js"></script>
            <script>
                Swal.fire({
                    title: 'Hír tartalmának megváltoztatása',
                    html: '<input type="text" id="news-edit-title" class="swal2-input" placeholder="A hír címe..." value="<?php echo get_news_title_by_id($_POST["id"]) ?>"></input>' +
                        '<textarea type="text" id="news-edit-content" class="swal2-input" rows="4" placeholder="A hír tartalma..." ><?php echo get_news_content_by_id($_POST["id"]) ?></textarea>',
                    confirmButtonText: 'Rendben',
                    preConfirm: () => {
                        let input1 = Swal.getPopup().querySelector('#news-edit-title').value;
                        let input2 = Swal.getPopup().querySelector('#news-edit-content').value;
                        let id = <?php echo $_POST["id"] ?>;
                        if (input1 === '' || input2 === '') {
                            Swal.showValidationMessage(`Mindkét adat szükséges`)
                        } else {
                            window.location.replace("index.php?id=" + id + "&editTitle=" + input1 + "&editContent=" + input2)
                        }

                    }
                })
            </script>
    <?php
        } else if (isset($_GET["editTitle"])) {
            edit_post($_GET["id"], $_GET["editTitle"], $_GET["editContent"]);
        }
    }
    ?>
    <div class="pageBody main-container container">
        <h1 class="index-main-h1">Hírek</h1>
        <hr class="index-hr">
        <?php if (is_admin()) {
            echo '<form method="post" action="newpost.php"><button type="submit" class="btn btn-primary index-add-news"><i class="fa fa-plus"></i> Új Poszt</button> <input type="text" value="new_post" name="for" hidden readonly> </form>';
        }
        get_posts();

        ?>

    </div>




    <script>
        document.getElementById("container-title-hr").style.width = document.getElementById("container-title-h1").offsetWidth;
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>