<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lavato-Helyezések</title>
    <link rel="stylesheet" href="main_style.css">
    <link rel="stylesheet" href="assets/fonts/leaves/stylesheet.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script>
        <?php
        require_once("snippets.php");
        $data = get_class_votes();

        $all = $data['A']+$data['B']+$data['C']+$data['D'];
        foreach($data as $key => $value){
            $data[$key] = $value/$all *100;
        }
        ?>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "LAVATO 2020"
                },
                data: [{
                    type: "pie",
                    startAngle: 240,
                    yValueFormatString: "0.00\"%\"",
                    indexLabel: "{label} {y}",
                    dataPoints: [
                        {y: <?php echo $data['A']?>, label: "A"},
                        {y: <?php echo $data['B']?>, label: "B"},
                        {y: <?php echo $data['C']?>, label: "C"},
                        {y: <?php echo $data['D']?>, label: "D"}
                    ]
                }]
            });
            chart.render();

        }
    </script>
</head>

<body>

<?php

require("navbar.php");
//create_random_data(50, 1);


?>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>