<?php
require_once("snippets.php");
require_once("navbar.php");
if (!is_admin()) {
    goBack();
};
if ($_POST["passwordChange"]) {
?>
    <script>
        
    </script>
<?php
}

?>


<head>
    <title>Lavató - Felhasználók</title>
    <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/jquery-3.3.1.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
</head>
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable();
    });
</script>
<div class="main-container container">
    <h1 class="register-h1">Felhasználók</h1>
    <hr class="register-hr">
    <div class="log-table">
        <table id="usersTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="th-sm">id</th>
                    <th class="th-sm">Felhasználónév</th>
                    <th class="th-sm">Admin</th>
                    <th class="th-sm">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php get_users(); ?>
            </tbody>
        </table>
    </div>
</div>