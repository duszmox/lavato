<?php
require_once("snippets.php");


$google_url = "https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=kiskacsa.com&choe=UTF-8";
$bck_image_url = "assets/png/background.png";
$img = merge_two_photos($google_url, $bck_image_url, "1");