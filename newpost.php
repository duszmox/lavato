<?php
require_once("snippets.php");

if (!is_admin()) {
    header("Location: /");
} else {
    require_once("navbar.php");
    if (isset($_POST["submit"]) && isset($_POST["submit"]) == "Közzététel") {
        global $conn;
        $title = $_POST["title"];
        $date = date("Y/m/d");
        $content = $_POST["content"];
        $username = $_SESSION["username"];
        $sql = "INSERT INTO lavato_posts (title, upload_date, content, author) VALUES ('$title', '$date', '$content', '$username')";
        mysqli_query($conn, $sql);

?>
        <script>
            successfulPostUpload();
        </script>
    <?php
    }
    ?>

    <head>
        <title>Lavató - Új Poszt</title>
        <script src="main.js"></script>
    </head>
    <div class="container main-container">
        <h1 class="newpost-h1">Új Hír</h1>
        <hr class="newpost-hr">
        <div class="newpost-form-div">
            <form method="POST">
                <label for="title"><strong>Cím: </strong></label>
                <input type="text" class="form-control newpost-input" placeholder="A hír címe..." name="title" id="title" required>
                <label for="content"><strong>Tartalom: </strong></label>
                <textarea class="form-control newpost-input" name="content" id="exampleFormControlTextarea1" rows="6" placeholder="A hír tartalma... (html formázásban)" required></textarea>
                <input type="submit" name="submit" class="btn btn-primary" value="Közzététel"><br>
            </form>
        </div>
    </div>
<?php
}
