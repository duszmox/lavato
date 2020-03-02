<?php 
function GM_html_table_from_sql($sql, $conn)
{
    if (!$conn) {
        die('Could not connect: ' . $conn->connect_error());
    }
    $sql = 'SELECT action, value, date, id FROM lavato_log';
    $retval = mysqli_query($conn, $sql);
    ?>
    <table id="table" class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th class="th-sm">id</th>
                    <th class="th-sm">Action</th>
                    <th class="th-sm">Value</th>
                    <th class="th-sm">Date</th>
                </tr>
            </thead>
            <tbody>
    <?php
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
?>
        <tr>
            <th scope="row"><?php echo "{$row['id']}" ?></th>
            <td><?php echo "{$row['action']}" ?> </td>
            <td> <?php echo "{$row['value']}" ?></td>
            <td> <?php echo "{$row['date']}" ?></td>
        </tr>
<?php
}
?>
            </tbody>
    </table>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    GM_html_table_from_sql()
    ?>
</body>
</html>