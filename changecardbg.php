<?php
require_once("snippets.php");
require_once("navbar.php");
displayErrors();
// Initialize message variable
$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['image']['name'];

    // image file directory
    $target = "assets/png/" . basename('background.png');

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavató - Kártya háttérkép módosítás</title>
</head>

<body>
    <div class="main-container container">
        <h1 class="hashexport-h1">Kártya háttérkép módosítás</h1>
        <hr class="hashexport-hr">
        <div class="hash-export-div">
            <p class="hash-export-label">Az új háttérképen a 375x375 pixel nagy QR kód jobb alsó sarka a háttérkép bal sarkától 375-375 pixelre fog megjelenni, ahogy az első háttérképen is látszik</p> <br> <br>
        <label class="hash-export-label currect-pic-label">Jelenlegi kép:</label> <br>
        <img src="assets/png/background.png" class="current-pic" alt=""> <br>
    
            
            <form method="POST" enctype="multipart/form-data">
            <label class="hash-export-label">Új kép feltöltése (874x500, png): </label>
            <input type="hidden" name="size" value="1000000">
                <div class="inline">
                    <input type="file" name="image">
                </div>
                <div class="inline">
                    <button type="submit" class="btn btn-success hash-export-button inline" name="upload">Feltöltés</button>
                </div>
            </form>


        </div>
    </div>
</body>

</html>

</div>

</body>

</html>
