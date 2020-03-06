<?php
require_once("snippets.php");
require_once("navbar.php");
if (!is_admin()) {
    goBack();

};
?>


<head>
    <title>Lavató - Eseménylista</title>
    <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/jquery-3.3.1.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>


</head>
<script>
    $(document).ready(function() {
        $('#logTable').DataTable();
    });
</script>
<div class="main-container container">
    <h1 class="log-h1">Eseménylista</h1>
    <div class="log-table">
        <table id="logTable" class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th class="th-sm">id</th>
                    <th class="th-sm">Action</th>
                    <th class="th-sm">Value</th>
                    <th class="th-sm">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php get_log(); ?>
            </tbody>
        </table>
    </div>
</div>