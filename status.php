<!DOCTYPE html>
<html lang="en">
<?php
require_once ("snippets.php");
if(!user_logged_in()){
    header("Location: /lavato/");
}
?>
<head>
    <title>Lavato-Helyezések</title>

    <script>
        <?php
        require_once("snippets.php");
        $data = get_class_votes();
        $data_pretty = get_class_votes();

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
                        {y: <?php echo $data['A']?>, label: "A - <?php echo $data_pretty['A']?> szavazat,"},
                        {y: <?php echo $data['B']?>, label: "B - <?php echo $data_pretty['B']?> szavazat,"},
                        {y: <?php echo $data['C']?>, label: "C - <?php echo $data_pretty['C']?> szavazat,"},
                        {y: <?php echo $data['D']?>, label: "D - <?php echo $data_pretty['D']?> szavazat,"}
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
<script src="assets/js/canvasjs.min.js"></script>

</body>
</html>